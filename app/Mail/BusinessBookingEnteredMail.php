<?php
/**
 *
 */

declare(strict_types=1);

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class BusinessBookingEnteredMail
 * @package App\Mail
 */
class BusinessBookingEnteredMail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var Booking  */
    private $booking;

    /**
     * BusinessBookingEnteredMail constructor.
     * @param Booking $booking
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * @return BusinessBookingEnteredMail
     */
    public function build()
    {
        return $this->subject(__('Greenwiperz booking'))->markdown('emails.bookings.business.entered')->with([
            'booking_nr' => $this->booking->booking_nr,
            'numberOfCars' => $this->booking->totalNumberOfCars,
            'appointments' => $this->booking->appointments,
            'street_number' => $this->booking->loc_street_number,
            'route' => $this->booking->loc_route,
            'city' => $this->booking->loc_city,
            'postal_code' => $this->booking->loc_postal_code,
            'url' => route('bookings.index'),
        ]);
    }
}
