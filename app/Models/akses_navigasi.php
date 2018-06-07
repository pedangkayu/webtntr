<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class akses_navigasi extends Model {

    protected $table = 'akses_navigasi';
  	protected $fillable = [
  		'navigasi_id',
  		'level_id'
      ];


    public function scopeMenus($query){
    	$me = \Auth::check() ? \Auth::user()->level_id : 0;
    	return $query->join('navigasi', 'navigasi.id', '=', 'akses_navigasi.navigasi_id')
    		->where('akses_navigasi.level_id', $me)
            ->select('navigasi.*')
            ->orderby('navigasi.seri', 'asc');
    }

    public function scopeAccesspage($query){
    	$me = \Auth::check() ? \Auth::user()->level_id : 0;
    	return $query->join('navigasi', 'navigasi.id', '=', 'akses_navigasi.navigasi_id')
    		->where('akses_navigasi.level_id', $me)
    		->select('navigasi.slug');
    }

}
