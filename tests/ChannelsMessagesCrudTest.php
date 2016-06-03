<?php

use App\Chat\Channel;
use App\Chat\Message;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ChannelsMessagesCrudTest extends TestCase
{
    use DatabaseMigrations;

    public function testChannelMessagesIndex()
    {
        factory(User::class, 3)->create();

        factory(Channel::class)
            ->create()
            ->messages()
            ->saveMany(factory(Message::class, 5)->make());

        factory(Channel::class)
            ->create()
            ->messages()
            ->saveMany(factory(Message::class, 7)->make());

        // get channel 1 messages
        $json = $this->json('GET', '/api/v1/channels/1/messages')
            ->assertResponseStatus(200)
            ->decodeResponseJson();
        $data = count($json['data']);
        $this->assertEquals(5, $data);

        // get channel 2 messages
        $json = $this->json('GET', '/api/v1/channels/2/messages')
            ->assertResponseStatus(200)
            ->decodeResponseJson();
        $data = count($json['data']);
        $this->assertEquals(7, $data);

        // get channel 3 messages (non-existent)
        $this->json('GET', '/api/v1/channels/3/messages')
            ->assertResponseStatus(404);
    }

    public function testChannelMessagesArePaginated()
    {
        factory(User::class, 5)
            ->create();

        factory(Channel::class)
            ->create()
            ->messages()
            ->saveMany(factory(Message::class, 20)->make());

        $json = $this->json('GET', '/api/v1/channels/1/messages')
            ->assertResponseStatus(200)
            ->decodeResponseJson();
        $this->assertEquals(10, count($json['data']));
    }

    public function testCreateMessage()
    {
        // fixtures
        $user = factory(User::class)->create();
        $channel = Channel::create([
            'name' => 'Community Chat'
        ]);

        $this->seeInDatabase('users', ['email' => $user->email]);

        // hit the api
        $url = "/api/v1/channels/1/messages";
        $content =  'This is just a test message!';
        $data = [
            'api_token' => $user->api_token,
            'content' => $content,
        ];
        $json = $this->json('POST', $url, $data)
            ->assertResponseStatus(201)
            ->decodeResponseJson();

        // parse the response
        $this->assertEquals($content, $json['content']);
    }

    public function testCreateMessageBroadcastsEvent()
    {
        $this->markTestIncomplete();
    }

}
