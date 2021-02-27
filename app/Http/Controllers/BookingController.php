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

use App\Datatrans;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Events\BusinessBookingCanceled;
use App\Events\BusinessBookingCompleted;
use App\Events\PrivateBookingCanceled;
use App\Events\PrivateBookingCompleted;
use App\Models\Appointment;
use Illuminate\Support\Facades\App;

/**
 * Class BookingController
 * @package App\Http\Controllers
 */
class BookingController extends Controller
{
    public function __construct() {
       $this->authorizeResource(Booking::class, 'booking');
    }


    public function cancel(Request $request, Booking $booking) {
        if($booking->isCancelAllowed === false ) {
            abort(403, 'Cannot cancel booking');
        }
        if($booking->status === 'paid' && $booking->type = 'private') {
            $refundableAmount = $booking->refundableAmount;
            if(auth()->user()->isGreenwiper() && filled($request['amountToRefund'])) {
                if($request['amountToRefund'] > $booking->brutto_total_amount) {
                    $refundableAmount = $booking->brutto_total_amount;
                }else {
                    $refundableAmount = $request['amountToRefund'];
                }
            }
            Datatrans::handleBookingRefund($booking, $refundableAmount);
        }

        Appointment::where('booking_id', $booking->id)->update(['canceled_at'=> now(), 'canceled_by'=>auth()->user()->id]);
        Booking::where('id',$booking->id)->update(['status'=> 'canceled']);

        if($booking->type == 'private') {
            event(new PrivateBookingCanceled($booking));
        } else {
            event(new BusinessBookingCanceled($booking));
        }

        $request->session()->flash('message',
        [
            'color'=>'green',
            'title'=>'Booking canceled',
            'description'=>'Your booking was canceled. Shortly you will receive a mail about the confirmation.'
        ]);
        return back();
    }

    public function complete(Request $request, Booking $booking)
    {
        if(!auth()->user()->isGreenwiper() || $booking->isCompleteAllowed === false) {
            abort(403);
        }
        if($booking->appointment) {
            $booking->appointment->completed_at = now();
            $booking->appointment->completed_by = auth()->user()->id;
        }
        $booking->status = 'completed';
        $booking->push();
        if($booking->type === 'private') {
            event(new PrivateBookingCompleted($booking));
        } else {
            event(new BusinessBookingCompleted($booking));
        }
        $request->session()->flash('message',
        [
            'color'=>'green',
            'title'=>'Booking completed',
            'description'=>'Nice delivery. The client will receive a confirmation mail soon!'
        ]);
        return back();
    }



    public function destroy(Request $request, Booking $booking)
    {
        if( $booking->appointments) {
            $booking->appointments()->delete();
        }
        if($booking->billingAddress) {
            $booking->billingAddress()->delete();
        }
        if($booking->car) {
            $booking->car()->delete();
        }
        if($booking->fleets) {
            $booking->fleets()->delete();
        }
        $booking->delete();

        $request->session()->flash('message',
        [
            'color'=>'green',
            'title'=>'Booking deleted',
            'description'=>'The booking has been successfully deleted'
        ]);
        return redirect(route('bookings.index'));
    }

    /**
     * Show invoice
     *
     * @param Booking $booking
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function showInvoice(Booking $booking) {
        $this->authorize('update', $booking);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.invoice_de', ['booking' => $booking]);
        return $pdf->stream();
    }

    public function showReceipt(Booking $booking){
        $this->authorize('update', $booking);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.receipt_de', ['booking' => $booking]);
        return $pdf->stream();
    }

    public function showRefund(Booking $booking){
        $this->authorize('update', $booking);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.refund_de', ['booking' => $booking]);
        return $pdf->stream();
    }
}
