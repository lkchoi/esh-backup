<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = [
        'game_id',
        'maker_id',
        'challenger_id',
        'payout'
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
            'match_id'
        );
    }

    public function getPlayer($offset = 0)
    {
        return $this->roles()->offset($offset)->first();
    }

    public function getAmountAttribute()
    {
        return sprintf('$%.2f', $this->payout/100);
    }
}
