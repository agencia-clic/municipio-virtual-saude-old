<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class channelMedicalCare implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    protected $IdServiceUnits;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($IdServiceUnits)
    {
        $this->IdServiceUnits = $IdServiceUnits;
    }

    public function join()
    {
        logger('hey');
        return $this->groupId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel("medical-care.{$this->IdServiceUnits}");
    }
}
