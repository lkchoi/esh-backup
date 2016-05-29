<?php

namespace App\Http\Controllers\Api\Chat;

use App\Chat\Channel;
use App\Chat\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\CreateMessageRequest;
use Illuminate\Http\Request;

class ChannelsMessagesController extends Controller
{
    public function index(Channel $channel)
    {
        if ($channel)
        {
            return $channel->messages;
        }

        return abort(404, 'Could not find channel');
    }

    public function store(CreateMessageRequest $request, Channel $channel)
    {
        $message = new Message($request->only('content'));
        $message->user_id = auth()->id();
        $message->channel_id = $channel->id;

        return $message;
    }
}
