<?php

namespace App;

use App\Chat\Message;
use App\Match;
use App\Repositories\HasRepositories;
use App\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

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
        'updated_at',
        'api_token',
    ];

    protected $casts = [
        'win_count' => 'int',
        'loss_count' => 'int'
    ];

    protected $appends = [
        'win_count',
        'loss_count',
        'match_count',
        'total_earnings',
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
     * Relation: User has many messages
     * @return Illuminate\Database\Eloquent\Relations\Relation
     */
    public function messages()
    {
        return $this->hasMany(
            Message::class,
            'user_id',
            'id'
        );
    }

    public function getTotalEarningsAttribute()
    {
        return $this->earnings();
    }

    public function getMatchCountAttribute()
    {
        return $this->matches()->count();
    }

    public function getWinCountAttribute()
    {
        return $this->wins()->count();
    }

    public function getLossCountAttribute()
    {
        return $this->losses()->count();
    }

    public function generateApiToken()
    {
        do {
            $api_token = str_random(60);
        } while ( static::where('api_token', '=', $api_token)->exists() );

        return $api_token;
    }
}
