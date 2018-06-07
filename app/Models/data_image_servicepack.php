<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class data_image_servicepack extends Model {

  use SoftDeletes;

  protected $table = 'data_image_servicepack';
  protected $dates = ['deleted_at'];
  protected $fillable = [
    'servicepack_id',
    'status',
    'file_name'
  ];

}
