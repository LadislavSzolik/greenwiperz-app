<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
  
    public function index()
    {        
        return view('bookings.index', ['bookings' => auth()->user()->bookings]);
    }

    
    public function create(Request $request)
    {       
        
        return view('bookings.create', ['draftBooking' => $request->session()->pull('draftBooking')]);
    }

    public function store(Request $request)
    {
        //
    }

    public function success(Request $request) {
     
        return view('bookings.success');
    }

  
    public function show($id)
    {
        return view('bookings.show', ['booking' => Booking::findOrFail($id)] );
    }


    // to be removed
    public function review(Request $request) {

        $paymentDetails = null;
        $booking = null;
        if($request->session()->has('newBooking')) {
            $booking = $this->retrieveBookingFromSession($request);
            $paymentDetails = $this->retrievePaymentDetails($booking);
        }
        return view('bookings.review',['newBooking'=> $booking, 'paymentDetails' => $paymentDetails ]);
    }

    public function retrieveBookingFromSession(Request $request) {
        return $booking = $request->session()->pull('newBooking');
    }


    public function retrievePaymentDetails($booking) {
        $paymentDetails = [
            'merchantId' => 1100026445,
            'amount' => 100 * $booking['service_price'],
            'currency' => 'CHF', 
            'refno' => 1,                        
        ];   

        $binaryKey = hex2bin('c8c468f12382a4eac3fd1f536157af70d2a97b952b4ff8d1122fba82a1e5d739660fae58ef8afdb0b670301822598077f812cd99e0a7690ab7a439c41c0892f0');        
        $sign = hash_hmac('sha256', implode($paymentDetails),$binaryKey);
        $paymentDetails['sign'] =  $sign;

        return $paymentDetails;
    }


    public function edit(Booking $booking)
    {
        //
    }

 
    public function update(Request $request, Booking $booking)
    {
        //
    }


    public function destroy(Booking $booking)
    {
        //
    }
}
