<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $fillable = [
        'name',
    ];

    public function game()
    {
        return $this->belongsTo(
            'App\Game',
            'game_id'
        );
    }

    public function roles()
    {
        return $this->hasMany(
            'App\Role',
            'character_id'
        );
    }
}
