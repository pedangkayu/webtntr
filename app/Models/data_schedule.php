<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class data_schedule extends Model {

  use SoftDeletes;

  protected $table = 'data_schedule';
  protected $dates = ['deleted_at'];
  protected $fillable = [
    'id_spa',
    'nm_schedule',
    'time_start',
	   'time_end',
    'location',
    'description',
    'hashtag',
    'user_id',
    'status',
    'slug'
  ];
}
