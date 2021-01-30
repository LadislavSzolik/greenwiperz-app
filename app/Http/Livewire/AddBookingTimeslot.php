<?php

namespace App\Http\Livewire;

use App\Events\BusinessBookingConfirmed;
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
        // #1 get the bookings which are that day        
        $this->getAppointmentsForThatDay();

        //#2 get the list of possible timeslot
        $this->timeslots = Timeslot::all()->pluck('timeslot');

        //#3 if there is an appiontment stored, prefill the end date, the start date is already there
        if ($this->booking->appointment) {
            $this->end_time = $this->booking->appointment->end_time;
        }
    }

    // When you select a new date
    public function updatedBookingDate()
    {
        $this->getAppointmentsForThatDay();
    }

    // When you change 
    public function updatedBookingTime($newStartDate)
    {             
        $this->end_time = Carbon::parse($newStartDate)->addMinutes($this->booking->duration)->subMinute()->format('H:i:s');
    }

    public function saveAppointment()
    {
        // #1 validate input
        $this->validate();

        //#2 delete previous date if present
        if ($this->booking->appointment) {
            $this->booking->appointment()->delete();
        }

        //#3 save new date
        $this->booking->appointment()->create([
            'date' => $this->booking->date,
            'start_time' => $this->booking->time,
            'end_time' => Carbon::parse($this->end_time)->format('H:i'),
            'assigned_to' => $this->booking->assigned_to,
        ]);

        //#4 set booking status
        $this->booking->status = 'confirmed';
        $this->booking->push();
        $this->booking->refresh();

        //#5 send mail
        event(new BusinessBookingConfirmed($this->booking));

        //# refresh the page
        return redirect()->route('bookings.show', ['booking' => $this->booking->id]);
    }

    public function render()
    {
        return view('livewire.add-booking-timeslot');
    }

    // helper to see all exisiting bookings
    protected function getAppointmentsForThatDay()
    {
        $this->appointmentsOnDay = Appointment::where('date', '=', $this->booking->date)->get();
    }
}
