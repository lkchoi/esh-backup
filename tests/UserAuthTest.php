<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Auth;

class UserAuthTest extends TestCase
{
    use DatabaseMigrations;

    protected $user = [
        'username' => 'colorz',
        'email' => 'colorz@email.com',
    ];

    public function testUserCreateWithHashedPassword()
    {
        $this->dontSeeInDatabase('users', $this->user);
        $user = User::create($this->user + ['password' => 'secret']);
        $this->assertFalse(empty($user->id));
        $this->assertFalse($user->password === 'secret');
        $this->seeInDatabase('users', $this->user);
    }

    public function testUserAuthAttempt()
    {
        $user = User::create($this->user + ['password' => 'secret']);
        $this->assertTrue(Auth::attempt([
            'email' => $this->user['email'],
            'password' => 'secret'
        ]));
        $this->assertFalse(Auth::attempt([
            'email' => $this->user['email'],
            'password' => 'badpassword'
        ]));
    }

    public function testUserChangePassword()
    {
        $user = User::create($this->user + ['password' => 'secret']);
        $this->assertTrue(Auth::attempt([
            'email' => $this->user['email'],
            'password' => 'secret'
        ]));

        $user->password = 'new_password';
        $this->assertTrue($user->save());

        $this->assertFalse(Auth::attempt([
            'email' => $this->user['email'],
            'password' => 'secret'
        ]));

        $this->assertTrue(Auth::attempt([
            'email' => $this->user['email'],
            'password' => 'new_password'
        ]));
    }
}
