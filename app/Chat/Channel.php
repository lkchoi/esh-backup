<?php

namespace App\Chat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Channel extends Model
{
    use SoftDeletes;

    protected $table = 'chat_channels';

    protected $fillable = [
        'name',
        // 'slug', // set by AppServiceProvider
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function messages()
    {
        return $this->hasMany(
            Message::class,
            'channel_id',
            'id'
        )->orderBy('created_at','asc');
    }
}
