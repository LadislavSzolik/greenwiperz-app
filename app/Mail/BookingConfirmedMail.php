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
            'bookingDate' => $this->booking->appointment->date,
            'bookingTime' => $this->booking->appointment->start_time,
            'bookingPrice' => $this->booking->service_price,
            'bookingVehicle' => $this->booking->bookingService->vehicle_model,
            'bookingNumberPlate' => $this->booking->bookingService->number_plate,
            'bookingColor' => $this->booking->bookingService->vehicle_color,
            'bookingStreet' => $this->booking->bookingService->parking_street_number,
            'bookingRoute' => $this->booking->bookingService->parking_route,
            'bookingCity' => $this->booking->bookingService->parking_city,
            'bookingPostalCode' => $this->booking->bookingService->parking_postal_code,
            'bookingPrice' => $this->booking->invoice->moneyPrice,
            'url' => url('/').'/bookings',
        ]);
    }
}
