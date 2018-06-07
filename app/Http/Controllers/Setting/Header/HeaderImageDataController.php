<?php

namespace App\Http\Controllers\Setting\Header;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\data_image_header;

class HeaderImageDataController extends Controller {

  public function anydata(){
    $images = data_image_header::all();
    return \Datatables::of($images)
    ->editColumn('id', function ($item) {
         return '<img src="' . asset('/img/headers/thumb/' . $item->file_name) . '" class="img img-thumbnail">';
     })
    ->editColumn('created_at', function ($item) {
         return '<strong><a href="' . url('/header/' . $item->id . '/edit') . '">' . date('d M Y', strtotime($item->created_at)) . '</a></strong>';
     })
     ->editColumn('status', function ($item) {
       $checked = $item->status ? 'checked' : '';
        return '<input type="checkbox" ' . $checked . ' name="status" value="' . $item->id . '">';
      })
    ->make();

  }

  public function headerstatus(Request $req){
    $state = $req->state == "true" ? 1 : 0;
    data_image_header::find($req->id)->update([
      'status' => $state
    ]);

    $status = $state ? 'activated' : 'disabled';

    return response()->json([
      'result' => true,
      'err' => 'Header wa ' . $status
    ]);
  }

}
