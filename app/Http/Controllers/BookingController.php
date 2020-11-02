<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function index()
    {     
        return view('bookings.index', ['bookings' => auth()->user()->bookings->sortByDesc('id')]);
    }


    public function create(Request $request)
    {

        return view('bookings.create');
    }

    public function store(Request $request)
    {                  
        $bookingData = $request->session()->pull('bookingData');         
        $bookingTimeslot = $request->session()->pull('bookingTimeslot');               
       
        $booking = auth()->user()->bookings()->create($bookingData);
        $booking->bookingTimeslot()->create($bookingTimeslot);
       
        return redirect()->route('payments.redirect', ['id' => $booking->id]);
        
        
    }

    public function success(Request $request) {

        return view('bookings.success');
    }


    public function show($id)
    {
        return view('bookings.show', ['booking' => Booking::findOrFail($id)] );
    }



    public function edit(Booking $booking)
    {
        //
    }


    public function update(Request $request, Booking $booking)
    {
        //
    }


    public function destroy(Request $request, $id)
    {        
      $booking = Booking::findOrFail($id);
      $booking->bookingTimeslot()->forceDelete();
      $booking->forceDelete();      
      $request->session()->flash('deleted', 'The booking has been successfully deleted.');
      return redirect()->route('bookings.index');
    }
}
