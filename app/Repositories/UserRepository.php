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
        $mc = sprintf(
            'SELECT COUNT(*)
            FROM `roles`
            WHERE `roles`.`user_id`=`users`.`id`
            AND `roles`.`result` IN (%d,%d)',
            Role::RESULT_WIN,
            Role::RESULT_LOSS
        );

        // win_count_subquery
        $wc = $mc . ' AND `roles`.`result`=' . Role::RESULT_WIN;

        // loss_count_subquery
        $lc = $mc . ' AND `roles`.`result`=' . Role::RESULT_LOSS;

        // return query builder

        return DB::table('users')->select([
                'users.id',
                'users.username',
                DB::raw("({$wc}) AS `win_count`"),
                DB::raw("({$lc}) AS `loss_count`"),
                DB::raw("({$mc}) AS `match_count`"),
                DB::raw("(({$wc})/({$mc})) AS `win_ratio`"),
                DB::raw('SUM(`matches`.`payout`) AS `earnings`'),
            ])
            ->join('roles', 'roles.user_id', '=', 'users.id')
            ->join('matches', 'roles.match_id', '=', 'matches.id')
            ->where('roles.result', '=', Role::RESULT_WIN)
            ->groupBy('users.id');
    }
}