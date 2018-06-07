<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class data_paladin extends Model {

  protected $table = 'data_paladin';
  protected $fillable = [
    'owner',
    'company',
    'email',
    'address',
    'mobile',
    'phone',
    'fax',
    'facebook',
    'instagram',
    'twitter',
    'gplus',
    'path',

    'rekening_paypal',
    'rekening_bca',
    'rekening_mandiri',
    'rekening_bni',
    'rekening_bri',

    'seo_title',
    'seo_description',
    'seo_keywords',

    'active',
    'bcc_booking_email',
    'share_profit',
	'linkage'
  ];

}
