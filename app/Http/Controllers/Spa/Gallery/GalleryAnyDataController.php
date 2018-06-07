<?php

namespace App\Http\Controllers\Spa\Gallery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\data_gallerys;
use App\Models\data_spa;

class GalleryAnyDataController extends Controller {

  public function anydata($id){
    $items = data_gallerys::listall($id);
    return \Datatables::of($items)
    ->editColumn('file', function ($item) {
         return '<a href="' . url('/img/gallery/' . $item->file) . '" class="fancybox" title="' . $item->title . '" rel="group">
            <img class="img img-thumbnail" alt="' . $item->title  . '" title="' . $item->title  . '" src="' . asset('/img/gallery/thumb/' . $item->file) . '" />
          </a>';
     })
     ->editColumn('title', function ($item) {
          return '<input type="text" name="title[]" class="form-control" value="' . $item->title . '" onchange="update(this.value, ' . $item->id_gallery . ')" />';
      })
     ->editColumn('created_at', function ($item) {
          return date('M d, Y', strtotime($item->created_at));
    })
    ->editColumn('id_gallery', function ($item) {
         return '<a href="javascript:void(0);" onclick="trush(\'' . $item->id_gallery . '\');" class="btn btn-block btn-flat"><i class="fa fa-trash"></i></a>';
     })
    ->make();
  }


  public function headers(Request $req){

    $id = $req->id_spa;
    $path = public_path('img/spa/headers/');
    $file1 = '';
    $file2 = '';
    try {
      $spa = data_spa::find($id);
      if(!empty($req->header1)){
        $header1 = $req->header1->path();
        $file1 = date('d_m_y_h_i_s') . sha1(microtime()) . uniqid() . '.' . $req->header1->extension();
        \Image::make(file_get_contents($header1))->save($path . $file1);

        if(file_exists($path . $spa->header1)){
          @unlink($path . $spa->header1);
        }

        $spa->update([
          'header1' => $file1
        ]);

      }

      if(!empty($req->header2)){
        $header2 = $req->header2->path();
        $file2 = date('d_m_y_h_i_s') . sha1(microtime()) . uniqid() . '.' . $req->header2->extension();
        \Image::make(file_get_contents($header2))->save($path . $file2);


        if(file_exists($path . $spa->header2)){
          @unlink($path . $spa->header2);
        }

        $spa->update([
          'header2' => $file2
        ]);

      }

      $err = [
        'label' => 'success',
        'err' => 'Header was uploaded'
      ];

    } catch (\Exception $e) {
      if(file_exists($path . $file1)){
        @unlink($path . $file1);
      }
      if(file_exists($path . $file2)){
        @unlink($path . $file2);
      }

      $err = [
        'label' => 'danger',
        'err' => $e->getMessage()
      ];

    }

    return redirect()->back()->withNotif($err);


  }


}
