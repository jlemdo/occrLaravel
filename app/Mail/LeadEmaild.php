<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LeadEmaild extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $messageContent, public $subject)
    {
      //print_r($subject); 
	  // Exit;
      // dd($randomPassword);
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->view('emails.leademail')
            ->subject('Subject: '. $this->subject)
            ->with(['logoPath' => public_path('profile/logo.png')]);
    }
}
