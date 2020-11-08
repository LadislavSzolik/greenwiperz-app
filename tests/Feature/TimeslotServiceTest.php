<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Booking;
use App\Models\Timeslot;
use App\TimeslotService;
use App\Models\BookingTimeslot;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\TimeslotSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimeslotServiceTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testReturnFullDayWeekDayTimeslots_success()
    {
        $this->seed(TimeslotSeeder::class);
        $this->seed(ServiceSeeder::class);
        $timeslots = TimeslotService::fetchSlots('2020-10-30', 30, 60);

        $allSlots = Timeslot::all();        
        $this->assertSame($allSlots->count(),$timeslots->count());
    }

    public function testReturnHalfDaySaturdayTimeslots_success()
    {
        $this->seed(TimeslotSeeder::class);
        $this->seed(ServiceSeeder::class);
        $timeslots = TimeslotService::fetchSlots('2020-10-31', 30, 60);

        $allSlots = Timeslot::all();        
        $this->assertSame(18,$timeslots->count());
    }


    public function testReturnCorrectAvailableSlots_success()
    {        
        $this->seed(TimeslotSeeder::class);
        $this->seed(ServiceSeeder::class);

        $bookingDate = '2020-11-02';

        $booking = Booking::factory()->create();
        BookingTimeslot::create([
            'booking_id' => $booking->id,
            'date' =>  $bookingDate,
            'start_time' =>  '07:30',
            'end_time' =>  '09:30',
        ]);
        $timeslots = TimeslotService::fetchSlots($bookingDate, 30, 60);        
        $this->assertSame(32, $timeslots->count());
    }



    public function testDoubleCheckTimeslot_success()
    {        
        $this->seed(TimeslotSeeder::class);
        $this->seed(ServiceSeeder::class);

        $bookingDate = '2020-11-02';
     
        $timeslots = TimeslotService::fetchSlots($bookingDate, 30, 104);        

        $bookingTimeWithoutTravel = Carbon::parse('08:00')->format('H:i');
        
        $isTimeslotTaken = $timeslots->contains($bookingTimeWithoutTravel);
        
        $this->assertTrue($isTimeslotTaken);
    }


    public function testIgnroeCanceledTimeslots_success()
    {        
        $this->seed(TimeslotSeeder::class);
        $this->seed(ServiceSeeder::class);

        $bookingDate = '2020-11-02';
        $booking = Booking::factory()->create();
        BookingTimeslot::create([
            'booking_id' => $booking->id,
            'date' =>  $bookingDate,
            'start_time' =>  '07:30',
            'end_time' =>  '09:30',
            'canceled_at' => Carbon::now(),
        ]);
     
        $timeslots = TimeslotService::fetchSlots($bookingDate, 30, 104);        

        $bookingTimeWithoutTravel = Carbon::parse('08:00')->format('H:i');
        
        $isTimeslotTaken = $timeslots->contains($bookingTimeWithoutTravel);
        
        $this->assertTrue($isTimeslotTaken);
    }

}
