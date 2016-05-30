<?php

use App\Chat\Channel;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ChannelsCrudTest extends TestCase
{
    use DatabaseMigrations;

    public function testGetChannelShow()
    {
        factory(User::class, 3)->create();
        factory(Channel::class, 5)->create();

        $json = $this->json('GET', '/api/v1/channels/1')
            ->assertResponseStatus(200)
            ->decodeResponseJson();
    }
}
