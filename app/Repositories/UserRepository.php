<?php

namespace App\Repositories;

use App\Role;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container as App;

class UserRepository extends Repository
{
    /**
     * Get leaders
     * @return Illuminate\Database\Query\Builder
     */
    public function leaders()
    {
        // match_count_subquery
        $mcsq = 'SELECT COUNT(*) FROM `roles` WHERE `roles`.`user_id`=`users`.`id`';

        // win_count_subquery
        $wcsq = $mcsq . ' AND `roles`.`result`=' . Role::RESULT_WIN;

        // loss_count_subquery
        $lcsq = $mcsq . ' AND `roles`.`result`=' . Role::RESULT_LOSS;

        // return query builder

        return DB::table('users')->select([
                'users.id',
                'users.username',
                DB::raw("({$wcsq}) AS `win_count`"),
                DB::raw("({$lcsq}) AS `loss_count`"),
                DB::raw("({$mcsq}) AS `match_count`"),
                DB::raw("(({$wcsq})/({$mcsq})) AS `win_ratio`"),
                DB::raw('SUM(`matches`.`payout`) AS `earnings`'),
            ])
            ->join('roles', 'roles.user_id', '=', 'users.id')
            ->join('matches', 'roles.match_id', '=', 'matches.id')
            ->where('roles.result', '=', Role::RESULT_WIN)
            ->groupBy('users.id')
            ->orderBy('earnings', 'desc');
    }
}