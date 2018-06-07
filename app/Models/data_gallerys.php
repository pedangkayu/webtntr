<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class data_gallerys extends Model {

  protected $table = 'data_gallerys';
  protected $primaryKey = 'id_gallery';
  protected $fillable = [
    'file',
    'id_spa',
    'title'
  ];

  public function scopeListall($query, $id_spa){
    return $query->where('id_spa', $id_spa)
      ->select([
        'file',
        'title',
        'created_at',
        'id_gallery',
        'id_spa',
      ]);
  }

}
