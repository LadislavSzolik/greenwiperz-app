<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;

class PrivateBookingCompletedMail extends Mailable
{
    use Queueable, SerializesModels;

    private $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }
    
    public function build()
    {
        return $this->subject(__('Greenwiperz Completion'))->markdown('emails.bookings.private.completed')->with([
            'booking_nr' => $this->booking->booking_nr,
            'appointments' => $this->booking->appointments,                      
            'car' => $this->booking->car->car_model,
            'number_plate' => $this->booking->car->number_plate,
            'color' => $this->booking->car->car_color,
            'street_number' => $this->booking->loc_street_number,
            'route' => $this->booking->loc_route,
            'city' => $this->booking->loc_city,
            'postal_code' => $this->booking->loc_postal_code,                        
            'rating_url' => URL::signedRoute('ratings.create', ['user' => $this->booking->customer->id]),
            'bookings_url' => url('/').'/bookings',
        ]);
    }
}
