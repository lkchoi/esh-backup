<?php

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
        Image::create([
            'url' => '/img/games/heroes-of-newerth-logo-2.png',
            'imageable_id' => 1,
            'imageable_type' => 'App\Game'
        ]);

        foreach (range(1,132) as $id)
        {
            Image::create([
                'url' => "/img/characters/{$id}.jpg",
                'imageable_id' => $id,
                'imageable_type' => 'App\Character'
            ]);
        }
    }
}
