<?php

namespace App\Events;

use App\Models\Leave;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LeaveApplicationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $leaves;
    public $managerId;
    public $cooId;
    public $userLevel;


    public function __construct(Leave $leaves, $managerId, $cooId, $userLevel)
    {
        $this->leaves = $leaves;
        $this->managerId = $managerId;
        $this->cooId = $cooId;
        $this->userLevel = $userLevel;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new PrivateChannel('leave-application.' . $this->leaves->manager_id);
    }
}
