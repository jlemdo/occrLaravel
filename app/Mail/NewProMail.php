<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewProMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $os_id, public $name)
    {
      // print_r($user); 
	  // Exit;
      // dd($randomPassword);
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->view('emails.projectsendemail')
            ->subject('Subject: Your Custom Solar Proposal from Helio GreenTech')
            ->with(['logoPath' => public_path('profile/logo.png')]);
    }
}
