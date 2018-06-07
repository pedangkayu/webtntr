<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class data_share_profit_bandung extends Model {

  use SoftDeletes;

  protected $table = 'data_share_profit_bandung';
  protected $dates = ['deleted_at'];
  protected $fillable = [
    'total',
    'currenci_id',
    'id_booking',
    'share_profit',
    'subtotal',
    'status', // 1:tagihan|2:modetarot|3:lunas
  ];

  public function scopeListtagihan($query, $id_iso){
      return $query->join('data_booking', 'data_booking.id_booking', '=', 'data_share_profit_bandung.id_booking')
        ->join('ref_currencies', 'ref_currencies.id', '=', 'data_share_profit_bandung.currenci_id')
        ->whereIn('data_share_profit_bandung.status', [1,2])
        ->where('data_share_profit_bandung.currenci_id', $id_iso)
        ->select([
          'data_share_profit_bandung.id',
          'data_booking.id_booking',
          'data_booking.code',
          'data_booking.created_at',
          'data_share_profit_bandung.subtotal',
          'data_share_profit_bandung.total',
          'data_share_profit_bandung.status',
          'data_share_profit_bandung.share_profit',
          'ref_currencies.iso_code'
        ]);
  }


  public function scopeListtagihanpayout($query, $id_iso){
      return $query->join('data_booking', 'data_booking.id_booking', '=', 'data_share_profit_bandung.id_booking')
        ->join('ref_currencies', 'ref_currencies.id', '=', 'data_share_profit_bandung.currenci_id')
        ->where('data_share_profit_bandung.status', 1)
        ->where('data_share_profit_bandung.currenci_id', $id_iso)
        ->select([
          'data_share_profit_bandung.id',
          'data_booking.id_booking',
          'data_booking.code',
          'data_booking.created_at',
          'data_share_profit_bandung.subtotal',
          'data_share_profit_bandung.total',
          'data_share_profit_bandung.status',
          'data_share_profit_bandung.share_profit',
          'ref_currencies.iso_code'
        ]);
  }

}
