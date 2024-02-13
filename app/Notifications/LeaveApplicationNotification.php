<?php

namespace App\Notifications;

use App\Models\Leave;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveApplicationNotification extends Notification
{
    use Queueable;

    public $leaves;
    public $managerId;
    public $message;


    /**
     * Create a new notification instance.
     */
    public function __construct(Leave $leaves, $managerId, $message)
    {
        $this->leaves = $leaves;
        $this->managerId = $managerId;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    
    public function toBroadcast($notifiable)
    {
        $userId = $notifiable->id; 

        return [
            'message' => "Pengajuan #{$this->leaves->code} baru saja diajukan",
            'leave_code' => $this->leaves->code,
            'manager_id' => $this->managerId, // Sertakan informasi manager_id dalam broadcast
        ];
    }
}
