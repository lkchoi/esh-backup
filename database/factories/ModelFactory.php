<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->userName,
        'email' => $faker->safeEmail,
        'password' => 'secret', // hashed by AppServiceProvider
        'api_token' => str_random(60),
    ];
});

$factory->define(App\Match::class, function (Faker\Generator $faker) {
    $num_games = App\Game::count();
    return [
        'game_id' => $faker->numberBetween(1,$num_games),
        'payout' => $faker->randomElement([200,500,1000])
    ];
});

$factory->define(App\Team::class, function (Faker\Generator $faker) {
    $matches = App\Match::count();
    $users = App\User::count();
    return [
        'match_id' => $faker->numberBetween(1, $matches),
        'user_id' => $faker->numberBetween(1, $users),
    ];
});

$factory->define(App\Chat\Channel::class, function (Faker\Generator $faker) {
    return [
        'name' => $name = $faker->words(3,true),
        'slug' => str_slug($name),
    ];
});

$factory->define(App\Chat\Message::class, function (Faker\Generator $faker) {
    $users = App\User::count();
    $channels = App\Chat\Channel::count();
    $timestamp = $faker->dateTimeBetween('-3 weeks');

    return [
        'user_id' => $faker->numberBetween(1, $users),
        'channel_id' => $faker->numberBetween(1, $channels),
        'content' => $faker->sentences(
            $faker->numberBetween(1,4),
            true
        ),
        'created_at' => $timestamp,
        'updated_at' => $timestamp
    ];
});