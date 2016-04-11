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
        'password' => 'asdfasdf', // bcrypt(str_random(10)),
        'remember_token' => null, // str_random(10),
    ];
});

$factory->define(App\Match::class, function (Faker\Generator $faker) {
    return [
        'game_id' => 1,
        'payout' => $faker->randomElement([200,500,1000])
    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    $matches = App\Match::count();
    $users = App\User::count();
    $characters = App\Character::count();
    return [
        'match_id' => $faker->numberBetween(1, $matches),
        'user_id' => $faker->numberBetween(1, $users),
        'character_id' => $faker->numberBetween(1, $characters),
    ];
});