<?php

namespace App\Http\Controllers\Api\Chat;

use App\Chat\Channel;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{
    /**
     * Get a specific channel
     * @param  Channel $channel  via route-model binding
     * @return Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        if ($channel->exists())
        {
            return $channel;
        }

        return abort(404, 'Could not find channel');
    }
}
