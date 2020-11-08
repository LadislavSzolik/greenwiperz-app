<?php

namespace App\Http\Livewire\Booking;

use Money\Money;
use Carbon\Carbon;
use Money\Currency;
use App\Models\Booking;
use Livewire\Component;
use App\Models\Services;
use App\TimeslotService;
use Carbon\CarbonInterval;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use Illuminate\Support\Facades\Validator;

class Create extends Component
{
    public $checkoutVisibility = false;

    public $priceList;

    public $bookingDate;
    public $bookingTime;
    public $availableSlots = [];

    public $parkingRoute = '';
    public $parkingStreetNumber = '';
    public $parkingPostalCode = '';
    public $parkingCity = '';

    public $vehicleModel = '';
    public $numberPlate = '';
    public $vehicleSize = 'small';

    // later
    public $vehicleColor = 'black';

    public $hasExtraDirt = 0;
    public $hasAnimalHair = 0;

    public $serviceType = 'outside';
    public $serviceDuration;
    public $travelTimeNeeded = 30;
    public $totalTimeRequired;
    public $servicePrice;

    public $notes;

    public $billingFirstName = '';
    public $billingLastName = '';
    public $billingCompanyName = '';
    public $billingStreet = '';
    public $billingPostalCode = '';
    public $billingCity = '';
    public $billingCountry = 'Schweiz';


    public $termsAndConditions = false;

    public $listeners = ['placeChanged'];
    public $customValidator;

    protected $rules = [
        'bookingDate' => 'required',
        'bookingTime' => 'required',
        'serviceDuration' => 'required',
        'travelTimeNeeded' => 'required',

        'parkingRoute' => 'required',
        'parkingStreetNumber' => 'required',
        'parkingPostalCode' => 'required',
        'parkingCity' => 'required',

        'vehicleModel' => 'required',
        'numberPlate' => 'required|min:8',
        'vehicleSize' => 'required',
        'vehicleColor' => 'required',

        'hasExtraDirt' => 'boolean',
        'hasAnimalHair' => 'boolean',

        'serviceType' => 'required',
        'serviceDuration' => 'required|numeric',
        'servicePrice' => 'required|numeric',

        'notes' => 'nullable',

        'billingFirstName' => 'required',
        'billingLastName' => 'required',
        'billingStreet' => 'required',
        'billingPostalCode' => 'required',
        'billingCity' => 'required',
        'billingCountry' => 'required',
    ];


    public function mount()
    {        
        $this->priceList = Services::all();
    }

    // this helps when I use click inside of blade component
    public function hydrate()
    {
        if (strtotime($this->bookingDate) && Carbon::parse($this->bookingDate)->greaterThanOrEqualTo(Carbon::now()) ) {
            $this->totalTimeRequired = 2 * $this->travelTimeNeeded + $this->serviceDuration - 1;            
            $this->availableSlots = TimeslotService::fetchSlots($this->bookingDate, $this->travelTimeNeeded, $this->totalTimeRequired);  
        }
    }

    // this is live:wire event hook
    public function updatedBookingDate()
    {      
        $this->availableSlots = [];
        $this->bookingTime = null;

        $selectedDate = Carbon::parse($this->bookingDate);
        if ($selectedDate->greaterThanOrEqualTo(Carbon::now())) {
            $this->totalTimeRequired = 2 * $this->travelTimeNeeded + $this->serviceDuration - 1;            
            $this->availableSlots = TimeslotService::fetchSlots($this->bookingDate, $this->travelTimeNeeded, $this->totalTimeRequired);                             
                    
            if ($this->availableSlots->count() > 0) {                  
                $this->bookingTime =$this->availableSlots->first();
            }             
        }               
       
        
    }
    // this is live:wire event hook
    public function updatedServiceType()
    {
        $this->resetDateAndTime();
    }
    // this is live:wire event hook
    public function updatedVehicleSize()
    {
        $this->resetDateAndTime();
    }
  

    // CALCULATED LIVE WIRE property
    public function getMoneyPriceProperty() {
        
        $this->servicePrice =  $this->priceList->where('type', $this->serviceType)->where('vehicle_size', $this->vehicleSize)->first()->price;
        
        if($this->hasAnimalHair == 1 || $this->hasExtraDirt == 1) {
            $this->servicePrice +=config('greenwiperz.company.dirty_surcharge');
        }

        $money = new Money($this->servicePrice, new Currency('CHF'));
        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('de_CH', \NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);
        
        return $moneyFormatter->format($money);
    }


