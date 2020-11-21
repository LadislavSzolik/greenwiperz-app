<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;

class Appointments extends Component
{
    use WithPagination;
    
    public $showModal = false;
    public Appointment $editing;
    public $timeslots;


    public function rules()
    {
        return [
            'editing.date_for_editing' => 'required',
            'editing.start_time' => 'required',
            'editing.end_time' => 'required',
            'editing.is_vacation' => 'required',
            'editing.assigned_to' => 'required',
            'editing.comment' => 'sometimes',            
        ];
    }

    public function mount()
    {                
        $this->timeslots = ['08:00', '10:00', '12:00','14:00','16:00','18:00'];
        $this->editing = Appointment::make(['date'=> now(), 'is_vacation' => 1, 'assigned_to' => auth()->user()->id ]);
                      
    }

    public function create()
    {
         //TODO: make it possible to assign to other
        $this->editing = Appointment::make(['date'=> now(), 'is_vacation' => 1, 'assigned_to' => auth()->user()->id ]);
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();     
        $this->editing->save();
        $this->showModal = false;
    }

    public function delete(Appointment $appointment)
    {
        $appointment->delete();
    }

    public function render()
    {
        return view('livewire.appointments', [
            'appointments' => Appointment::where('is_vacation', 1)->paginate(10),
        ]);
    }
}
