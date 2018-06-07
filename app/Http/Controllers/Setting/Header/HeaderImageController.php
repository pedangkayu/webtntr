<?php

namespace App\Http\Controllers\Setting\Header;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\data_image_header;

use App\Jobs\Setting\Header\CreateHeaderJob;
use App\Jobs\Setting\Header\EditeHeaderJob;

class HeaderImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        return view('Settings.Header.Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      $data['breadcrumb'] = [
            [
                'name' => 'Home',
                'link' => '/home'
            ],
            [
                'name' => 'Header',
                'link' => '/header'
            ],
            [
                'name' => 'Create',
                'link' => 'javascript:void(0);'
            ]
        ];
        return view('Settings.Header.Create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req) {

      // Upload File
      $path = public_path('/img/headers/');
      $filename = date('d_m_Y_') . time() . rand(0, 100000) . md5(time()) . '.jpg';
      $base_name = file_get_contents($_FILES['img']['tmp_name']);
      $wfit = 250;
      \Image::make($base_name)->save($path . $filename);
      \Image::make($base_name)->resize($wfit, null, function($constraint){
        $constraint->aspectRatio();
      })->save($path . 'thumb/' . $filename); // Thumbnail
      $data = $req->all();
      unset($data['img']);
      $data['file_name'] = $filename;
      $this->dispatch(new CreateHeaderJob($data));
      return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
      $data['breadcrumb'] = [
            [
                'name' => 'Home',
                'link' => '/home'
            ],
            [
                'name' => 'Header',
                'link' => '/header'
            ],
            [
                'name' => 'Edit',
                'link' => 'javascript:void(0);'
            ]
        ];
        $data['header'] = data_image_header::find($id);
        return view('Settings.Header.Edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id) {
      // Upload File
      $data = $req->all();

      $head = data_image_header::find($id);
      if(!empty($_FILES['img']['tmp_name'])):
        $path = public_path('/img/headers/');
        $filename = date('d_m_Y_') . time() . rand(0, 100000) . md5(time()) . '.jpg';
        $base_name = file_get_contents($_FILES['img']['tmp_name']);
        $wfit = 250;
        \Image::make($base_name)->save($path . $filename);
        \Image::make($base_name)->resize($wfit, null, function($constraint){
          $constraint->aspectRatio();
        })->save($path . 'thumb/' . $filename); // Thumbnail
        $data['file_name'] = $filename;

        // Delete File
        if(file_exists($path . $head->file_name))
          @unlink($path . $head->file_name);
        if(file_exists($path . 'thumb/' . $head->file_name))
          @unlink($path . 'thumb/' . $head->file_name);
      endif;
      unset($data['img']);
      $this->dispatch(new EditeHeaderJob($data));
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
}
