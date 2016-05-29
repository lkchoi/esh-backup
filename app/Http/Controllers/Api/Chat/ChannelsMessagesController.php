<?php

namespace App\Http\Controllers\Api\Chat;

use App\Chat\Channel;
use App\Chat\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

class ChannelsMessagesController extends Controller
{
    public function index(Request $request, $channel_id)
    {
        $channel = Channel::with('messages.user')->find($channel_id);

        if ($channel)
        {
            $messages = collect($channel->messages);
            return $messages;
        }

        return abort(404, 'Could not find channel');
    }
}
