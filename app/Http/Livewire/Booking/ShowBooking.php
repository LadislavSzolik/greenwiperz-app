<?php

namespace App\Http\Livewire\Booking;

use App\Models\Appointment;
use App\Models\Booking;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ShowBooking extends Component
{
    use AuthorizesRequests;
    public Booking $booking;

    protected $listeners = ['deleteAppointment'];

    public function addDayToBooking()
    {
        $this->booking->appointments()->create([            
            'user_id' => $this->booking->customer_id,
            'date' => now(),
            'start_time' => '00:00',
            'end_time' => '00:00',
            'assigned_to' => $this->booking->assigned_to,            
        ]);
        return redirect()->route('bookings.show', ['booking' => $this->booking]);
    }

    public function deleteAppointment($appointmentId)
    {
        if($this->booking->appointments()->count() > 1 ) {
            Appointment::where('id', $appointmentId)->delete();            
        } else {
            $this->emit('onSingleAppointmentDelete');
        }
        $this->booking->refresh();
    }

    public function render()
    {
        $this->authorize('view', $this->booking);

        return view('livewire.booking.show-booking', ['booking' => $this->booking]);
    }
}
