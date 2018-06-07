<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable {
    use SoftDeletes;
    use Notifiable;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'username',
        'level_id',
        'email',
        'password',
        'online',
        'avatar',
        'cover',
        'phone',
        'address',
        'city',
        'country',
        'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeItems($query){
        return $query->join('levels', 'levels.id', '=', 'users.level_id')
          ->whereNotIn('level_id', [1])
          ->select([
            'users.avatar',
            'users.name',
            'users.email',
            'users.phone',
            'levels.nm_level',
            'users.online',
            'users.id',
          ]);
    }

}
