<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class data_servicepack extends Model {

  use SoftDeletes;

  protected $table = 'data_servicepack';
  protected $primaryKey = 'id_servicepack';
  protected $dates = ['deleted_at'];
  protected $fillable = [
    'id_spa',
    'servicepack',
    'type', /* 1:service | 2:package */
    'duration',
    'price_contract',
    'price_publish',
    'discount',
    'minimal_pax',
	   'free_pickup',
    'description',
    'img_thumbnail',
    'status',
    'percen_contract',
    'currenci_id',
    'slug'
  ];

  public function scopeService($query, $id){
    return $query->where('data_servicepack.id_spa', $id)
      ->join('ref_currencies', 'ref_currencies.id', '=', 'data_servicepack.currenci_id')
      ->where('data_servicepack.type', 1)
      ->where('data_servicepack.status', 1)
      ->select([
        'data_servicepack.img_thumbnail',
        'data_servicepack.servicepack',
        'data_servicepack.price_publish',
        'data_servicepack.id_servicepack',
        'ref_currencies.iso_code',
        'data_servicepack.price_contract',
        'ref_currencies.symbol',
        'ref_currencies.position',
        'ref_currencies.iso_code',
      ]);
  }

  public function scopePackage($query, $id){
    return $query->where('data_servicepack.id_spa', $id)
    ->join('ref_currencies', 'ref_currencies.id', '=', 'data_servicepack.currenci_id')
      ->where('data_servicepack.type', 2)
      ->where('data_servicepack.status', 1)
      ->select([
        'data_servicepack.img_thumbnail',
        'data_servicepack.servicepack',
        'data_servicepack.price_publish',
        'data_servicepack.id_servicepack',
        'ref_currencies.iso_code',
        'data_servicepack.price_contract',
        'ref_currencies.symbol',
        'ref_currencies.position',
        'ref_currencies.iso_code',
      ]);
  }


  public function scopeServiceall($query, $id){
    return $query->where('data_servicepack.id_spa', $id)
      ->join('ref_currencies', 'ref_currencies.id', '=', 'data_servicepack.currenci_id')
      ->where('data_servicepack.type', 1)
      ->where('data_servicepack.status', 1)
      ->orderby('updated_at', 'desc')
      ->select([
        'data_servicepack.*',
        'ref_currencies.symbol',
        'ref_currencies.iso_code',
      ]);
  }

  public function scopePackageall($query, $id){
    return $query->where('data_servicepack.id_spa', $id)
      ->join('ref_currencies', 'ref_currencies.id', '=', 'data_servicepack.currenci_id')
      ->where('data_servicepack.type', 2)
      ->where('data_servicepack.status', 1)
      ->orderby('updated_at', 'desc')
      ->select([
        'data_servicepack.*',
        'ref_currencies.symbol',
        'ref_currencies.iso_code',
      ]);
  }

  public function scopeSpecialoffer($query){
    return $query->join('data_spa', 'data_spa.id_spa', '=', 'data_servicepack.id_spa')
      ->join('ref_currencies', 'ref_currencies.id', '=', 'data_servicepack.currenci_id')
      // ->where('data_spa.premium', 1)
      ->where('data_servicepack.discount', '>', 0)
      ->orderby(\DB::raw('RAND()'))
      ->select([
        'data_spa.spa AS spa',
		    'data_spa.slug AS slug_spa',
        'data_servicepack.*',
        'ref_currencies.symbol',
        'ref_currencies.iso_code',
      ]);
  }


  public function scopeAllservicepack($query, array $req = []){
    $item = $query->join('data_spa', 'data_spa.id_spa', '=', 'data_servicepack.id_spa')
      ->join('ref_currencies', 'ref_currencies.id', '=', 'data_servicepack.currenci_id')
      ->orderby('data_servicepack.updated_at', 'DESC')
      ->select([
        'data_spa.spa AS spa',
		    'data_spa.slug AS slug_spa',
        'data_servicepack.*',
        'ref_currencies.symbol',
        'ref_currencies.iso_code',
      ]);

      if(!empty($req['src']))
        $item->where('data_servicepack.servicepack', 'LIKE', '%' . $req['src'] . '%');

      if(!empty($req['spa'][0]))
        $item->whereIn('data_spa.id_spa', $req['spa']);

      if(!empty($req['types'][0]))
        $item->whereIn('data_servicepack.type', $req['types']);

      if(!empty($req['crc'][0]))
        $item->whereIn('data_servicepack.currenci_id', $req['crc']);

      if(!empty($req['discount']) && $req['discount'] == 'true')
        $item->where('data_servicepack.discount', '>', 0);

      return $item;
  }


  public function scopeSlug($query, $slug){
    return $query->join('ref_currencies', 'ref_currencies.id', '=', 'data_servicepack.currenci_id')
    ->where('slug', $slug)
    ->select([
      'data_servicepack.*',
      'ref_currencies.symbol',
      'ref_currencies.iso_code',
    ]);
  }

  public function scopeSitemap($query){
    return $query->join('data_spa', 'data_spa.id_spa', '=', 'data_servicepack.id_spa')
      ->select([
        'data_spa.slug AS spa_slug',
        'data_servicepack.updated_at',
        'data_servicepack.slug',
        'data_servicepack.servicepack',
        'data_servicepack.img_thumbnail',
      ]);
  }

}
