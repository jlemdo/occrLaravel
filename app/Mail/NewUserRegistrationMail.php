<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewUserRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public User $user, Public $randomPassword)
    {
     // print_r($user); exit;
      //  dd($randomPassword);
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->view('emails.useregistrationemail')
            ->subject('Holiogt Registration')
            ->with(['logoPath' => public_path('profile/logo.png')]);
    }
}
