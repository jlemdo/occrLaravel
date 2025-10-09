<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public Booking $booking)
    {
       
        
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->view('emails.bookingapprovalemail')
            ->subject('Holiogt Booking Status')
            ->with(['logoPath' => public_path('profile/logo.png')]);
    }
}
