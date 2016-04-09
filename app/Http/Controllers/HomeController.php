<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Match;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matches = Match::with(['game', 'roles.user'])
            ->orderBy('created_at','desc')
            ->paginate();
        return view('home', compact('matches'));
    }
}
