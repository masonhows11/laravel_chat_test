<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
//use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageDeleteEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public string $message_id;
    public string $roomId;
    /**
     * Create a new event instance.
     */
    public function __construct($roomId,$message_id ,User $user)
    {
        //
        $this->user = $user;
        $this->message_id = $message_id;
        $this->roomId = $roomId;
    }

    public function broadcastWith(): array
    {
        return ['message_id' => $this->message_id,
                'user_id' => $this->user->id];
    }
    public function broadcastAs(): string
    {
        return 'message.delete';
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
            new PresenceChannel('chat.'.$this->roomId)
        ];
    }
}
