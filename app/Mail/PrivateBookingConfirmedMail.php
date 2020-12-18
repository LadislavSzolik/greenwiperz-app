<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PrivateBookingConfirmedMail extends Mailable 
{
    use Queueable, SerializesModels;

    private $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }


    public function build()
    {                
        return $this->subject(__('Greenwiperz Booking'))->markdown('emails.bookings.private.confirmed')->with([
            'booking_nr' => $this->booking->booking_nr,
            'date' => $this->booking->date,
            'time' => $this->booking->time,
            'price' => $this->booking->formatedTotalCost,
            'car' => $this->booking->car->car_model,
            'number_plate' => $this->booking->car->number_plate,
            'color' => $this->booking->car->car_color,
            'street_number' => $this->booking->loc_street_number,
            'route' => $this->booking->loc_route,
            'city' => $this->booking->loc_city,
            'postal_code' => $this->booking->loc_postal_code,            
            'url' => url('/').'/bookings',
        ]);
    }
}
