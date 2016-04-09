<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'email',
        'id',
        'password',
        'remember_token',
        'updated_at'
    ];

    public function roles()
    {
        return $this->hasMany(
            'App\Role',
            'user_id'
        );
    }
}
