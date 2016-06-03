<?php

use App\Game;
use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = [
            [
                'name' => 'Hearthstone',
                'abbreviation' => 'HS',
                'character_term' => 'deck'
            ],
            [
                'name' => 'League of Legends',
                'abbreviation' => 'LOL',
                'character_term' => 'champion'
            ],
            [
                'name' => 'Dota 2',
                'abbreviation' => 'Dota2',
                'character_term' => 'hero'
            ],
        ];

        foreach ($games as $game)
        {
            Game::create($game);
        }
    }
}
