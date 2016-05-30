<?php

namespace App\Events;

use App\Chat\Message;
use App\Events\Event;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class CreateMessageEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $message;
    public $channel;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
        $this->channel = $message->channel;
        $this->user = $message->user;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ["{$this->message->channel->slug}"];
    }
}
