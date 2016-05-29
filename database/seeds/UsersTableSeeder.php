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
        $users = [
            [
                'username' => 'lkchoi',
                'email' => 'lkchoi@email.com',
                'api_token' => '6lJjsIVWBOvQlWMZsNrhAqUK5Hhq8VOxOxrg4UUcL9wOfINklAipnNY9SesZ'
            ],
            [
                'username' => 'jshaw',
                'email' => 'jshaw@email.com',
                'api_token' => 'hKwlFw6Sd0jtjw6rJtrFZaMZnCxtRXlOSMAkj24n8O4TJSgopLOI5pieqJnA'
            ],
            [
                'username' => 'akang',
                'email' => 'akang@email.com',
                'api_token' => 'CfWbkc2GOm2mTpGTsOrwy6ZTRYXaxDzHbBHBzi9gNs319pN88Y9cY0U2r1wK'
            ]
        ];


        foreach ($users as $user)
        {
            App\User::create($user + ['password' => 'secret']);
        }
        factory(App\User::class, 25)->create();
    }
}
