<?php

use App\Match;
use App\Team;
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
        factory(Match::class, 150)->create()->each(function ($match) {
            $winner = factory(App\Team::class)->make();
            $loser = factory(App\Team::class)->make();
            $winner->result = Team::RESULT_WIN;
            $loser->result = Team::RESULT_LOSS;
            $match->teams()->saveMany([$winner, $loser]);
        });

        factory(Match::class, 10)->create()->each(function ($match) {
            $team = factory(App\Team::class)->make();
            $team->result = Team::RESULT_TBD;
            $match->teams()->saveMany([$team]);
        });
    }
}
