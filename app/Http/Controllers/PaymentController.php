<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class PaymentController extends Controller
{

    public function index()
    {
        //
    }



    public function handlePaymentSucceeded(Request $request)
    {
        $booking = $this->getBookingOrFail($request['refno']);

        //check if the payment is valid
        $isAccepted = $this->isPaymentAccepted($booking->service_price,1100026445, $request['uppTransactionId']);
        if(! $isAccepted) {
            $request->session()->flash('failure', 'Payment was not proccessed accordinly. Please contact us.');
        }

        //check if the user is valid
        $userId = $booking->user_id;

        if(!Auth::check()) {
            Auth::loginUsingId($userId);
        }


        //if all good continue
        Auth::user()->payments()->create([
            'booking_id' => $booking->id,
            'refno' => $request['refno'],
            'amount' => $request['amount'],
            'currency' => $request['currency'],
            'uppTransactionId' => $request['uppTransactionId'],
            'pmethod' => $request['pmethod'],
            'reqtype' => $request['reqtype'],
            'uppMsgType' => $request['uppMsgType'],
            'status' => $request['status'],
            'paid_at' => Carbon::now(),
        ]);
        // setup the success flash indicator
        $request->session()->flash('success', $booking->id);
        return redirect()->route('bookings.index');
    }

    protected function isPaymentAccepted($amount, $merchantId, $uppTransactionId){
        $xml = '
        <?xml version="1.0" encoding="UTF-8" ?>
        <statusService version="5">
          <body merchantId="'.$merchantId.'">
            <transaction>
              <request>
                <uppTransactionId>'.$uppTransactionId.'</uppTransactionId>
                <reqtype>STX</reqtype>
              </request>
            </transaction>
          </body>
        </statusService>
        ';
       $response = Http::withBasicAuth('1100026445', 'MG04T2JRi4mXCSJD')->withHeaders(['Content-Type' => 'text/xml; charset=UTF8'])->withBody( $xml, 'text/xml; charset=UTF8')->post('https://api.sandbox.datatrans.com/upp/jsp/XML_status.jsp');

       $xmlObject = simplexml_load_string($response->body());

       return $xmlObject->body['status'] == 'accepted' && $xmlObject->body->transaction->response->amount == $amount;
    }

    public function handleCancelPayment(Request $request) {
        $booking = $this->getBookingOrFail($request['refno']);

        $userId = $booking->user_id;
        if(!Auth::check()) {
            Auth::loginUsingId($userId);
        }

        if($this->isCancelResponse($request['status'])) {
            $booking->delete();
        }
        $request->session()->flash('cancel', 'Your booking has been canceled. You were not charged.');
        return redirect()->route('bookings.index');
    }

    // User makes a mistake and returns to the payment page
    public function handleErrorPayment(Request $request) {
        $booking = $this->getBookingOrFail($request['refno']);

        $userId = $booking->user_id;
        if(!Auth::check()) {
            Auth::loginUsingId($userId);
        }

        if($this->isErrorResponse($request['status'])) {
          //if all good continue
          Auth::user()->payments()->create([
              'booking_id' => $booking->id,
              'refno' => $request['refno'],
              'amount' => $request['amount'],
              'currency' => $request['currency'],
              'uppTransactionId' => $request['uppTransactionId'],
              'pmethod' => $request['pmethod'],
              'reqtype' => $request['reqtype'],
              'uppMsgType' => $request['uppMsgType'],
              'status' => $request['status'],
              'errorCode' => $request['errorCode'],
              'errorMessage' => $request['errorMessage'],
              'errorDetail' => $request['errorDetail'],
          ]);
        }
        return redirect()->route('bookings.show',['id'=> $booking]);
    }



    public function getBookingOrFail(string $refno){
        return Booking::where('refno',$refno)->firstOrFail();
    }

    public function isCancelResponse(string $status) {
        return $status =='cancel';
    }

    public function isErrorResponse(string $status) {
        return $status =='error';
    }

}
