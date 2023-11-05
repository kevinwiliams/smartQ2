<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $feedback; // Pass the feedback data to the view

    /**
     * Create a new message instance.
     *
     * @param  array  $feedback
     * @return void
     */
    public function __construct(array $feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Feedback Submitted')
        ->markdown('emails.feedback');
    }
}
