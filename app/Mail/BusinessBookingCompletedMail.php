<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class BusinessBookingCompletedMail extends Mailable
{
    use Queueable, SerializesModels;

    private $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        return $this->subject(__('Booking confirmation'))->markdown('emails.bookings.business.completed')->with([
            'booking_nr' => $this->booking->booking_nr,
            'numberOfCars' => $this->booking->totalNumberOfCars,                        
            'street_number' => $this->booking->loc_street_number,
            'route' => $this->booking->loc_route,
            'city' => $this->booking->loc_city,
            'postal_code' => $this->booking->loc_postal_code,    
            'rating_url' => URL::signedRoute('ratings.create', ['user' => $this->booking->customer->id]),
            'url' => url('/').'/bookings',
        ]);
    }
}
