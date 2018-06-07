<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class data_invoice_bandung extends Model {
  use SoftDeletes;

  protected $table = 'data_invoice_bandung';
  protected $dates = ['deleted_at'];
  protected $fillable = [
    'code',
    'note',
    'user_id',
    'status',
    'grandtotal',
    'currenci_id'
  ];

  public function scopeListall($query, $status){
    return $query->join('ref_currencies', 'ref_currencies.id', '=', 'data_invoice_bandung.currenci_id')
    ->where('data_invoice_bandung.status', 2)
    ->select([
      'data_invoice_bandung.code',
      'data_invoice_bandung.created_at',
      'data_invoice_bandung.grandtotal',
      'ref_currencies.iso_code',
      'data_invoice_bandung.status',
      'data_invoice_bandung.id',
    ]);
  }

}
