<?php

use App\Chat\Channel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class HomepageTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHomepageFixtures()
    {
        factory(Channel::class)->create();

        $this->visit('/')
            ->see('Register')
            ->see('Login')
            ->see('Leaderboard')
            ->see('Copyright');
    }
}
