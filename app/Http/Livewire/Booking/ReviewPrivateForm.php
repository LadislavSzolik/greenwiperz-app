<?php

namespace App\Http\Livewire\Booking;

use App\Models\Booking;
use Livewire\Component;

class ReviewPrivateForm extends Component
{
    public Booking $booking;
    
    public function render()
    {        
        return view('livewire.booking.review-private-form');
    }

    public function destroy()
    {
        $this->booking->appointments()->delete();        
        $this->booking->billingAddress()->delete();      
        $this->booking->car()->delete();
        return redirect()->route('bookings.private.create');
    }

    public function submit()
    {        
        return redirect()->route('payments.redirect',['id'=>$this->booking->id]);
    }
}
