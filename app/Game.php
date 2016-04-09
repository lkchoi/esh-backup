<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'name',
        'abbreviation'
    ];

    public $dates = [
        'deleted_at'
    ];

    public function matches()
    {
        return $this->hasMany(
            'App\Match',
            'game_id'
        );
    }

    public function characters()
    {
        return $this->hasMany(
            'App\Character',
            'game_id'
        );
    }
}
