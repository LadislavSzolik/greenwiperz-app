<?php

namespace App\Http\Livewire\Appointment;

use App\Models\Appointment;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Component;

class AddMultipleDays extends Component
{
    public $date_from;
    public $date_to;
    public $comment;
    protected $listeners = ['saveMultiple','modalOpened'];
    protected $rules = [
        'date_from' => 'required|date',
        'date_to' => 'required|date',
        'comment' => 'sometimes',
    ];

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->initDates();
    }

    // listener
    public function saveMultiple()
    {
        $this->validate();
        $date_from = new Carbon($this->date_from);
        $date_to = new Carbon($this->date_to);
        while($date_from->lessThanOrEqualTo($date_to)) {
            Appointment::create([
                'date'=> $date_from,
                'start_time'=> '07:00:00',
                'end_time'=>'18:00:00' ,
                'is_vacation' => 1,
                'assigned_to' => auth()->user()->id,
                'comment' => $this->comment,
            ]);
            $date_from = $date_from->addDay();
        }
        $this->emit('saved');
    }

    // listener
    public function modalOpened()
    {
        $this->initDates();
    }

    public function initDates()
    {
        $this->date_from = Carbon::now('GMT+2')->format('Y-m-d');
        $this->date_to = Carbon::now('GMT+2')->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.appointment.add-multiple-days');
    }
}
