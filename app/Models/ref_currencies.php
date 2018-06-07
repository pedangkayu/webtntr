<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ref_currencies extends Model {

  protected $table = 'ref_currencies';
  protected $fillable = [
    'iso_code',
    'symbol',
    'unicode',
    'position',
    'comments'
  ];

  public function scopeActive($query){
    return $query->where('status', 1);
  }

}
