<?php

use Illuminate\Database\Seeder;

class MatchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Match', 20)->create()->each(function ($match) {
            $match->roles()->saveMany(factory(App\Role::class, 2)->make());
        });
    }
}
