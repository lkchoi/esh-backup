<?php

namespace App\Http\Controllers\Web;

use App\Character;
use App\Game;
use App\Http\Requests;
use App\Http\Requests\CreateMatchRequest;
use App\Match;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // status
        $status = $request->get('status');

        switch ($status)
        {
            case 'open':
            $list_title = 'Open Matches';
            $matches = Match::open()
                ->orderBy('created_at', 'desc')
                ->paginate();
            break;

            case 'closed':
            $list_title = 'Recent Matches';
            $matches = Match::closed()->paginate();
            break;

            default:
            $list_title = 'Matches';
            $matches = Match::paginate();
            break;
        }

        return view('matches.index', compact('matches','list_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $games = Game::get();
        $characters = Character::get();
        return view('matches.create', compact('games','characters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMatchRequest $request)
    {
        $role = new Role([
            'character_id' => $request->character_id ?: null,
            'user_id' => $request->user()->id,
            'result' => Role::RESULT_TBD,
        ]);

        $match = new Match([
            'game_id' => $request->game_id,
            'payout' => $request->payout,
        ]);

        DB::transaction(function() use ($role, $match) {
            \Log::info(compact('role','match'));
            $match->save();
            $match->roles()->save($role);
        });

        return redirect("/matches/{$match->id}");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $match = Match::with('roles.user')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
