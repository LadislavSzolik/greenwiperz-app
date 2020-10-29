<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function index()
    {
        return view('bookings.index', ['bookings' => auth()->user()->bookings->sort()]);
    }


    public function create(Request $request)
    {

        return view('bookings.create');
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
      $booking = Booking::find($id);
      $booking->bookingTimeslot()->delete();
      $booking->delete();      
      $request->session()->flash('deleted', 'The booking has been successfully deleted.');
      return redirect()->route('bookings.index');
    }
}
