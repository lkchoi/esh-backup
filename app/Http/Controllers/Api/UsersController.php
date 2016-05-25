<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $query = User::leaders();

        // sort
        if ($request->order_by)
        {
            $order = $request->order ?: 'asc';

            $query = $query->orderBy($request->order_by, $order);
        }

        // num results
        if ($request->limit && $request->limit > 0)
        {
            $query = $query->limit($request->limit);
        }

        // page offset
        if ($request->offset && $request->offset > 0)
        {
            $query = $query->offset($request->offset);
        }

        // fetch records
        $users = $query->get();

        return $users;
    }
}
