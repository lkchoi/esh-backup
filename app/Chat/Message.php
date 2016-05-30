<?php

namespace App\Chat;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $perPage = 10;

    protected $table = 'chat_messages';

    protected $fillable = [
        'content',
        'user_id',
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected $casts = [
        'channel_id' => 'int',
        'user_id' => 'int',
    ];

    public function channel()
    {
        return $this->belongsTo(
            Channel::class,
            'channel_id',
            'id'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'id'
        );
    }
}