    public function getFormatedServiceDurationProperty()
    {
        $actualPriceData =  $this->priceList->where('type', $this->serviceType)->where('vehicle_size', $this->vehicleSize)->first();
        $this->serviceDuration = $actualPriceData->duration;
        return CarbonInterval::minutes($this->serviceDuration);
    }

    public function resetDateAndTime()
    {
        $this->bookingDate = null;
        $this->bookingTime = null;
        $this->availableSlots = null;
    }

  

    public function goToReviewPage() {
        $this->validate();
        $this->checkoutVisibility = true;
    }

    public function goBackToEdit() {
        $this->checkoutVisibility = false;
    }

    public function submitBooking()
    {                        
        // recalculate timeslots        
        $availableSlots = TimeslotService::fetchSlots($this->bookingDate, $this->travelTimeNeeded, $this->totalTimeRequired);   
        
        if (!$availableSlots->contains($this->bookingTime)) {
            $this->bookingDate = null;
            $this->bookingTime = null;
            $this->availableSlots = null;

            session()->flash('message', 'Unfortunately in a meanwhile the timeslot has been taken. Please select a new one.');
            $this->checkoutVisibility = false;
        } else {
            Validator::make(
                ['termsAndConditions' => $this->termsAndConditions,],
                ['termsAndConditions' => 'accepted',]
            )->validate();
            $this->validate();

         
            $baseNumber = $this->generateBaseNumber();

            $booking = auth()->user()->bookings()->create([
                'booking_nr'                => 'GW'.$baseNumber,             
                'service_price'             => $this->servicePrice,
                'tc_accepted_at'            => now(),
                'notes'                     => $this->notes,            
            ]);

            $booking->billingAddress()->create([
                'user_id'           => auth()->user()->id,
                'first_name'        => $this->billingFirstName,
                'last_name'         => $this->billingLastName,
                'company_name'      => $this->billingCompanyName,
                'street'            => $this->billingStreet,
                'postal_code'       => $this->billingPostalCode,
                'city'              => $this->billingCity,
                'country'           => $this->billingCountry,
            ]);

            $booking->sellerAddress()->create([                                 
                'company_name'      => config('greenwiperz.company.name'),
                'street'            => config('greenwiperz.company.street'),
                'postal_code'       => config('greenwiperz.company.postal_code'),
                'city'              => config('greenwiperz.company.city'),
                'country'           => config('greenwiperz.company.country'),
            ]);


            $booking->bookingService()->create([
                'parking_street_number'     => $this->parkingStreetNumber,
                'service_type'              => $this->serviceType,
                'service_duration'          => $this->serviceDuration,
                'parking_street_number'     => $this->parkingStreetNumber,
                'parking_route'             => $this->parkingRoute,
                'parking_city'              => $this->parkingCity,
                'parking_postal_code'       => $this->parkingPostalCode,
                'vehicle_model'             => $this->vehicleModel,
                'number_plate'              => $this->numberPlate,
                'vehicle_size'              => $this->vehicleSize,
                'vehicle_color'             => $this->vehicleColor,
                'has_extra_dirt'            => $this->hasExtraDirt,
                'has_animal_hair'           => $this->hasAnimalHair,                              
            ]);

            $booking->bookingTimeslot()->create([
                'date' => $this->bookingDate,
                'start_time' => $this->bookingTime,
                'end_time' => Carbon::parse($this->bookingTime)->addMinutes($this->serviceDuration - 1),
            ]);

            $booking->invoice()->create([
                'user_id'           => auth()->user()->id,
                'invoice_nr'        => 'INV'.$baseNumber,
                'price'             => $this->servicePrice,
                'netto_price'       => intval(round(floatval($this->servicePrice) / (1 + floatval(config('greenwiperz.mwst_percent'))))),
                'mwst_percent'      => $this->servicePrice - intval(round(floatval($this->servicePrice) / (1 + floatval(config('greenwiperz.mwst_percent'))))),
                'mwst_id'       => config('greenwiperz.company.mwst_id'),              
            ]);



            return redirect()->route('payments.redirect', ['id' => $booking->id]);           
        }
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

      // google maps
      public function placeChanged($placeData)
      {
          Validator::make(
              $placeData,
              [
                  'street_number' => 'required',
                  'route' => 'required',
                  'locality' => 'required',
                  'postal_code' => 'required | in:8001,8002,8003,8004,8005,8006,8037,8046',
              ]
          )->validate();
  
          $this->parkingStreetNumber = $placeData['street_number'];
          $this->parkingRoute = $placeData['route'];
          $this->parkingCity = $placeData['locality'];
          $this->parkingPostalCode = $placeData['postal_code'];
      }


    public function render()
    {
        return view('livewire.booking.create');
    }

}
