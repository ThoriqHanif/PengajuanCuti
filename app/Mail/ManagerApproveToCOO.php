<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ManagerApproveToCOO extends Mailable
{
    use Queueable, SerializesModels;

    public $leave;
    public $cooName;
    public $managerName;
    /**
     * Create a new message instance.
     */
    public function __construct($leave)
    {
        $this->leave = $leave;
        $this->cooName = $leave->user->coo->full_name;
        $this->managerName = $leave->user->manager->full_name;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Permohonan Cuti',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.manager-to-coo',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
