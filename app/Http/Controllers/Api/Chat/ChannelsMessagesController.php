<?php

namespace App\Http\Controllers\Api\Chat;

use App\Chat\Channel;
use App\Chat\Message;
use App\Events\CreateMessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\CreateMessageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ChannelsMessagesController extends Controller
{
    public function index(Channel $channel)
    {
        return $channel->messages()->paginate();
    }

    /**
     * Store the chat message and broadcast via Redis
     * @param  CreateMessageRequest $request
     * @param  Channel              $channel via route-model-binding
     * @return Illuminate\Http\Response
     */
    public function store(CreateMessageRequest $request, Channel $channel)
    {
        // save the message
        $message = new Message($request->only('content'));
        $message->user_id = auth('api')->id();
        $message->channel_id = $channel->id;
        $message->save();

        // broadcast event
        event(new CreateMessageEvent($message));

        // respond with 201
        return response()->json($message, 201);
    }
}
