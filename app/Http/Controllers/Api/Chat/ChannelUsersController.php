<?php

namespace App\Http\Controllers\Api\Chat;

use App\Chat\Channel;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;

class ChannelUsersController extends Controller
{
    public function index(Request $request, $channel_id)
    {
        $channel = Channel::find($channel_id);

        if ($channel)
        {
            switch ($channel->type)
            {
                case 'public':
                    $users = User::get();
                break;

                case 'private':
                break;

                case 'invitation':
                break;
            }
            return $users;
        }

        return abort(404, 'Could not find channel');
    }
}
