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

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class AppointmentTimeController
 * @package App\Http\Controllers
 */
class AppointmentTimeController extends Controller
{
    /**
     * Update appointment date and time
     *
     * @param Request $request
     * @param Appointment $appointment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Appointment $appointment)
    {
        $duration = $appointment->booking->duration;
        $appointment->date = $request['start_date'];
        $appointment->start_time = $request['start_time'];
        $appointment->end_time = Carbon::parse($request['start_time'])->addMinutes($duration - 1)->format('H:i');
        $appointment->save();
        // @todo: send email to client
        return back();
    }
}
