<?php

namespace App\Http\Livewire;

use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Booking;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Bookings extends Component
{
    use WithPagination;
    use WithSorting;

    public $showPast;
    public $showCanceled;

    protected $queryString = ['sorts'];

    public function getRowsProperty()
    {
        $isGreenwiper = auth()->user()->isGreenwiper();

        $query = Booking::query()
        ->when(!$isGreenwiper, fn($query) => $query->where('customer_id', auth()->user()->id))
        ->when(!$this->showPast, fn($query) => $query->where('booking_datetime', '>=', Carbon::now()))
        ->when(!$this->showCanceled, fn($query) => $query->where('status', '<>', 'canceled'));
        return $this->applySorting($query)->paginate(20);
    }
    
    public function render()
    {        
        return view('livewire.bookings', ['bookings'=> $this->rows]);
    }
}
