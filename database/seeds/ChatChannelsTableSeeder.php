<?php

use App\Chat\Channel;
use Illuminate\Database\Seeder;

class ChatChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channels = [
            ['name' => 'Community Chat'],
            ['name' => 'HearthStone Chat'],
        ];

        foreach ($channels as $channel)
        {
            Channel::create($channel);
        }
    }
}
