<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Match;
use Illuminate\Http\Request;

class MatchesController extends Controller
{
    public function index(Request $request)
    {
        $query = Match::closed();

        if ($request->game_id)
        {
            $query = $query->where('game_id', '=', $game_id);
        }

        $matches = $query->with('game','winner.user','loser.user')->paginate();

        return $matches->items();
    }
}
