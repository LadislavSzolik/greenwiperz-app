<?php

namespace App\Http\Livewire\Bookingtimeslot;

use App\Events\BusinessBookingConfirmed;
use App\Events\CompanyBookingConfirmed;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Timeslot;
use App\TimeslotService;
use Carbon\Carbon;
use Livewire\Component;

class EditBookingTimeslot extends Component
{
    
    public Appointment $appointment;    
    public $appointmentsOnDay = [];
    public $timeslots = [];

    protected $rules = [
        'appointment.date_for_editing' => 'required',
        'appointment.start_time' => 'required',
        'appointment.end_time' => 'required',        
        'appointmentsOnDay' => 'sometimes',
    ];

    public function mount()
    {
        // #1 get the bookings which are that day        
        $this->getAppointmentsForThatDay();
        //#2 get the list of possible timeslot
        $this->timeslots = Timeslot::all()->pluck('timeslot');       
    }

    // When you select a new date
    public function updatedAppointmentDateForEditing()
    {
        $this->getAppointmentsForThatDay();
    }

    // When you change 
    public function updatedAppointmentStartTime($newStartDate)
    {                     
        $this->appointment->end_time = Carbon::parse($newStartDate)->addMinutes($this->appointment->booking->duration)->subMinute()->format('H:i:s');
    }

    public function deleteAppointment()
    {
    
        $this->emit('deleteAppointment', $this->appointment->id);
    }

    public function saveAppointment()
    {
        // #1 validate input
        $this->validate();
        $this->appointment->save();
        $this->getAppointmentsForThatDay();
     
     
        $this->emit('saved');
        // TODO: move this out
        
        /*$this->booking->status = 'confirmed';
        $this->booking->push();
        $this->booking->refresh(); */

        //#5 send mail
        //event(new BusinessBookingConfirmed($this->booking));

        //# refresh the page
        //return redirect()->route('bookings.show', ['booking' => $this->booking->id]);
    }

    public function render()
    {
        return view('livewire.bookingtimeslot.edit-booking-timeslot');
    }

    // helper to see all exisiting bookings
    protected function getAppointmentsForThatDay()
    {
        $this->appointmentsOnDay = Appointment::where('date', '=', $this->appointment->date)->get();
    }
}
