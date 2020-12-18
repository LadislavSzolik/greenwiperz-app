<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use App\Models\BillingAddress;
use App\Models\Booking;
use App\Models\Car;
use App\Models\Role;
use App\Models\Services;
use App\TimeslotService;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class BookingPrivateForm extends Component
{
    public Booking $booking;
    public $hasExtraDirt;
    public $hasAnimalHair;
    public $locStreetNumber;
    public $locRoute;
    public $locPostalCode;
    public $locCity;
    public $availableSlots = [];
    public $wipers;
    public $priceList;    
    public $carForBooking;
    public $cars;   
    public $addressForBooking;
    public $addresses;
    public $showSelectAddressModal = false;

    protected $listeners = ['carSaved', 'addressSaved', 'placeChanged'];

    public function rules() { return [
        'carForBooking' => 'required',
        'addressForBooking' => 'required',
        'booking.customer_id' => 'required',
        'booking.booking_nr' => 'required',
        'booking.invoice_nr' => 'required',
        'booking.assigned_to' => 'required',
        'booking.duration' => 'required',
        'booking.service_type' => 'required',
        'booking.extra_dirt' => 'nullable',
        'booking.animal_hair' => 'nullable',
        'booking.loc_street_number' => 'required',
        'booking.loc_route' => 'required',
        'booking.loc_city' => 'required',
        'booking.loc_postal_code' => 'required | in:'.config('greenwiperz.service_area_postal_codes'),
        'booking.date' => 'required',
        'booking.time' => 'required',
        'booking.email' => 'required',
        'booking.phone' => 'nullable',  
        'booking.notes' => 'nullable',    
        'booking.base_cost' => 'required',
        'booking.extra_cost' => 'required',  
        'booking.brutto_total_amount' => 'required',       
        'booking.gw_vat_number' => 'required',       
        'booking.gw_company_name' => 'required',       
        'booking.gw_street' => 'required',        
        'booking.gw_postal_code' => 'required',        
        'booking.gw_city' => 'required',                
    ]; }

    public function mount()
    {                      
        $role = Role::whereName('greenwiper')->firstOrFail();    
        $this->wipers = $role->users()->get(); 

        $this->booking = Booking::make([
            'service_type'=>'outside',
            'customer_id' => auth()->user()->id,
            'assigned_to'=> $role->users->first()->id,
            'email' => auth()->user()->email,
            'booking_nr' => 'GW'.$this->generateBaseNumber(),
            'invoice_nr' => 'IN'.$this->generateBaseNumber(),
            'animal_hair' => 0,
            'extra_dirt' => 0,
            'gw_vat_number' => config('greenwiperz.company.mwst_id'),
            'gw_company_name' => config('greenwiperz.company.name'),
            'gw_street' => config('greenwiperz.company.street'),
            'gw_postal_code' =>  config('greenwiperz.company.postal_code') ,
            'gw_city' =>  config('greenwiperz.company.city') ,
            'gw_country'  => config('greenwiperz.company.country'), 
            ]);
                          
        $this->priceList = Services::all();                     
        $this->addresses = auth()->user()->billingAddresses()->where('is_company','=',0)->get();
        $this->addressForBooking =  $this->addresses->first();
        $this->cars = auth()->user()->cars;
        $this->carForBooking = optional($this->cars->first())->id;
        $this->recalculatePriceAndTime();  
    }

  
    public function carSaved()
    {
        $this->cars = auth()->user()->cars; 
        $this->carForBooking = $this->cars->last()->id;
        $this->availableSlots = [];
        $this->booking->time = null;
        $this->booking->date = null; 
        $this->recalculatePriceAndTime(); 
    }
  

    public function addressSaved()
    {
        $this->addresses = auth()->user()->billingAddresses;
        $this->addressForBooking = $this->addresses->last();     
    }

    public function showAddresses() {
        $this->showSelectAddressModal = true;
    }

    public function selectAddress(BillingAddress $billingAddress)
    {
        $this->addressForBooking = $billingAddress;
        $this->showSelectAddressModal = false;
    }

    public function deleteAddress(BillingAddress $billingAddress)
    {
        $billingAddress->delete();
        $this->addresses = auth()->user()->billingAddresses()->where('is_company','=',0)->get();
        if($this->addressForBooking->is($billingAddress)) 
        {
            $this->addressForBooking = $this->addresses->first();
        }
        $this->showSelectAddressModal = false;
    }


    // this is live:wire event hook
    public function updatedCarForBooking()
    {           
        $this->availableSlots = [];
        $this->booking->time = null;
        $this->booking->date = null; 
        $this->recalculatePriceAndTime();    
    }


    // this is live:wire event hook
    public function updatedBookingServiceType()
    {
        $this->availableSlots = [];
        $this->booking->time = null;
        $this->booking->date = null; 
        $this->recalculatePriceAndTime();    
    }

    public function updatedHasExtraDirt()
    {
        $this->recalculatePriceAndTime();
    }

    public function updatedHasAnimalHair()
    {        
        $this->recalculatePriceAndTime();
    }

    public function getFormatedDurationProperty()
    {
        return CarbonInterval::minutes($this->booking->duration);
    }

    public function recalculatePriceAndTime()
    {
        $this->booking->extra_cost = 0;
        $this->booking->base_cost = 0;
        $this->booking->duration = 0;

        if(!$this->carForBooking) {
            $this->booking->brutto_total_amount = 0;
            return;
        }
        $carSize = $this->cars->where('id',$this->carForBooking)->first()->car_size;         
        $actualPriceData =  $this->priceList->where('type', $this->booking->service_type)->where('vehicle_size', $carSize)->first();               
        $this->booking->duration = $actualPriceData->duration;
        $this->booking->base_cost = $actualPriceData->price;
       
        if ($this->hasAnimalHair) {
            $this->booking->animal_hair = 1;
            $this->booking->extra_cost += config('greenwiperz.company.dirty_surcharge');
        }
        if ($this->hasExtraDirt) 
        {
            $this->booking->extra_dirt = 1;
            $this->booking->extra_cost += config('greenwiperz.company.dirty_surcharge');
        }
        $this->booking->brutto_total_amount = $this->booking->base_cost + $this->booking->extra_cost;
    }
   

    public function updatedBookingAssignedTo()
    {
        $this->availableSlots = [];
        $this->booking->time = null;
        $this->booking->date = null; 
    }

    public function updatedBookingDate()
    {
        $this->availableSlots = [];
        $this->booking->time = null;

        $selectedDate = Carbon::parse($this->booking->date);
        if ($selectedDate->greaterThanOrEqualTo(Carbon::now())) {
            $this->availableSlots = TimeslotService::fetchSlots($this->booking->date, $this->booking->assigned_to, $this->booking->duration);

            if ($this->availableSlots->count() > 0) {
                $this->booking->time = $this->availableSlots->first();
            }
        }
    }

    // google maps    
    public function placeChanged($placeData)
    {
        Validator::make(
            $placeData,
            [
                'street_number' => 'required',
                'route' => 'required',
                'locality' => 'required',
                'postal_code' => 'required | in:'.config('greenwiperz.service_area_postal_codes'),
            ]
        )->validate();

        $this->booking->loc_street_number = $placeData['street_number'];
        $this->booking->loc_route = $placeData['route'];
        $this->booking->loc_city = $placeData['locality'];
        $this->booking->loc_postal_code = $placeData['postal_code'];
    }

    public function saveBooking()
    {
        $this->validate();        
        $availableSlots = TimeslotService::fetchSlots($this->booking->date, $this->booking->assigned_to, $this->booking->duration); 
        if(!$availableSlots->contains($this->booking->time))
        {                
            session()->flash('message', 'Unfortunately in a meanwhile the timeslot has been taken. Please select a new one.');  
            return;
        }
        $this->booking->save();
        $this->booking->appointment()->create([
            'date' => $this->booking->date,
            'start_time' => $this->booking->time,
            'end_time' => Carbon::parse($this->booking->time)->addMinutes($this->booking->duration - 1)->format('H:i'),
            'assigned_to' =>$this->booking->assigned_to,
        ]);
        
        $this->booking->car()->create($this->cars->where('id','=', $this->carForBooking)->first()->toArray());
        $this->booking->billingAddress()->create($this->addressForBooking->toArray());   
        $this->booking->push();
        return redirect()->route('bookings.review', ['booking' => $this->booking]);       
    }

    protected function generateBaseNumber()
    {       
        $baseNumberStructure = [            
            'date' => Carbon::now('GMT+2')->format('U'),
            'divider2' => '-',
            'userid' => str_pad(auth()->user()->id, 4, "0", STR_PAD_LEFT),
        ];
        return implode($baseNumberStructure);
    }

    public function render()
    {
        return view('livewire.booking-private-form');
    }
}
