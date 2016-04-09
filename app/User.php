<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

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

    public function getMatchesAttribute()
    {
        return DB::table('users')
             ->join('roles', 'users.id', '=', 'roles.user_id')
             ->join('matches', 'matches.id', '=', 'roles.match_id')
             ->get();
    }
}
