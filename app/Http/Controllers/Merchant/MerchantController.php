<?php

namespace App\Http\Controllers\Merchant;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\data_merchant;
use App\Models\ref_regional;
use App\Models\ref_templates;
use App\Models\data_servicepack;

use App\Jobs\Merchant\CreateMerchantJob;
use App\Jobs\Merchant\EditMerchantJobs;
use App\Events\Merchant\imageThumbMerchantEvent;

class MerchantController extends Controller
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
  						'name' => 'All Merchant',
  						'link' => 'javascript:void(0);'
  				]
  		];

      return view('Merchant.Index', $data);
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
  						'name' => 'All Merchant',
  						'link' => url('/merchant')
  				],
          [
  						'name' => 'Create',
  						'link' => 'javascript:void(0);'
  				]
  		];

      $data['regions'] = ref_regional::active()->get();

      return view('Merchant.Create', $data);
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
          'slug' => 'required|unique:data_merchant'
      ]);
      $filename = date('d_m_Y_') . rand(11111,99999) . time() . '.png';
      $data = $req->all();
      $data['img_thumbnail'] = empty($_FILES['img_thumbnail']['tmp_name']) ? 'default.jpg' : $filename;
      $data['logo'] = empty($_FILES['logo_img']['tmp_name']) ? 'default.png' : $filename;
      unset($data['logo_img']);
      $this->dispatch(new CreateMerchantJob($data));
      $id = $req->session()->get('notif')['id'];
      if($id > 0){
        event(new imageThumbMerchantEvent($filename, 0));
        return redirect('/merchant/' . $id . '/edit');
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
      $merchant = data_merchant::find($id);
      $data['merchant'] = $merchant;
      $data['breadcrumb'] = [
          [
              'name' => 'Home',
              'link' => '/home'
          ],
          [
              'name' => 'All Merchant',
              'link' => url('/merchant')
          ],
          [
              'name' => 'Detail',
              'link' => 'javascript:void(0);'
          ]
      ];
      //dd($data);
      return view('Merchant.View', $data);
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
              'name' => 'All Merchant',
              'link' => url('/merchant')
          ],
          [
              'name' => 'Detail',
			  'link' => '/merchant/' . $id
          ],
          [
              'name' => 'Edit',
              'link' => 'javascript:void(0);'
          ]
      ];

      $data['merchant'] = data_merchant::find($id);
      $data['regions'] = ref_regional::active()->get();

      return view('Merchant.Edit', $data);
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
            'slug' => 'required|unique:data_merchant'
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

      event(new imageThumbMerchantEvent($filename, $req->id));
      unset($data['logo_img']);
      $this->dispatch(new EditMerchantJobs($data));
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
      $data['merchant'] = data_merchant::find($id);
      $data['breadcrumb'] = [
          [
              'name' => 'Home',
              'link' => '/home'
          ],
          [
              'name' => 'All merchant',
              'link' => url('/merchant')
          ],
          [
              'name' => 'Detail',
			        'link' => '/merchant/' . $id
          ],
          [
              'name' => 'Templates ' . $data['merchant']->merchant,
              'link' => 'javascript:void(0);'
          ]
      ];
      $data['tems'] = ref_templates::where('status', 1)->get();
      return view('Merchant.Templates', $data);
    }

}
