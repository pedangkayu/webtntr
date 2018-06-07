<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class navigasi extends Model {
    
    protected $table = 'navigasi';
	protected $fillable = [
		'parent_id',
		'title',
		'slug',
		'class',
		'class_id',
		'icon',
		'seri',
		'ket',
		'status',
    ];

}
