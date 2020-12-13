<?php

namespace Tests\Feature;

use App\Http\Livewire\BookingPrivateForm;
use App\Http\Livewire\Cars;
use App\Models\BillingAddress;
use App\Models\Car;
use App\Models\User;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class BookingPrivateFormTest extends TestCase
{

    use RefreshDatabase;
    

    public function booking_privat_creation_page_contains_livewire_component()
    {
        $this->actingAs(User::factory()->create());
        $this->get('/bookings/private/create')->assertSeeLivewire('livewire.booking-private-form');
    }


    public function test_booking_creation()
    {
        $this->seed(UserSeeder::class);
        $this->seed(ServiceSeeder::class);

        $user = User::factory()->create();
        $this->actingAs($user);

        $user->cars()->save(Car::factory()->make());
        $user->billingAddresses()->save(BillingAddress::factory()->make());
        
        $test = Livewire::test(BookingPrivateForm::class)    
        ->set('booking.date','20.12.2020')
        ->set('booking.time','08:00')
        ->set('booking.loc_street_number','street')
        ->set('booking.loc_route','route')
        ->set('booking.loc_city','zurich')
        ->set('booking.loc_postal_code','8001')                
        ->call('saveBooking');
        
        $this->assertDatabaseCount('bookings',1);

    }
}
