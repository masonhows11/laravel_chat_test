<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class OrderStatusUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // public $title;
    public $order;

    /**
     * Create a new event instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
        Log::info("TestEvent fired:" . $this->order->id);
        //
        // $this->title = $title;
        // Log::info("TestEvent fired: " . $this->title);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array
     */
    public function broadcastOn(): array
    {
        // this is custom chanel bro & public chanel
        return [new Channel('order-status-updated')];

        //        return [
        //            new PrivateChannel('channel-name'),
        //        ];
    }
}
