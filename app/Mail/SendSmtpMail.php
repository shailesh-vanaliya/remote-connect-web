<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSmtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //print_r($this->details);exit();
        if ($this->details['mailTitle'] == 'forgot') {
            return $this->subject($this->details['subject'])->view('emails.forgot-mail');
        } else if ($this->details['mailTitle'] == 'register') {
            return $this->subject($this->details['subject'])->view('emails.register-mail');
        }

    }
}
