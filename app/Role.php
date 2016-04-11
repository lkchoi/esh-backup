<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const RESULT_WIN = 1;
    const RESULT_LOSS = 0;
    const RESULT_TBD = 10;

    protected $fillable = [
        'match_id',
        'user_id',
        'character_id',
        'result',
    ];

    public function character()
    {
        return $this->belongsTo(
            'App\Character',
            'character_id'
        );
    }

    public function match()
    {
        return $this->belongsTo(
            'App\Match',
            'match_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            'App\User',
            'user_id'
        );
    }

    public function scopeWon($query)
    {
        return $query->where('result', '=', static::RESULT_WIN);
    }

    public function scopeLost($query)
    {
        return $query->where('result', '=', static::RESULT_LOSS);
    }
}
