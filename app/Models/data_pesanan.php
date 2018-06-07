<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class data_pesanan extends Model
{
    protected $table = 'data_pesanan';
	protected $fillable = [
	    'code',
	    'qty_pesanan',
	    'time_request',
	    'title',
	    'name_customer',
	    'email',
	    'phone',
	    'address',
	    'city',
	    'country_id',
	    'status',
	    'note',
	    'id_product',
	    'invoice_note',
		'customer_note',
	    'type',
	    'category_order',
	];
}
