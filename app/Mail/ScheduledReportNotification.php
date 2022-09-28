<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScheduledReportNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $mailmessage;
    public $filename;
    public $pdf;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailmessage, $filename, $pdf)
    {
        $this->mailmessage = $mailmessage;
        $this->filename = $filename;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.scheduledreport')->attachData($this->pdf, $this->filename . '.pdf', [
            'mime' => 'application/pdf',
        ]);
    }
}
