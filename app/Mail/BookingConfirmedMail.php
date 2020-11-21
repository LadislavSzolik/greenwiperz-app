<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingConfirmedMail extends Mailable 
{
    use Queueable, SerializesModels;

    private $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }


    public function build()
    {                
        return $this->subject('Greenwiperz cleaning confirmed')->markdown('emails.bookings.confirmed')->with([
            'bookingNumber' => $this->booking->booking_nr,
            'bookingDateTime' => $this->booking->appointment->date,
            'bookingPrice' => $this->booking->brutto_total_amount,
            'bookingVehicle' => $this->booking->car->car_model,
            'bookingNumberPlate' => $this->booking->car->number_plate,
            'bookingColor' => $this->booking->car->car_color,
            'bookingStreet' => $this->booking->loc_street_number,
            'bookingRoute' => $this->booking->loc_route,
            'bookingCity' => $this->booking->loc_city,
            'bookingPostalCode' => $this->booking->loc_postal_code,            
            'url' => url('/').'/bookings',
        ]);
    }
}
