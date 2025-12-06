<?php

namespace App\Events;

// use Illuminate\Broadcasting\Channel;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;

// use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $task;
    private $user;

    /**
     * Create a new event instance.
     */
    public function __construct($task, User $user)
    {
        $this->task = $task;
        $this->user = $user;
    }

    public function broadcastAs(): string
    {
        return 'task.added';
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int>
     */
    public function broadcastOn(): array
    {
        return [
            // this is public channel
            // new Channel('tasks')

            // this is private channel
            // new PrivateChannel('tasks.'.$this->user->id),
            new PresenceChannel('tasks.'.$this->user->id),
            // new PrivateChannel('chat.'.$this->user->id),
            new PresenceChannel('chat.' . $this->user->id),
        ];
    }
}
