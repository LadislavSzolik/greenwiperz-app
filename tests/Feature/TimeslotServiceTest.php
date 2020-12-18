<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use App\Models\Booking;
use App\Models\Timeslot;
use App\TimeslotService;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\TimeslotSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimeslotServiceTest extends TestCase
{

    use RefreshDatabase;


    public function testReturnCorrectAvailableSlots_success()
    {        
        $user = User::factory()->create(); 
        $this->seed(TimeslotSeeder::class);
        $this->seed(ServiceSeeder::class);

        $bookingDate = '2020-11-02';
       
        $appointment = Appointment::create([    
            'assigned_to' => $user->id,        
            'date' =>  $bookingDate,
            'start_time' =>  '07:30',
            'end_time' =>  '09:30',
        ]);
        
        $timeslots = TimeslotService::fetchSlots($bookingDate, $user->id, 30, 60);        
        $this->assertSame(32, $timeslots->count());
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testReturnFullDayWeekDayTimeslots_success()
    {
        $user = User::factory()->create(); 
        $this->seed(TimeslotSeeder::class);
        $this->seed(ServiceSeeder::class);
        $timeslots = TimeslotService::fetchSlots('2020-10-30',  $user->id , 30, 60);

        $allSlots = Timeslot::all();        
        $this->assertSame($allSlots->count(),$timeslots->count());
    }

    public function testReturnHalfDaySaturdayTimeslots_success()
    {
        $user = User::factory()->create(); 
        $this->seed(TimeslotSeeder::class);
        $this->seed(ServiceSeeder::class);
        $timeslots = TimeslotService::fetchSlots('2020-10-31', $user->id , 30, 60);
        
        $this->assertSame( 17,$timeslots->count());
    }


    



    public function testDoubleCheckTimeslot_success()
    {        
        $this->seed(TimeslotSeeder::class);
        $this->seed(ServiceSeeder::class);
        $user = User::factory()->create(); 
        $bookingDate = '2020-11-02';
     
        $timeslots = TimeslotService::fetchSlots($bookingDate, $user->id, 30, 104);        

        $bookingTimeWithoutTravel = Carbon::parse('08:00')->format('H:i');
        
        $isTimeslotTaken = $timeslots->contains($bookingTimeWithoutTravel);
        
        $this->assertTrue($isTimeslotTaken);
    }


    public function testIgnoreCanceledTimeslots_success()
    {        
        $this->seed(TimeslotSeeder::class);
        $this->seed(ServiceSeeder::class);
        $user = User::factory()->create(); 
        $bookingDate = '2020-11-02';
       
        Booking::factory()->has(Appointment::factory([           
            'date' =>  $bookingDate,
            'start_time' =>  '07:30',
            'end_time' =>  '09:30',
            'assigned_to' => $user->id,
            'canceled_at' => Carbon::now(),
        ]))->create();
     
        $timeslots = TimeslotService::fetchSlots($bookingDate, $user->id, 30, 104);        

        $bookingTimeWithoutTravel = Carbon::parse('08:00')->format('H:i');
        
        $isTimeslotTaken = $timeslots->contains($bookingTimeWithoutTravel);
        
        $this->assertTrue($isTimeslotTaken);
    }


    public function testCanceledTimeslot_success()
    {        
        $this->seed(TimeslotSeeder::class);
        $this->seed(ServiceSeeder::class);

        $user1 = User::factory()->create();        

        $bookingDate = '2020-11-02';
       
        Appointment::create([           
            'date' =>  $bookingDate,
            'start_time' =>  '08:00',
            'end_time' =>  '09:30',
            'assigned_to' => $user1->id,
            'canceled_at' => Carbon::now(),
        ]);

        Appointment::create([           
            'date' =>  $bookingDate,
            'start_time' =>  '09:00',
            'end_time' =>  '10:30',
            'assigned_to' => $user1->id,           
        ]);
        $timeslots = TimeslotService::fetchSlots($bookingDate, $user1->id, 30, 59);        
        $isTimeslotTaken = $timeslots->contains('08:00');        
        $this->assertTrue($isTimeslotTaken);
    }



    public function testIgnoreOtherWiper_success()
    {        
        $this->seed(TimeslotSeeder::class);
        $this->seed(ServiceSeeder::class);

        $user1 = User::factory()->create(); 
        $user2 = User::factory()->create(); 

        $bookingDate = '2020-11-02';
       
        Appointment::create([           
            'date' =>  $bookingDate,
            'start_time' =>  '08:00',
            'end_time' =>  '09:30',
            'assigned_to' => $user2->id,           
        ]);
                
        $timeslots = TimeslotService::fetchSlots($bookingDate, $user1->id, 30, 59);        
        $isTimeslotTaken = $timeslots->contains('08:00');        
        $this->assertTrue($isTimeslotTaken);
    }

}
