<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingCommentController extends Controller
{
    public function store(Request $request, Booking $booking)
    {        
        $booking->internal_notes = $request['internal_notes'];
        $booking->save();

        return back();
    }
}
