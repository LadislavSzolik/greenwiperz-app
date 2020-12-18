<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BusinessCanceledConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    private $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        return $this->subject(__('Greenwiperz canceled'))->markdown('emails.bookings.business.canceled')->with([
            'booking_nr' => $this->booking->booking_nr,
            'date' => $this->booking->date,                  
            'numberOfCars' => $this->booking->totalNumberOfCars,                        
            'street_number' => $this->booking->loc_street_number,
            'route' => $this->booking->loc_route,
            'city' => $this->booking->loc_city,
            'postal_code' => $this->booking->loc_postal_code,           
            'url' => url('/').'/bookings',
        ]);
    }
}
