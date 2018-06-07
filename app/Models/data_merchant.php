<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class data_merchant extends Model {
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  protected $table = 'data_merchant';
  protected $primaryKey = 'id_merchant';
  protected $fillable = [
    'merchant',
    'address',
    'email',
    'phone',
    'id_regional',
    'description',
    'benefit',
    'website',
    'mobile',
    'fax',
    'facilities',
    'features',
    'work_day',
    'work_hour',
    'day_off',
    'longitude',
    'latitude',
  	'facebook',
  	'instagram',
  	'twitter',
  	'path',
    'status',
    'img_thumbnail',
    'slug',
    'seo_title', // max 60 caracter
    'seo_description', // max 160 caracter
    'seo_keywords',
    'policy',
    'template_id',
    'logo',
    'premium', // Default 0
    'header1',
    'header2'
  ];

  public function scopeListall($query){
    return $query->join('ref_regional', 'ref_regional.id_regional', '=', 'data_merchant.id_regional')
      ->select([
        'data_merchant.img_thumbnail',
        'data_merchant.merchant',
        'data_merchant.phone',
        'data_merchant.email',
        'ref_regional.nm_regional',
        'data_merchant.premium',
        'data_merchant.id_merchant',
		'data_merchant.created_at',
        'data_merchant.status',
        'data_merchant.slug',
        'data_merchant.updated_at'
      ]);
  }

  public function scopeSearch($query, $src){
    return $query->where('data_merchant.merchant', 'LIKE', '%' . $src . '%')
      ->select([
        'data_merchant.img_thumbnail',
        'data_merchant.merchant',
        'data_merchant.phone',
        'data_merchant.email',
        'data_merchant.premium',
        'data_merchant.id_merchant',
		'data_merchant.created_at',
        'data_merchant.status',
        'data_merchant.slug',
        'data_merchant.updated_at'
      ]);
  }

  public function scopeSlug($query, $slug){
    return $query->join('ref_regional', 'ref_regional.id_regional', '=', 'data_merchant.id_regional')
    ->where('data_merchant.slug', $slug)
      ->select([
        'data_merchant.*',
        'ref_regional.nm_regional'
      ]);
  }

  public function scopeTopfrontend($query){
    // return $query->where('premium', 1)
    // ->orderby(\DB::raw('RAND()'));
    return $query->orderby('updated_at', 'desc');
  }

  public function scopeAllmerchant($query){
    return $query->orderby('premium', 'desc')->orderby(\DB::raw('RAND()'));
  }

  public function scopeSmerchantap($query){
    return $query->select([
      'id_merchant',
      'slug',
      'img_thumbnail',
      'updated_at',
      'seo_title',
      'seo_description'
    ]);
  }

}
