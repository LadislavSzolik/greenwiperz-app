<?php

namespace App\Http\Controllers;

use Exception;
use App\Datatrans;
use Carbon\Carbon;
use App\Models\Booking;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Events\BookingConfirmed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{


    public function redirectToDatatrans(Request $request) {              
        if (!Arr::exists($request, 'id')) {  
            abort(400, 'Booking id missing...');
        }   
       
        $booking = Booking::findOrFail($request['id']);
        
        // construct payload and init transaction
        $payload = [
            'currency'=>'CHF', 
            'refno'=> $booking->booking_nr, 
            'amount'=> $booking->brutto_total_amount, 
            'autoSettle' => true,
            'redirect' => 
                ['successUrl' => url('/').'/payments/handlePaymentSucceeded',
                'cancelUrl' => url('/').'/payments/handlePaymentCanceled',
                'errorUrl' => url('/').'/payments/handlePaymentFailed',
                'method' => 'POST',
                ]
        ];
        $response = Datatrans::initiateTransaction($payload);         
        
        // update the tranaction id on booking. will be compared after redirect
        if (Arr::exists($response, 'transactionId')) {               
            $booking->transaction_id = $response['transactionId'];  
            $booking->status = 'pending';
            $booking->save();
        } else {
            abort(400, 'Transaction id was not recieved...');
        }
        
        // use the link from header to redirect
        $redirectLink = '/';
        if (Arr::exists($response->headers(), 'Location')) {  
            $redirectLink = $response->headers()['Location'][0];  
        } else {
            abort(400, 'Location missing...');
        }       
        return redirect($redirectLink);
    }




    public function handlePaymentSucceeded(Request $request)
    {         
        
        // TODO: add the signature check as middleware
        if (!Arr::exists($request, 'datatransTrxId')) {  
            abort(400, 'Transaction id not provided...');
        }        
        $datatransTrxId = $request['datatransTrxId'];
        $response = Datatrans::checkTransactionStatus($datatransTrxId);       
        $booking = Booking::where('transaction_id', $response['transactionId'])->where('booking_nr',$response['refno'])->whereStatus('pending')->firstOrFail();       
        
        $userId = $booking->customer_id;
        if(!Auth::check()) {
            Auth::loginUsingId($userId);
        }     
                                          
        $booking->receipt()->create([            
            'receipt_nr'        => $this->generateReceiptNumber(),                     
            'paid_amount'    =>  $response['detail']['settle']['amount'],
            'paid_with'         => $response['paymentMethod'],
            'transaction_id'    => $response['transactionId'],
        ]);     
        $booking->status = 'paid';              
        $booking->save();        
        event(new BookingConfirmed($booking));
        
        $request->session()->flash('message',
        [
            'color'=>'green',
            'title'=>'Booking Confirmation', 
            'description'=>'Your booking was successful. We received your funds. Shortly you will receive a mail about the confirmation.'
        ]);
        return redirect()->route('bookings.show',['booking' => $booking->id]);
    }



    /** 
    *
    *
    *
    */
    public function handlePaymentCanceled(Request $request) {       
        // TODO: add the signature check as middleware
        if (!Arr::exists($request, 'datatransTrxId')) {  
            abort(400, 'Transaction id missing...');
        }               
       
        $response = Datatrans::checkTransactionStatus($request['datatransTrxId']);       
        if($response['status'] != 'canceled') {
            abort(400, 'It is not a cancel request...');
        }      
         
        $booking = Booking::where('transaction_id', $response['transactionId'])->where('booking_nr',$response['refno'])->whereStatus('pending')->firstOrFail();         
               
        $userId = $booking->customer_id;
        if(!Auth::check()) {
            Auth::loginUsingId($userId);
        }       
            
        $request->session()->flash('message',
        [
            'color'=>'yellow',
            'title'=>'Payment canceled', 
            'description'=>'The payment has been canceled. If you want to complete this booking please proceed to payment again.'
        ]);       
        
        return view('bookings.review', ['booking' => $booking]); 
    }

    /** 
    *
    *
    *
    */
    public function handlePaymentFailed(Request $request) {

        if (!Arr::exists($request, 'datatransTrxId')) {  
            abort(400, "Missing transaction Id...");
        }        
        
        $datatransTrxId = $request['datatransTrxId'];
        $response = Datatrans::checkTransactionStatus($datatransTrxId);   
        if($response['status'] != 'failed') {
            abort(400, 'Wrong request sent to this url...');
        }  
          
        $booking = Booking::where('transaction_id', $response['transactionId'])->where('booking_nr',$response['refno'])->whereStatus('pending')->firstOrFail();           
        if(!Auth::check()) {
            Auth::loginUsingId($booking->customer_id);
        }    
        
        $request->session()->flash('message',
        [
            'color'=>'red',
            'title'=>'Payment failed', 
            'description'=>'The payment failed. No transaction was made. If you want to complete this booking please proceed to payment again.'
        ]);             
        return view('bookings.review', ['booking' => $booking]); 
    }
    



    protected function generateReceiptNumber()
    {       
        $baseNumberStructure = [     
            'receipt_id' => 'REC',       
            'date' => Carbon::now('GMT+2')->format('U'),
            'divider2' => '-',
            'userid' => str_pad(auth()->user()->id, 4, "0", STR_PAD_LEFT),
        ];
        return implode($baseNumberStructure);
    }

}
