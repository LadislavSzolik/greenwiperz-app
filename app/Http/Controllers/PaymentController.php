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
            'amount'=> $booking->invoice->price, 
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

        $booking = Booking::where('transaction_id', $response['transactionId'])->where('booking_nr',$response['refno'])->whereNull('paid_at')->firstOrFail();       
        
        $userId = $booking->user_id;
        if(!Auth::check()) {
            Auth::loginUsingId($userId);
        }                                        
       
        $booking->receipt()->create([
            'user_id'           => $userId,
            'receipt_nr'        => $this->generateReceiptNumber(),
            'price'             => $booking->invoice->price,
            'netto_price'       => $booking->invoice->netto_price,
            'mwst_percent'      => $booking->invoice->mwst_percent,
            'mwst_id'           => config('greenwiperz.company.mwst_id'), 
            'transaction_id'    => $response['transactionId'],
            'settled_amount'    => $response['detail']['settle']['amount'],
            'paid_with'         => $response['paymentMethod'],
        ]);                       
        $booking->paid_at = now();
        $booking->save();
        
       
        event(new BookingConfirmed($booking));
       
        $request->session()->flash('success', $booking->id);
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
        if(!$this->isCancelResponse($response['status'])) {
            abort(400, 'It is not a cancel request...');
        }       
        $booking = Booking::where('transaction_id', $response['transactionId'])->where('booking_nr',$response['refno'])->whereNull('paid_at')->firstOrFail();                    
        $userId = $booking->user_id;
        if(!Auth::check()) {
            Auth::loginUsingId($userId);
        }                   
        return redirect()->route('bookings.show', ['booking' => $booking->id]);
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
        
        // TODO: enhance the query
        $booking = Booking::where('transaction_id', $response['transactionId'])->firstOrFail();       
        
        $userId = $booking->user_id;
        if(!Auth::check()) {
            Auth::loginUsingId($userId);
        }       
        
        // does it have another error?
        if($booking->payment != null && $booking->payment->status == 'failed') {            
            $booking->payment->forceDelete();
        }
       
        Auth::user()->payments()->create([
            'booking_id' => $booking->id,
            'transaction_id' => $response['transactionId'],
            'type' => $response['type'],
            'status' => $response['status'],
            'currency' => $response['currency'],
            'refno' => $response['refno'],
            'payment_method' => $response['paymentMethod'],
            'detail_auth_amount' => $response['detail']['authorize']['amount'],              
            'detail_fail_reason' => $response['detail']['fail']['reason'],                              
            'detail_fail_msg' => $response['detail']['fail']['message'],                              
        ]);    
        
        return redirect()->route('bookings.show',['booking'=> $booking]);
    }



    public function isCancelResponse(string $status) {
        return $status =='canceled';
    }

    public function isFailResponse(string $status) {
        return $status =='failed';
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
