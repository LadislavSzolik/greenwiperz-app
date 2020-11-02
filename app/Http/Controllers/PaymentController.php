<?php

namespace App\Http\Controllers;

use App\Datatrans;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
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
            'refno'=> $booking->refno, 
            'amount'=> $booking->service_price, 
            'autoSettle' => true,
            'redirect' => 
                ['successUrl' => url('/').'/payments/handlePaymentSucceeded',
                'cancelUrl' => url('/').'/payments/handlePaymentCancelled',
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
        if (!Arr::exists($request, 'datatransTrxId')) {  
            abort(400, 'Transaction id not provided...');
        }        
        $datatransTrxId = $request['datatransTrxId'];
        $response = Datatrans::checkTransactionStatus($datatransTrxId);       
        $booking = Booking::where('transaction_id', $response['transactionId'])->firstOrFail();       
        
        if(!$this->isRequestValid($response, $booking)) {
            abort(400, 'The request not valid...');
        }
       
        $userId = $booking->user_id;
        if(!Auth::check()) {
            Auth::loginUsingId($userId);
        }       
        
        // delete previous payment if it was failed.
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
            'detail_auth_authcode' => $response['detail']['authorize']['acquirerAuthorizationCode'],
            'detail_settle_amount' => $response['detail']['settle']['amount'],                              
            'paid_at' => Carbon::now(),
        ]);             
        
        $request->session()->flash('success', $booking->id);
        return redirect()->route('bookings.index');
    }





    public function handlePaymentCancelled(Request $request) {
        
        if (!Arr::exists($request, 'datatransTrxId')) {  
            abort(400);
        }        
        $datatransTrxId = $request['datatransTrxId'];
        $response = Datatrans::checkTransactionStatus($datatransTrxId);       
        
        $booking = Booking::where('transaction_id', $response['transactionId'])->get()->first();       
        
        if($this->isRequestValid($response, $booking)) {
            abort(401);
        }

        $userId = $booking->user_id;
        if(!Auth::check()) {
            Auth::loginUsingId($userId);
        }

        if($this->isCancelResponse($response['status'])) {            
            $booking->delete();
        }
        $request->session()->flash('cancel', 'Your booking has been canceled. You were not charged.');
        return redirect()->route('bookings.index');
    }

    // User makes a mistake and returns to the payment page
    public function handlePaymentFailed(Request $request) {

        if (!Arr::exists($request, 'datatransTrxId')) {  
            abort(400, "Missing transaction Id...");
        }        
        $datatransTrxId = $request['datatransTrxId'];
        $response = Datatrans::checkTransactionStatus($datatransTrxId);       
        
        $booking = Booking::where('transaction_id', $response['transactionId'])->get()->first();       
        
        if(!$this->isRequestValid($response, $booking) ) {
            abort(400, 'Request is invalid...');
        }
        
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
        
        return redirect()->route('bookings.show',['id'=> $booking->id]);
    }

    protected function isRequestValid($response, Booking $booking) {
        if($response->status() > 299) {            
            return false;
        }
        if($booking->payment != null && $booking->payment->status == 'settled' ){         
            return false;
        }
        if($booking->refno != $response['refno']) {                 
            return false;
        }
        return true;
    }


    public function isCancelResponse(string $status) {
        return $status =='canceled';
    }

    public function isFailResponse(string $status) {
        return $status =='failed';
    }

}
