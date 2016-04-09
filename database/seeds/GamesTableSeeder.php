<?php

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
        App\Game::create([
            'name' => 'Heroes of Newerth',
            'abbreviation' => 'HON',
            'character_term' => 'hero'
        ]);
    }
}
