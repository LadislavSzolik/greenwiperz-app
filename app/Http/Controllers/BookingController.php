<?php

namespace App\Http\Controllers;

use Exception;
use App\Datatrans;
use Carbon\Carbon;
use App\Models\Booking;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Events\BookingCanceled;
use App\Events\BookingCompleted;
use App\Models\Appointment;
use App\TimeslotService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;

class BookingController extends Controller
{
    public function __construct()
    {
       $this->authorizeResource(Booking::class, 'booking');
    }

    public function show(Booking $booking)
    {     
        return view('bookings.show', ['booking' => $booking] );
    }


    public function cancel(Request $request, Booking $booking) 
    {              
        $booking->appointment->canceled_at = now();
        $booking->appointment->canceled_by = auth()->user()->id;
        $booking->appointment->save();
        $booking->status = 'canceled';
        $booking->save();
       
        $refundableAmount = $booking->refundableAmount;
        if(auth()->user()->isGreenwiper() && filled($request['amountToRefund'])) {
            if($request['amountToRefund'] > $booking->brutto_total_amount) {
                $refundableAmount = $booking->brutto_total_amount;
            }else {
                $refundableAmount = $request['amountToRefund'];
            }                       
        }       
        Datatrans::handleBookingRefund($booking, $refundableAmount);
        event(new BookingCanceled($booking));
        $request->session()->flash('message',
        [
            'color'=>'green',
            'title'=>'Booking canceled', 
            'description'=>'Your booking was canceled. About refunds see for refunds document for details. Shortly you will receive a mail about the confirmation.'
        ]);
        return back();
    }

    public function complete(Request $request, Booking $booking)
    {
        $booking->appointment->completed_at = now();
        $booking->appointment->completed_by = auth()->user()->id;
        $booking->appointment->save();
        $booking->status = 'completed';
        $booking->save();

        if($booking->type === 'private') {
            event(new BookingCompleted($booking));
        }
        //TODO: Add business mail
        

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
        if( $booking->appointment) {
            $booking->appointment()->delete();
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
        return redirect()->route('bookings.index');
    }

    
    public function showInvoice(Booking $booking) {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.invoice_de', ['booking' => $booking]);    
        return $pdf->stream();
    }

    public function showReceipt(Booking $booking){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.receipt_de', ['booking' => $booking]); 
        return $pdf->stream();  
    }

    public function showRefund(Booking $booking){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('pdf.refund_de', ['booking' => $booking]); 
        return $pdf->stream();  
    }        
}
