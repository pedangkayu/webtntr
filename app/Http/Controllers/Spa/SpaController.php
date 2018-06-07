<?php

namespace App\Http\Controllers\Spa;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\data_spa;
use App\Models\ref_regional;
use App\Models\ref_templates;
use App\Models\data_servicepack;

use App\Jobs\Spa\CreateSpaJob;
use App\Jobs\Spa\EditSpaJobs;
use App\Events\Spa\imageThumbSpaEvent;

class SpaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

      $data['breadcrumb'] = [
  				[
  						'name' => 'Home',
  						'link' => '/home'
  				],
  				[
  						'name' => 'All Spa',
  						'link' => 'javascript:void(0);'
  				]
  		];

      return view('Spa.Index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
      $data['breadcrumb'] = [
  				[
  						'name' => 'Home',
  						'link' => '/home'
  				],
  				[
  						'name' => 'All Spa',
  						'link' => url('/spa')
  				],
          [
  						'name' => 'Create',
  						'link' => 'javascript:void(0);'
  				]
  		];

      $data['regions'] = ref_regional::active()->get();

      return view('Spa.Create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req) {
      $req['slug'] = str_slug(ltrim($req->slug, '/'));
      $this->validate($req, [
          'slug' => 'required|unique:data_spa'
      ]);
      $filename = date('d_m_Y_') . rand(11111,99999) . time() . '.png';
      $data = $req->all();
      $data['img_thumbnail'] = empty($_FILES['img_thumbnail']['tmp_name']) ? 'default.jpg' : $filename;
      $data['logo'] = empty($_FILES['logo_img']['tmp_name']) ? 'default.png' : $filename;
      unset($data['logo_img']);
      $this->dispatch(new CreateSpaJob($data));
      $id = $req->session()->get('notif')['id'];
      if($id > 0){
        event(new imageThumbSpaEvent($filename, 0));
        return redirect('/spa/' . $id . '/edit');
      }else{
        return redirect()->back()->withInput();
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
      $spa = data_spa::find($id);
      $data['spa'] = $spa;
      $data['breadcrumb'] = [
          [
              'name' => 'Home',
              'link' => '/home'
          ],
          [
              'name' => 'All Spa',
              'link' => url('/spa')
          ],
          [
              'name' => 'Detail',
              'link' => 'javascript:void(0);'
          ]
      ];
      //dd($data);
      return view('Spa.View', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
      $data['breadcrumb'] = [
          [
              'name' => 'Home',
              'link' => '/home'
          ],
          [
              'name' => 'All Spa',
              'link' => url('/spa')
          ],
          [
              'name' => 'Detail',
			  'link' => '/spa/' . $id
          ],
          [
              'name' => 'Edit',
              'link' => 'javascript:void(0);'
          ]
      ];

      $data['spa'] = data_spa::find($id);
      $data['regions'] = ref_regional::active()->get();

      return view('Spa.Edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id) {
      $req['slug'] = str_slug(ltrim($req->slug, '/'));
      if($req->slug != $req->slug_old){
        $this->validate($req, [
            'slug' => 'required|unique:data_spa'
        ]);
      }
      $filename = date('d_m_Y_') . rand(11111,99999) . time() . '.png';
      $data = $req->all();
      if(!empty($_FILES['img_thumbnail']['tmp_name'])):
        $data['img_thumbnail'] = empty($_FILES['img_thumbnail']['tmp_name']) ? 'default.jpg' : $filename;
      endif;
      if(!empty($_FILES['logo_img']['tmp_name'])):
        $data['logo'] = empty($_FILES['logo_img']['tmp_name']) ? 'default.png' : $filename;
      endif;

      event(new imageThumbSpaEvent($filename, $req->id));
      unset($data['logo_img']);
      $this->dispatch(new EditSpaJobs($data));
      return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function tempates($id){
      $data['spa'] = data_spa::find($id);
      $data['breadcrumb'] = [
          [
              'name' => 'Home',
              'link' => '/home'
          ],
          [
              'name' => 'All Spa',
              'link' => url('/spa')
          ],
          [
              'name' => 'Detail',
			        'link' => '/spa/' . $id
          ],
          [
              'name' => 'Templates ' . $data['spa']->spa,
              'link' => 'javascript:void(0);'
          ]
      ];
      $data['tems'] = ref_templates::where('status', 1)->get();
      return view('Spa.Templates', $data);
    }

}
