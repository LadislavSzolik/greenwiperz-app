<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CompanyBookingEnteredMail extends Mailable
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

    
    public function build()
    {
        return $this->subject(__('Greenwiperz booking'))->markdown('emails.bookings.company-entered')->with([
            'bookingNumber' => $this->booking->booking_nr,
            'numberOfCars' => $this->booking->totalNumberOfCars,
            'date' => $this->booking->date,                       
            'street_number' => $this->booking->loc_street_number,
            'route' => $this->booking->loc_route,
            'city' => $this->booking->loc_city,
            'postal_code' => $this->booking->loc_postal_code,    
            'url' => url('/').'/bookings',
        ]);
    }
}
