<?php

namespace App\Listeners;

use App\Events\LeaveApplicationEvent;
use App\Events\LeavesApplicationEvent;
use App\Models\Leave;
use App\Models\User;
use App\Notifications\LeaveApplicationNotification;
use App\Notifications\LeavesApplicationNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LeavesApplicationListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */

    
    use InteractsWithQueue;

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $userLevel = $event->userLevel;
        $leaves = $event->leaves;

        if ($userLevel == 4) {
            // User level 4, send notification to manager_id and coo_id
            $this->notifyManagerAndCoo($event);
        } elseif ($userLevel == 3) {
            // User level 3, send notification to manager_id and user himself
            $this->notifyManagerAndUser($event);
        }
    }

    protected function notifyManagerAndCoo(LeaveApplicationEvent $event): void
    {
        $this->sendNotification($event->leaves, $event->managerId, "Pengajuan #{$event->leaves->code} baru saja diajukan");
        $this->sendNotification($event->leaves, $event->cooId, "Pengajuan #{$event->leaves->code} baru saja diajukan");
        $this->sendNotification($event->leaves, $event->leaves->user_id, "Anda telah mengajukan cuti dengan code #{$event->leaves->code}");

    }

    protected function notifyManagerAndUser(LeaveApplicationEvent $event): void
    {
        $this->sendNotification($event->leaves, $event->managerId, "Pengajuan #{$event->leaves->code} baru saja diajukan");
        $this->sendNotification($event->leaves, $event->leaves->user_id, "Anda telah mengajukan cuti dengan code #{$event->leaves->code}");
    }

    protected function sendNotification(Leave $leaves, $recipientId, $message): void
    {
        $user = User::find($recipientId);
        $user->notify(new LeaveApplicationNotification($leaves, $recipientId, $message));
    }
    
}
