<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class data_image_header extends Model {

  use SoftDeletes;

  protected $table = 'data_image_header';
  protected $dates = ['deleted_at'];
  protected $fillable = [
    'file_name',
    'title',
    'description',
    'status',
    'order',
    'link',
    'target'
  ];

  public function scopeActive($query){
    return $query->where('status', 1)
      ->orderby('order', 'asc');
  }

}
