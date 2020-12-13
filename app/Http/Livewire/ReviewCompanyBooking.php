<?php

namespace App\Http\Livewire;

use App\Events\CompanyBookingEntered;
use App\Models\Booking;
use App\Models\Fleet;
use Livewire\Component;

class ReviewCompanyBooking extends Component
{
    public Booking $booking;

    public Fleet $smallCars;
    public Fleet $mediumCars;
    public Fleet $largeCars;
    public Fleet $xlargeCars;

    public function mount()
    {
        $this->smallCars = $this->booking->fleets()->where('car_size','=','small')->first() ?? Fleet::make();
        $this->mediumCars = $this->booking->fleets()->where('car_size','=','medium')->first() ?? Fleet::make();
        $this->largeCars = $this->booking->fleets()->where('car_size','=','large')->first() ?? Fleet::make();
        $this->xlargeCars = $this->booking->fleets()->where('car_size','=','x-large')->first() ?? Fleet::make();
    }

    public function destroy()
    {
        $this->booking->billingAddress()->delete();              
        return redirect()->route('bookings.company.create');
    }

    public function submit()
    {
        session()->flash('message',
        [
            'color'=>'green',
            'title'=>'Confirmation', 
            'description'=>'Thank you very much for your order, we have recorded the cleaning in our system. Our staff will contact you shortly by phone to clarify the exact time.'
        ]);

        $this->booking->status = 'pending';
        $this->booking->tc_accepted_at = now();
        $this->booking->save();

        event(new CompanyBookingEntered($this->booking));
        
        return redirect()->route('bookings.show', ['booking'=>$this->booking->id]);    
    }
    
    public function render()
    {
        return view('livewire.review-company-booking');
    }
}
