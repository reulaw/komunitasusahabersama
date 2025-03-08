<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $resetUrl;
    public $userName;

    public function __construct($resetUrl, $userName)
    {
        $this->resetUrl = $resetUrl;
        $this->userName = $userName;
    }

    public function build()
    {
        return $this->subject('Reset Password Anda')
                    ->view('emails.reset-password-email')
                    ->with([
                        'resetUrl'  => $this->resetUrl,
                        'userName'  => $this->userName,
                    ]);
    }
}
