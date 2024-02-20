<?php

namespace App\Mail;

use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteStaffNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $invite;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Invitation $invite, $url)
    {
        $this->invite = $invite;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->subject('New Invitation WaitWise')
        ->markdown('emails.invitation.staff');
    }
}
