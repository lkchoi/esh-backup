<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'username' => 'lkchoi',
            'email' => 'lkchoi@email.com',
            'password' => 'password'
        ]);
        factory(App\User::class, 20)->create();
    }
}
