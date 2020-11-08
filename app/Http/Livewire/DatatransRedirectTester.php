<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Booking;
use Livewire\Component;

class DatatransRedirectTester extends Component
{

    public function simulatePay() {

       
        $bookingData = [
            'refno' => 'GW12345678-1234',         

            'parking_street_number' => 'Wehntalers',
            'parking_route' => '524',
            'parking_city' => 'Zurich',
            'parking_postal_code' => '8046',

            'vehicle_model' => 'Mitzubishi',
            'number_plate' => 'ZH1234568',
            'vehicle_size' => 'small',
            'vehicle_color' => 'black',
            'has_extra_dirt' => false,
            'has_animal_hair' => false,
        
            'service_type' => 'outside',
            'service_duration' => 120,        
            'service_price' => 5500,               

            'billing_first_name' => 'John',
            'billing_last_name' => 'Sample',
            'billing_street' => 'Wehntalers',
            'billing_postal_code' => '8046',
            'billing_city' => 'Zurich',
            'billing_country' => 'Swiss',
        ];

        $startTime = Carbon::parse('08:00')->addMinutes(30)->format('H:i');
        $endTime = Carbon::parse('08:00')->addMinutes(30 + 120 - 1)->format('H:i');

        $BookingTimeslot = [    
            'date' => '2020-11-12',
            'start_time' => $startTime,
            'end_time' => $endTime
        ];

        session()->put('bookingData',$bookingData);
        session()->put('BookingTimeslot',$BookingTimeslot);
        return redirect()->route('bookings.store');

    }



    public function render()
    {
        return view('livewire.datatrans-redirect-tester');
    }
}
