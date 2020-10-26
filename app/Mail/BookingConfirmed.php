<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingConfirmed extends Mailable
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
            'bookingDate' => $this->booking->bookingTimeslot->date,
            'bookingTime' => $this->booking->bookingTimeslot->start_time,
            'bookingPrice' => $this->booking->service_price,
            'bookingVehicle' => $this->booking->vehicle_model,
            'bookingNumberPlate' => $this->booking->number_plate,
        ]);
    }
}
