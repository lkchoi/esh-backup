<?php

namespace App;

use App\Match;
use App\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Repositories\HasRepositories;

class User extends Authenticatable
{
    /**
     * Apply traits.
     */
    use HasRepositories;

    /**
     * Attached repositories
     * @var array
     */
    protected $repos = [
        'App\Repositories\UserRepository',
    ];

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'created_at',
        'email',
        'password',
        'remember_token',
        'updated_at'
    ];

    /**
     * Relation: User has many roles
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function roles()
    {
        return $this->hasMany(
            'App\Role',
            'user_id'
        );
    }

    /**
     * Pseudo-Relation: User has many Matches through Roles
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function matches()
    {
        return $this->roles()
            ->join('matches', 'roles.match_id', '=', 'matches.id');
    }
    public function getMatchesAttribute()
    {
        return $this->matches()->get(['matches.*']);
    }

    /**
     * Pseudo-Relation: User has many wins (Roles)
     * @return Illuminate\Support\Collection
     */
    public function wins()
    {
        return $this->roles()->won();
    }
    public function getWinsAttribute()
    {
        return $this->wins()->get();
    }

    /**
     * Pseudo-Relation: User has many losses (Roles)
     * @return Illuminate\Support\Collection
     */
    public function losses()
    {
        return $this->roles()->lost();
    }
    public function getLossesAttribute()
    {
        return $this->losses()->get();
    }

    /**
     * User's total earnings
     * @return integer  total earnings
     */
    public function earnings()
    {
        return $this->wins()
            ->join('matches', 'matches.id', '=', 'roles.match_id')
            ->sum('matches.payout');
    }


    /**
     * Get leaders
     * @return Illuminate\Database\Query\Builder
     */
    public static function leaders()
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
