<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ref_country extends Model {

  protected $table = 'ref_country';
  protected $primaryKey = 'id_country';

  public function scopeActive($query){
    return $query->where('status', 1)
      ->orderby('nm_country', 'asc');
  }

}
