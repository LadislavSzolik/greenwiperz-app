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

    protected $queryString = ['sortField','sortDirection'];

    public function mount()
    {
        $this->sortField = 'date';
        $this->sortDirection = 'desc';
    }

    public function getRowsProperty()
    {
        $isGreenwiper = auth()->user()->isGreenwiper();

        $query = Booking::query()
        ->when(!$isGreenwiper, fn($query) => $query->where('customer_id', auth()->user()->id));
        return $this->applySorting($query)->paginate(10);
    }
    
    public function render()
    {        
        return view('livewire.bookings', ['bookings'=> $this->rows]);
    }
}
