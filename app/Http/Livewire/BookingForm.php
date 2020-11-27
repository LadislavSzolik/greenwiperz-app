<?php

namespace App\Http\Livewire;

use App\Models\Booking;
use App\Models\Role;
use App\Models\Services;
use App\TimeslotService;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;

class BookingForm extends Component
{

    public $booking;

    public $duration;
    public $baseCost;
    public $extraCost;
    public $bruttoTotalAmount;
    public $locStreetNumber;
    public $locRoute;
    public $locPostalCode;
    public $locCity;
    public $assignedTo;
    public $serviceType = 'outside';
    public $carModel;
    public $numberPlate;
    public $carColor;
    public $carSize = 'small';
    public $hasExtraDirtLocal = 0;
    public $hasAnimalHairLocal = 0;
    public $phone;
    public $bookingDate;
    public $bookingTime;
    public $billFirstName;
    public $billLastName;
    public $billCompanyName;
    public $billStreet;
    public $billPostalCode;
    public $billCity;
    public $billCountry = 'Schweiz';

    public $notes;

    //helpers
    public $availableSlots;
    public $wipers;
    public $priceList;

    public function mount()
    {
        $this->priceList = Services::all();
        $role = Role::whereName('greenwiper')->firstOrFail();
        $this->wipers = $role->users()->get();
        $this->assignedTo = $role->users->first()->id;


        if (filled(auth()->user()->car)) {
            $this->carModel = auth()->user()->car->car_model;
            $this->numberPlate = auth()->user()->car->number_plate;
            $this->carColor = auth()->user()->car->car_color;
            $this->carSize  = auth()->user()->car->car_size;
        }

        if (filled(auth()->user()->billingAddress)) {
            $this->billFirstName = auth()->user()->billingAddress->first_name;
            $this->billLastName = auth()->user()->billingAddress->last_name;
            $this->billCompanyName = auth()->user()->billingAddress->company_name;
            $this->billStreet = auth()->user()->billingAddress->street;
            $this->billPostalCode = auth()->user()->billingAddress->postal_code;
            $this->billCity = auth()->user()->billingAddress->city;
            $this->billCountry = auth()->user()->billingAddress->country;
        }
        $this->recalculatePriceAndTime();
    }

    // this is live:wire event hook
    public function updatedServiceType()
    {
        $this->availableSlots = [];
        $this->bookingTime = null;
        $this->bookingDate = null; 
        $this->recalculatePriceAndTime();    
    }
    // this is live:wire event hook
    public function updatedCarSize()
    {
        $this->availableSlots = [];
        $this->bookingTime = null;
        $this->bookingDate = null; 
        $this->recalculatePriceAndTime();        
    }

    public function updatedHasExtraDirtLocal()
    {
        $this->recalculatePriceAndTime();
    }

    public function updatedHasAnimalHairLocal()
    {
        $this->recalculatePriceAndTime();
    }

    public function getFormatedDurationProperty()
    {
        return CarbonInterval::minutes($this->duration);
    }

    public function recalculatePriceAndTime()
    {
        $actualPriceData =  $this->priceList->where('type', $this->serviceType)->where('vehicle_size', $this->carSize)->first();
        $this->duration = $actualPriceData->duration;
        $this->baseCost = $actualPriceData->price;
        $this->extraCost = 0;
        if ($this->hasAnimalHairLocal == 1 || $this->hasExtraDirtLocal == 1) {
            $this->extraCost = config('greenwiperz.company.dirty_surcharge');
        }
        $this->bruttoTotalAmount = $this->baseCost + $this->extraCost;
    }

    public function getFormatedExtraCostProperty()
    {
        $money = new Money($this->extraCost, new Currency('CHF'));
        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('de_CH', \NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);
        return $moneyFormatter->format($money);
    }

    public function getFormatedTotalCostProperty()
    {
        $money = new Money($this->bruttoTotalAmount, new Currency('CHF'));
        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('de_CH', \NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);
        return $moneyFormatter->format($money);
    }

    public function updatedAssignedTo()
    {
        $this->availableSlots = [];
        $this->bookingTime = null;
        $this->bookingDate = null; 
    }

    public function updatedBookingDate()
    {
       $this->refreshBookingDateAndTime();
    }

    public function refreshBookingDateAndTime()
    {
        $this->availableSlots = [];
        $this->bookingTime = null;

        $selectedDate = Carbon::parse($this->bookingDate);
        if ($selectedDate->greaterThanOrEqualTo(Carbon::now())) {
            $this->availableSlots = TimeslotService::fetchSlots($this->bookingDate, $this->assignedTo, $this->duration);

            if ($this->availableSlots->count() > 0) {
                $this->bookingTime = $this->availableSlots->first();
            }
        }
    }


    // google maps
    public $listeners = ['placeChanged'];
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

        $this->locStreetNumber = $placeData['street_number'];
        $this->locRoute = $placeData['route'];
        $this->locPostalCode = $placeData['locality'];
        $this->locCity = $placeData['postal_code'];
    }

    public function render()
    {
        return view('livewire.booking-form');
    }
}
