<?php

namespace App\Http\Controllers;

use Exception;
use App\Datatrans;
use Carbon\Carbon;
use App\Models\Booking;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Events\BookingCanceled;
use Illuminate\Support\Facades\App;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Booking::class, 'booking');
    }


    public function index()
    {     
        $bookings = Booking::where('user_id', auth()->user()->id )->whereNull('completed_at')->paginate(10);     
        return view('bookings.index', ['bookings' => $bookings ]);
    }


    public function create(Request $request)
    {

        return view('bookings.create');
    }


    public function show(Booking $booking)
    {      
        return view('bookings.show', ['booking' => $booking] );
    }


    public function cancel(Request $request, Booking $booking) {

        $response = Datatrans::checkTransactionStatus($booking->transaction_id);
    
        
        if($response['status'] == 'authorized' || $response['status'] == 'settled' || $response['status'] == 'transmitted') {

            $bookingTime = $booking->appointment->carbonDate;
            $hoursBeforeCleaning = Carbon::now()->diffInMinutes($bookingTime);
            
            $settledAmount = $booking->receipt->settled_amount;
            
            if( $hoursBeforeCleaning < 60) {
                $amountToRefund = 0;
            } else if($hoursBeforeCleaning < 120 && $hoursBeforeCleaning >= 60){
                $amountToRefund = $settledAmount * 0.2;
            } else if($hoursBeforeCleaning < 180  && $hoursBeforeCleaning >= 120){
                $amountToRefund = $settledAmount * 0.5;
            } else if($hoursBeforeCleaning >= 180){
                $amountToRefund = $settledAmount;
            } else {
                $amountToBeRefund = 0;
            }

            $intvalueOfAmountToRefund = intval($amountToRefund);
           
            $payload = [
                'currency' => 'CHF',
                'refno' => $booking->booking_nr,
                'amount' => $intvalueOfAmountToRefund,
            ];
            
            $response = Datatrans::refundTransaction($booking->transaction_id, $payload );

            if($response->status() < 299 && Arr::exists($response, 'transactionId') ) {                                                
                $responseStatusCheck = Datatrans::checkTransactionStatus($response['transactionId']);   
                // needs to type=credit
                $booking->refund()->create([
                    'user_id' => $booking->user_id,
                    'refund_nr' =>  $this->generateRefundNumber(),
                    'price'             => $booking->invoice->price,
                    'netto_price'       => $booking->invoice->netto_price,
                    'mwst_percent'      => $booking->invoice->mwst_percent,
                    'mwst_id'           => config('greenwiperz.company.mwst_id'), 
                    'transaction_id'    => $responseStatusCheck['transactionId'],
                    'refunded_amount'    => $responseStatusCheck['detail']['settle']['amount'],
                ]);
                $booking->transaction_id =  $responseStatusCheck['transactionId'];                
            }
           
        }
        $booking->canceled_at = now();            
        $booking->canceled_by = auth()->user()->id;
        $booking->save();  
        $booking->appointment->canceled_at = now();
        $booking->appointment->save();

        event(new BookingCanceled($booking));

        $request->session()->flash('canceled', 'Your booking has been canceled.');
       
        return back();
    }

    

    
    public function destroy(Request $request, Booking $booking)
    {              
        $booking->appointment()->forceDelete();    
        $request->session()->flash('deleted', 'The booking has been successfully deleted.');
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

    protected function generateRefundNumber()
    {       
        $baseNumberStructure = [     
            'receipt_id' => 'REF',       
            'date' => Carbon::now('GMT+2')->format('U'),
            'divider2' => '-',
            'userid' => str_pad(auth()->user()->id, 4, "0", STR_PAD_LEFT),
        ];
        return implode($baseNumberStructure);
    }

}
