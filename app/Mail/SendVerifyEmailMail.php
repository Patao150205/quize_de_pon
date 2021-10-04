<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendVerifyEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($temporary_user)
    {
        $this->temporary_user = $temporary_user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->view('mail.verify-email-mail', ['user' => $this->temporary_user])->subject('クイズでぽん！！本会員登録のお願い')->to($this->temporary_user->email);
    }
}
