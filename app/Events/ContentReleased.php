<?php

namespace App\Events;

use App\Models\Content;
use App\Models\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContentReleased implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public $content)
    {
        $notification = new Notification();
        $notification->text = json_encode($this->content);
        $notification->save();

        $this->content['notificationId'] = $notification->id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return ['contents'];
    }

    public function broadcastAs()
    {
        return 'content-released';
    }
}
