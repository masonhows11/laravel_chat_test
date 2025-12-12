<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
//use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
//use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSentEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $message;
    public $roomId;
    /**
     * Create a new event instance.
     */
    public function __construct($roomId,Message $message ,User $user)
    {
        //
        $this->user = $user;
        $this->message = $message;
        $this->roomId = $roomId;
    }

    // send data with broadcastWith method
    public function broadcastWith(): array
    {
        return ['message' => $this->message->message,
                'sender' => $this->user->name,
                'user_id' => $this->user->id,
                'id' => $this->message->id];
    }

    public function broadcastAs()
    {
        return 'message.sent';
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            // new PrivateChannel('channel-name'),

            // new PrivateChannel('chat.' . $this->user->id),
            new PresenceChannel('chat.' . $this->roomId),
        ];
    }
}
