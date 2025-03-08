<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TransferNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName, $amountTransfer, $now, $userAccNumber;

    public function __construct($userName, $amountTransfer, $now, $userAccNumber)
    {
        $this->userName         = $userName;
        $this->amountTransfer   = $amountTransfer;
        $this->now              = $now;
        $this->userAccNumber    = $userAccNumber;
    }

    public function build()
    {
        return $this->subject('Pemberitahuan Transfer Dana')
                    ->view('emails.transfer-notification')
                    ->with([
                        'userName'      => $this->userName,
                        'amount'        => $this->amountTransfer,
                        'now'           => $this->now,
                        'userAccNumber' => $this->userAccNumber
                    ]);
    }
}
