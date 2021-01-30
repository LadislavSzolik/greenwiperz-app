<?php

namespace App\Http\Livewire\Bookingtimeslot;

use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;

class BookingTimeslots extends Component
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

        $query = Appointment::query()
        ->when(!$isGreenwiper, fn($query) => $query->where('user_id', auth()->user()->id));
        return $this->applySorting($query)->paginate(10);
    }

    public function render()
    {
        return view('livewire.bookingtimeslot.booking-timeslots',['appointments'=>$this->rows]);
    }
}
