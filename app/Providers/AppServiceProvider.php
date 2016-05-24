<?php

namespace App\Providers;

use App\Chat\Channel;
use App\Game;
use App\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::saving(function($user) {

            // hash the password
            if ($user->isDirty('password'))
            {
                $user->password = bcrypt($user->password);
            }
        });

        Channel::saving(function($channel) {

            // slugify the channel name
            if ($channel->isDirty('name')) {
                $channel->slug = str_slug($channel->name);
            }
        });

        Game::saving(function($game) {

            // slugify the game name
            if ($game->isDirty('name')) {
                $game->slug = str_slug($game->name);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
