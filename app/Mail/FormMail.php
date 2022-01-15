<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name;
    public $formType;
    PUBLIC $emailBody;
    public function __construct($emailBody = null, $subject = '')
    {
        //
        // $this->name = $from;
        // $this->formType = $formType;
        $this->subject = $subject ? $subject : 'Doctrack System Notification';
        $this->emailBody = $emailBody;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@doctracksystem.com', 'Doctrack System Notification')
                    ->subject($this->subject)
                    ->view('eMail');
    }
}
