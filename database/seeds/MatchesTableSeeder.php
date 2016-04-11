<?php

use App\Role;
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
        factory('App\Match', 150)->create()->each(function ($match) {
            $winner = factory(App\Role::class)->make();
            $loser = factory(App\Role::class)->make();
            $winner->result = Role::RESULT_WIN;
            $loser->result = Role::RESULT_LOSS;
            $match->roles()->saveMany([$winner, $loser]);
        });

        factory('App\Match', 10)->create()->each(function ($match) {
            $role = factory(App\Role::class)->make();
            $role->result = Role::RESULT_TBD;
            $match->roles()->saveMany([$role]);
        });
    }
}
