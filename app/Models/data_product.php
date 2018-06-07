<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class data_product extends Model
{
    protected $table = 'data_product';
	protected $fillable = [
	    'lang_id',
	    'id_product',
	    'id_merchant',
	    'product',
	    'slug',
	    'type',
	    'price_contract',
	    'price_publish',
	    'discount',
	    'percent_contract',
	    'minimal',
	    'description',
	    'img_thumbnail',
	    'status',
	    'code'
	];
}
