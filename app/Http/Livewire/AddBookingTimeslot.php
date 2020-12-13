<?php

namespace App\Http\Livewire;

use App\Events\CompanyBookingConfirmed;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Timeslot;
use App\TimeslotService;
use Carbon\Carbon;
use Livewire\Component;

class AddBookingTimeslot extends Component
{

    public Booking $booking;  
    public $end_time;
    public $appointmentsOnDay = [];
    public $timeslots = [];

    protected $rules = [
        'booking.date' => 'required',
        'booking.time' => 'required',
        'end_time' => 'required',
        'appointmentsOnDay' => 'sometimes',
    ];

    public function mount()
    {       
        $this->getAppointmentsForThatDay();
        $this->timeslots = Timeslot::all()->pluck('timeslot');

        if($this->booking->appointment)
        {
            $this->end_time = $this->booking->appointment->end_time;
        }
    }

    public function updatedBookingDate()
    {        
       $this->getAppointmentsForThatDay();
    }

    public function getAppointmentsForThatDay()
    {
        $this->appointmentsOnDay = Appointment::where('date','=',$this->booking->date)->get(); 
    }
 

    public function saveAppointment()
    {
        $this->validate();

        if( $this->booking->appointment) {
            $id = $this->booking->appointment->id;
            $this->booking->appointment()->dissociate();
            $this->booking->save();
            Appointment::destroy($id);            
        }
        $appointment = Appointment::create([
            'date' => $this->booking->date,
            'start_time' => $this->booking->time,
            'end_time' => Carbon::parse($this->end_time)->format('H:i'),
            'assigned_to' =>$this->booking->assigned_to,
        ]);               
        $this->booking->appointment()->associate($appointment);
        $this->booking->status = 'confirmed';
        $this->booking->save();
        $this->getAppointmentsForThatDay();
        
        event(new CompanyBookingConfirmed($this->booking));      
        return redirect()->route('bookings.show', ['booking'=>$this->booking->id]);  
    }

    public function render()
    {
        return view('livewire.add-booking-timeslot');
    }
}
