<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class data_booking extends Model {
  use SoftDeletes;
  protected $dates = ['deleted_at'];

  protected $table = 'data_booking';
  protected $primaryKey = 'id_booking';
  protected $fillable = [
		'code',
		'id_spa',
		'id_package',
		'qty_person',
		'day_request',
		'time_request',
    'title',
		'name_customer',
		'email',
		'phone',
		'address',
		'city',
		'country_id',
		'status', // 1:New|2:invoice send(unpaid)|3:Paid|4:Cancel
    'note',
    'id_servicepack',
    'type',
    'hotel',
    'checkin_hotel',
    'contact_hotel',
    'id_spa',
    'subtotal',
    'discount',
    'grandtotal',
    'currenci_id',
    'tax',
    'note_voucher',
    'paypal_payer_id',
    'paypal_payment_id',
    'paypal_status',
    'paypal_date',
    'invoice_note',
    'total_other'
  ];

  public function scopeListall($query, $status){
    $item = $query->join('ref_country', 'ref_country.id_country', '=', 'data_booking.country_id')
      ->join('ref_currencies', 'ref_currencies.id', '=', 'data_booking.currenci_id')
      ->distinct('data_booking.id_booking')
      ->select([
        'data_booking.code',
        'data_booking.name_customer',
        'data_booking.email',
        'data_booking.day_request',
        'data_booking.checkin_hotel',
        'data_booking.grandtotal',
        'data_booking.status',
    		'data_booking.id_booking',
    		'data_booking.created_at',
        'data_booking.phone',
        'data_booking.time_request',
        'ref_currencies.iso_code'
      ]);

      if(!empty($status))
        $item->where('data_booking.status', $status);

      return $item;
  }

  public function scopeCode($query, $code){
    return $query->join('ref_country', 'ref_country.id_country', '=', 'data_booking.country_id')
    ->where('data_booking.code', $code)
      ->select([
        'data_booking.*',
        'ref_country.nm_country'
      ]);
  }

  public function scopeBaru($query){
    return $query->join('data_servicepack', 'data_servicepack.id_servicepack', '=', 'data_booking.id_servicepack')
      ->where('data_booking.status', 1)
      ->orderby('data_booking.id_booking', 'desc')
      ->select([
        'data_booking.id_booking',
        'data_servicepack.servicepack',
        'data_booking.created_at',
        'data_servicepack.img_thumbnail'
      ]);
  }

}
