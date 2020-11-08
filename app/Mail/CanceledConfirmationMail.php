<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CanceledConfirmationMail extends Mailable
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
        return $this->subject('Greenwiperz cleaning canceled')->markdown('emails.bookings.canceled')->with([
            'bookingNumber' => $this->booking->booking_nr,
            'bookingDate' => $this->booking->bookingTimeslot->date,
            'bookingTime' => $this->booking->bookingTimeslot->start_time,
            'bookingPrice' => $this->booking->service_price,
            'bookingVehicle' => $this->booking->bookingService->vehicle_model,
            'bookingNumberPlate' => $this->booking->bookingService->number_plate,
            'bookingColor' => $this->booking->bookingService->vehicle_color,
            'bookingStreet' => $this->booking->bookingService->parking_street_number,
            'bookingRoute' => $this->booking->bookingService->parking_route,
            'bookingCity' => $this->booking->bookingService->parking_city,
            'bookingPostalCode' => $this->booking->bookingService->parking_postal_code,
            'bookingPrice' => $this->booking->invoice->moneyPrice,
            'refundedAmount' => $this->booking->refund->moneyRefundedAmount,
            'url' => url('/').'/bookings',
        ]);
    }
}
