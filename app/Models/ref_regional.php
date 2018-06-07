<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ref_regional extends Model {

  protected $table = 'ref_regional';
  protected $primaryKey = 'id_regional';
  protected $fillable = [
    'nm_regional',
    'status'
  ];

  public function scopeActive($query){
    return $query->where('status', 1)
      ->orderby('nm_regional', 'asc');
  }

}
