<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmission extends Mailable
{
    use Queueable, SerializesModels;

    public $formFields;

    public function __construct($formFields)
    {
        $this->formFields = $formFields;
    }

    public function build()
    {
        return $this->markdown('emails.contactFormSubmission')
            ->from(env('SENDER_EMAIL_ADDRESS'), 'wfg')
            ->subject('Works for Good Contact Form Submission');
    }
}
