<?php

namespace App\Http\Livewire\Appointment;

use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;

class Appointments extends Component
{
    use WithSorting;
    use WithPagination;

    public $showModal = false;
    public $showSingle = false;
    protected $queryString = ['sortField','sortDirection'];
    protected $listeners = ['saved'];

    public function mount()
    {
        $this->sortField = 'date';
        $this->sortDirection = 'desc';   
    }

    public function create()
    {       
        $this->emit('modalOpened'); 
        $this->showModal = true;
    }

    public function save()
    {
        if($this->showSingle) {
            $this->emit('saveSingle');               
        } else {
            $this->emit('saveMultiple');               
        }   
    }

    // listener
    public function saved()
    {
        $this->showModal = false;
    }

    public function delete(Appointment $appointment)
    {
        $appointment->delete();
    }

    public function getRowsProperty()
    {
        $query = Appointment::where('is_vacation', 1);
        return $this->applySorting($query)->paginate(30);
    }

    public function render()
    {
        return view('livewire.appointment.appointments', ['appointments' => $this->rows]);
    }
}
