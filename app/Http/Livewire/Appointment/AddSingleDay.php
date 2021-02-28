<?php

namespace App\Http\Livewire\Appointment;

use App\Models\Appointment;
use App\Models\Timeslot;
use Livewire\Component;

class AddSingleDay extends Component
{

    public Appointment $editing;
    public $timeslots;

    protected $listeners = ['saveSingle', 'modalOpened'];

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

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->editing = $this->createBlank();
        $this->timeslots = Timeslot::all()->pluck('timeslot');
    }

    public function createBlank()
    {
        return Appointment::make(['date'=> now(), 'is_vacation' => 1, 'assigned_to' => auth()->user()->id ]);
    }

    // listener
    public function modalOpened()
    {
        $this->editing = $this->createBlank();
    }

    // listener
    public function saveSingle()
    {
        $this->validate();
        $this->editing->save();
        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.appointment.add-single-day');
    }
}
