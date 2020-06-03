<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email, $link, $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $link, $name)
    {
        $this->email = $email;
        $this->link = $link;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {        
        return $this->subject(__('auth.resetPassword'))->markdown('emails.forgot')->with(['email' => $this->email, 'link' => $this->link, 'name' => $this->name]);
    }
}
