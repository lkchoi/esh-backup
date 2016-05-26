<?php

namespace App;

use App\Role;
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

    public function roles()
    {
        return $this->hasMany(
            'App\Role',
            'match_id'
        );
    }

    public function winner()
    {
        return $this->hasOne(
            'App\Role',
            'match_id'
        )->where('result', '=', Role::RESULT_WIN);
    }

    public function loser()
    {
        return $this->hasOne(
            'App\Role',
            'match_id'
        )->where('result', '=', ROLE::RESULT_LOSS);
    }

    public function getAmountAttribute()
    {
        return sprintf('$%d', $this->payout/100);
    }

    public function scopeClosed($query)
    {
        $role_count_subquery = DB::raw(
            '(select count(*) from `roles` where `roles`.`match_id`=`matches`.`id`)'
        );
        return $query->where($role_count_subquery, '>', 1);
    }

    public function scopeOpen($query)
    {
        $role_count_subquery = DB::raw(
            '(select count(*) from `roles` where `roles`.`match_id`=`matches`.`id`)'
        );
        return $query->where($role_count_subquery, '<', 2);
    }
}
