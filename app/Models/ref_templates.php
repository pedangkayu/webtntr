<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ref_templates extends Model {

  protected $table = 'ref_templates';
  protected $fillable = [
    'template_name',
    'template_path',
    'status'
  ];
}
