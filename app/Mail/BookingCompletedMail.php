<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;

class BookingCompletedMail extends Mailable
{
    use Queueable, SerializesModels;

    private $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Greenwiperz Completion')->markdown('emails.bookings.completed')->with([
            'bookingNumber' => $this->booking->booking_nr,
            'bookingDateTime' => $this->booking->datetime,            
            'bookingCar' => $this->booking->car_model,
            'bookingNumberPlate' => $this->booking->number_plate,
            'bookingColor' => $this->booking->car_color,
            'bookingStreet' => $this->booking->loc_street_number,
            'bookingRoute' => $this->booking->loc_route,
            'bookingCity' => $this->booking->loc_city,
            'bookingPostalCode' => $this->booking->loc_postal_code,                        
            'rating_url' => URL::signedRoute('ratings.create', ['user' => $this->booking->customer->id]),
            'bookings_url' => url('/').'/bookings',
        ]);
    }
}
