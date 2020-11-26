<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Bookings extends Component
{
    use WithPagination;

    public $showPast;
    public $showCanceled;
    
    public function render()
    {
        if(auth()->user()->isGreenwiper()) 
        {
            $bookings = auth()->user()->assignedBookings()
            ->when(!$this->showPast, function ($query) {
                return $query->where('booking_datetime','>=', Carbon::now());
            })
            ->when(!$this->showCanceled, function ($query) {
                return $query->where('status', '<>', 'canceled');
            })
            ->orderBy('booking_datetime','asc')->paginate(20);     
        } else
        {
            $bookings = auth()->user()->bookings()        
            ->when(!$this->showPast, function ($query) {
                return $query->where('booking_datetime','>=', Carbon::now());
            })
            ->when(!$this->showCanceled, function ($query) {
                return $query->where('status', '<>', 'canceled');
            })
            ->orderBy('booking_datetime','asc')->paginate(20);     
        }
        return view('livewire.bookings', ['bookings'=> $bookings]);
    }
}
