<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewDocMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $link, public $name)
    {
     // print_r($user); exit;
     // dd($randomPassword);
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->view('emails.contractsendemail')
            ->subject('Holiogt : Your contract link')
            ->with(['logoPath' => public_path('profile/logo.png')]);
    }
}
