<?php

use App\Game;
use App\Image;
use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = Game::pluck('id','slug');

        $game_images = [
            ['url' => '/img/games/logos/dota-2/16d1cb55ff8b69a6267e0e5483949bc3b7abdb42.png', 'imageable_id' => $games['dota-2']],
            ['url' => '/img/games/logos/hearthstone/784c561b01b9d9f2174a7607add590b348c33e94.png', 'imageable_id' => $games['hearthstone']],
            ['url' => '/img/games/logos/league-of-legends/561a2b960739d6e330af44d0fdcd8b5646f15fb7.png', 'imageable_id' => $games['league-of-legends']],
        ];

        foreach ($game_images as $game_image)
        {
            Image::create(array_merge($game_image, ['imageable_type' => 'App\Game']));
        }
    }
}
