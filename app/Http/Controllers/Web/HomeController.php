<?php

namespace App\Http\Controllers\Web;

use App\Chat\Channel;
use App\Http\Requests;
use App\Match;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matches = Match::closed()
            ->with(['game', 'teams.user'])
            ->orderBy('created_at','desc')
            ->limit(10)
            ->get();

        $users = User::leaders()->limit(10)->get();

        $channel = Channel::first();

        $user = auth()->user();
        \JS::put([
            'auth' => empty($user) ? null : [
                'id' => $user->id,
                'username' => $user->username,
                'api_token' => $user->api_token,
            ],
            'api_token' => $user ? $user->api_token : null
        ]);

        return view('home', compact('matches','users','channel'));
    }
}
