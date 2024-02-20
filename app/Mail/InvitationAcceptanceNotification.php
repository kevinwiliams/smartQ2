<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationAcceptanceNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $name;
    public $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $name, $email)
    {
        $this->username = $username;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
             
        return $this->subject('Invitation Accepted')
        ->markdown('emails.invitation.accepted');        
    }
}
