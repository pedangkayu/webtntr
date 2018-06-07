<?php

namespace App\Http\Controllers\Message;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\data_message;

class MessageDataController extends Controller {

  public function anydata(Request $req){
    $status = !empty($req->status) ? $req->status : '';
    $items = data_message::listall($status);
    return \Datatables::of($items)
    ->editColumn('subject', function ($item) {
        $syntax = $item->status == 1 ? 'strong' : 'div';
         return '<' . $syntax . '>' . '<a href="' . url('/message/' . $item->id ) . '">' . $item->subject . '</a>' . '</' . $syntax . '>';
     })
     ->editColumn('name', function ($item) {
         $syntax = $item->status == 1 ? 'strong' : 'div';
         return '<' . $syntax . '>' . $item->name . '</' . $syntax . '>';
      })
      ->editColumn('email', function ($item) {
          $syntax = $item->status == 1 ? 'strong' : 'div';
          return '<' . $syntax . '>' . $item->email . '</' . $syntax . '>';
       })
       ->editColumn('spa', function ($item) {
           $syntax = $item->status == 1 ? 'strong' : 'div';
           return '<' . $syntax . '>' . $item->spa . '</' . $syntax . '>';
        })
      ->editColumn('created_at', function ($item) {
          $syntax = $item->status == 1 ? 'strong' : 'div';
          return '<' . $syntax . '>' . date('M d, Y', strtotime($item->created_at)) . '</' . $syntax . '>';
       })
       ->editColumn('id', function ($item) {
           return '<button class="btn btn-block btn-xs btn-flat" onclick="trash(' . $item->id . ')"><i class="fa fa-trash"></i></button>';
        })
      ->make();
  }

}
