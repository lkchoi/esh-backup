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

    protected $appends = [
        'logo'
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

    public function getLogoAttribute()
    {
        return $this->images()->first()->url;
    }

    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }
}
