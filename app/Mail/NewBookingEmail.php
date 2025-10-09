<?php

namespace App\Mail;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewBookingEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public User $user)
    {
       
        
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->view('emails.newbookingmail')
            ->subject('New Booking From Holiogt')
            ->with(['logoPath' => public_path('profile/logo.png')]);
    }
}
