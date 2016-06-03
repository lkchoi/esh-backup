<?php

namespace App;

use App\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Match extends Model
{
    protected $perPage = 10;

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

    public function teams()
    {
        return $this->hasMany(
            'App\Team',
            'match_id'
        );
    }

    public function winner()
    {
        return $this->hasOne(
            'App\Team',
            'match_id'
        )->where('result', '=', Team::RESULT_WIN);
    }

    public function loser()
    {
        return $this->hasOne(
            'App\Team',
            'match_id'
        )->where('result', '=', Team::RESULT_LOSS);
    }

    public function getAmountAttribute()
    {
        return sprintf('$%d', $this->payout/100);
    }

    public function scopeClosed($query)
    {
        $team_count_subquery = DB::raw(
            '(select count(*) from `teams` where `teams`.`match_id`=`matches`.`id`)'
        );
        return $query->where($team_count_subquery, '>', 1);
    }

    public function scopeOpen($query)
    {
        $team_count_subquery = DB::raw(
            '(select count(*) from `teams` where `teams`.`match_id`=`matches`.`id`)'
        );
        return $query->where($team_count_subquery, '<', 2);
    }
}
