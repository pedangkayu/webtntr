<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class data_spa extends Model {
  use SoftDeletes;
  protected $dates = ['deleted_at'];

  protected $table = 'data_spa';
  protected $primaryKey = 'id_spa';
  protected $fillable = [
    'spa',
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
    return $query->join('ref_regional', 'ref_regional.id_regional', '=', 'data_spa.id_regional')
      ->select([
        'data_spa.img_thumbnail',
        'data_spa.spa',
        'data_spa.phone',
        'data_spa.email',
        'ref_regional.nm_regional',
        'data_spa.premium',
        'data_spa.id_spa',
		    'data_spa.created_at',
        'data_spa.status',
        'data_spa.slug',
        'data_spa.updated_at'
      ]);
  }

  public function scopeSearch($query, $src){
    return $query->where('data_spa.spa', 'LIKE', '%' . $src . '%')
      ->select([
        'data_spa.img_thumbnail',
        'data_spa.spa',
        'data_spa.phone',
        'data_spa.email',
        'data_spa.premium',
        'data_spa.id_spa',
		    'data_spa.created_at',
        'data_spa.status',
        'data_spa.slug',
        'data_spa.updated_at'
      ]);
  }

  public function scopeSlug($query, $slug){
    return $query->join('ref_regional', 'ref_regional.id_regional', '=', 'data_spa.id_regional')
    ->where('data_spa.slug', $slug)
      ->select([
        'data_spa.*',
        'ref_regional.nm_regional'
      ]);
  }

  public function scopeTopfrontend($query){
    // return $query->where('premium', 1)
    // ->orderby(\DB::raw('RAND()'));
    return $query->orderby('updated_at', 'desc');
  }

  public function scopeAllspa($query){
    return $query->orderby('premium', 'desc')->orderby(\DB::raw('RAND()'));
  }

  public function scopeSitemap($query){
    return $query->select([
      'id_spa',
      'slug',
      'img_thumbnail',
      'updated_at',
      'seo_title',
      'seo_description'
    ]);
  }

}
