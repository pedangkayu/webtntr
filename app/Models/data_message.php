<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class data_message extends Model {

  use SoftDeletes;

  protected $table = 'data_message';
  protected $dates = ['deleted_at'];
  protected $fillable = [
    'name',
    'email',
    'website',
    'subject',
    'message',
    'merchant_id',
    'status'
  ];

  public function scopeListall($query, $status){
    $item = $query->leftJoin('data_spa', 'data_spa.id_spa', '=', 'data_message.merchant_id')
      ->select([
        'data_message.subject',
        'data_message.name',
        'data_message.email',
        'data_spa.spa',
        'data_message.created_at',
        'data_message.id',
        'data_message.status',
      ]);

      if(!empty($status)){
        $item->where('data_message.status', $status);
      }

      return $item;

  }

  public function scopeBaru($query){
    return $query->where('status', 1)
      ->orderby('id', 'desc');
  }

}
