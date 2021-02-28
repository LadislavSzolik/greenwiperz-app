<?php
/**
 * This file is part of the Greenwiperz project.
 *
 * LICENSE: This source file is subject to version 3.14 of the PrStart license
 * that is available through the world-wide-web at the following URI:
 * https://www.prstart.co.uk/license/  If you did not receive a copy of
 * the PrStart License and are unable to obtain it through the web, please
 * send a note to imre@prstart.co.uk so we can mail you a copy immediately.
 *
 * DESCRIPTION: Greenwiperz
 *
 * @category   Laravel
 * @package    Greenwiperz
 * @author     Imre Szeness <imre@prstart.co.uk>
 * @copyright  Copyright (c) 2021 PrStart Ltd. (https://www.prstart.co.uk)
 * @license    https://www.prstart.co.uk/license/ PrStart Ltd. License
 * @version    1.0.0 (02/02/2021)
 * @link       https://www.prstart.co.uk/laravel-development/greenwiperz/
 * @since      File available since Release 1.0.0
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
