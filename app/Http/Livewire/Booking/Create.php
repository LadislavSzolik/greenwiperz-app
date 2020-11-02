<?php

namespace App\Http\Livewire\Booking;

use Money\Money;
use App\Datatrans;
use Carbon\Carbon;
use Money\Currency;
use Livewire\Component;
use App\Models\Services;
use App\TimeslotService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $this->updateService();
    }

    // this helps when I use click inside of blade component
    public function hydrate()
    {
        if (strtotime($this->bookingDate)) {
            $this->totalTimeRequired = 2 * $this->travelTimeNeeded + $this->serviceDuration - 1;            
            $this->availableSlots = TimeslotService::fetchSlots($this->bookingDate, $this->travelTimeNeeded, $this->totalTimeRequired);  
        }
    }

    // this is live:wire event hook
    public function updatedBookingDate()
    {
        $selectedDate = Carbon::parse($this->bookingDate);

        if ($selectedDate->lt(Carbon::now())) {
            
            $availableSlots = [];
            $this->bookingTime = null;
        } else {

            $this->totalTimeRequired = 2 * $this->travelTimeNeeded + $this->serviceDuration - 1;            
            $availableSlots = TimeslotService::fetchSlots($this->bookingDate, $this->travelTimeNeeded, $this->totalTimeRequired);      
                
            if ($availableSlots->count() > 0) {
                $this->bookingTime = $availableSlots->first();
            }
        }        
        $this->availableSlots = $availableSlots;
        
    }
    // this is live:wire event hook
    public function updatedServiceType()
    {
        $this->updateService();
        $this->resetDateAndTime();
    }
    // this is live:wire event hook
    public function updatedVehicleSize()
    {
        $this->updateService();
        $this->resetDateAndTime();
    }

    public function getMoneyPriceProperty() {
        $money = new Money($this->servicePrice, new Currency('CHF'));
        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('de_CH', \NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);
        
        return $moneyFormatter->format($money);
    }


    public function updateService()
    {
        $actualPriceData =  $this->priceList->where('type', $this->serviceType)->where('vehicle_size', $this->vehicleSize)->first();
        $this->servicePrice  = $actualPriceData->price;
        $this->serviceDuration = $actualPriceData->duration;
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
            session()->flash('message', 'Unfortunately in a meanwhile the timeslot has been taken. Please select a new one.');
            $this->checkoutVisibility = false;
        } else {
            Validator::make(
                ['termsAndConditions' => $this->termsAndConditions,],
                ['termsAndConditions' => 'accepted',]
            )->validate();
            $this->validate();

            // prepare ivnoice id
            $refno = $this->generateInvoiceReferenceNumber();
         
            $bookingData = [
                'refno'                     => $refno,
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
                'service_type'              => $this->serviceType,
                'service_duration'          => $this->serviceDuration,
                'service_price'             => $this->servicePrice,
                'notes'                     => $this->notes,
                'billing_first_name'        => $this->billingFirstName,
                'billing_last_name'         => $this->billingLastName,
                'billing_street'            => $this->billingStreet,
                'billing_postal_code'       => $this->billingPostalCode,
                'billing_city'              => $this->billingCity,
                'billing_country'           => $this->billingCountry,
            ];

            $startTime = $this->bookingTime;
            $endTime = Carbon::parse($this->bookingTime)->addMinutes($this->serviceDuration - 1)->format('H:i');

            $bookingTimeslot = [    
                'date' => $this->bookingDate,
                'start_time' => $startTime,
                'end_time' => $endTime
            ];

            session()->put('bookingData',$bookingData);
            session()->put('bookingTimeslot',$bookingTimeslot);
            return redirect()->route('bookings.store');           
        }
    }



    protected function generateInvoiceReferenceNumber()
    {

        $refnoStructure = [
            'prefix' => 'GW',
            'date' => Carbon::now('GMT+2')->format('d'),
            'random' => strtoupper(bin2hex(random_bytes(4))),
            'divider2' => '-',
            'userid' => str_pad(auth()->user()->id, 4, "0", STR_PAD_LEFT),
        ];
        return implode($refnoStructure);
    }

      // google maps
      public function placeChanged($placeData)
      {
          $customValidator = Validator::make(
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
