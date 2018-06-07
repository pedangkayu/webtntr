<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class data_invoice_item_bandung extends Model {

  use SoftDeletes;

  protected $table = 'data_invoice_item_bandung';
  protected $dates = ['deleted_at'];
  protected $fillable = [
    'total',
    'invoice_id',
    'currenci_id',
    'id_booking',
    'share_profit',
    'subtotal',
    'status',
    'old_id'
  ];

  public function scopeByid($query, $id){
      return $query->join('data_booking', 'data_booking.id_booking', '=', 'data_invoice_item_bandung.id_booking')
        ->join('ref_currencies', 'ref_currencies.id', '=', 'data_invoice_item_bandung.currenci_id')
        ->where('data_invoice_item_bandung.status', 1)
        ->where('data_invoice_item_bandung.invoice_id', $id)
        ->select([
          'data_invoice_item_bandung.id',
          'data_booking.id_booking',
          'data_booking.code',
          'data_booking.created_at',
          'data_invoice_item_bandung.subtotal',
          'data_invoice_item_bandung.total',
          'data_invoice_item_bandung.status',
          'data_invoice_item_bandung.share_profit',
          'data_invoice_item_bandung.old_id',
          'ref_currencies.iso_code',
        ]);
  }

}
