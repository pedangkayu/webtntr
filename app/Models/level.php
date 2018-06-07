<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class level extends Model {

    protected $table = 'levels';
  	protected $fillable = [
  		'nm_level',
  		'status'
  	];
}
