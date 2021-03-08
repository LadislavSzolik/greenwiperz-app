<?php

namespace App\Http\Livewire\Booking;

use App\Models\BillingAddress;
use App\Models\Booking;
use App\Models\Fleet;
use App\Models\Role;
use App\Models\Services;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CreateCompanyForm extends Component
{
    public Booking $booking;
    public $timeslot_date;
    public Fleet $smallCars;
    public Fleet $mediumCars;
    public Fleet $largeCars;
    public Fleet $xlargeCars;
    public $locStreetNumber;
    public $locRoute;
    public $locPostalCode;
    public $locCity;
    public $wipers;
    public $priceList;
    public $addresses;
    public $addressForBooking;
    public $showSelectAddressModal = false;

    protected $listeners = ['addressSaved', 'placeChanged'];

    public function rules()
    {
        return [
            'timeslot_date' => 'required|date|after:today',
            'addressForBooking' => 'required',
            'smallCars.outside' => 'required',
            'smallCars.inoutsidebasic' => 'required',
            'smallCars.inoutsidepremium' => 'required',
            'smallCars.car_size' => 'required',
            'mediumCars.outside' => 'required',
            'mediumCars.inoutsidebasic' => 'required',
            'mediumCars.inoutsidepremium' => 'required',
            'mediumCars.car_size' => 'required',
            'largeCars.outside' => 'required',
            'largeCars.inoutsidebasic' => 'required',
            'largeCars.inoutsidepremium' => 'required',
            'largeCars.car_size' => 'required',
            'xlargeCars.outside' => 'required',
            'xlargeCars.inoutsidebasic' => 'required',
            'xlargeCars.inoutsidepremium' => 'required',
            'xlargeCars.car_size' => 'required',
            'booking.type' => 'required',
            'booking.customer_id' => 'required',
            'booking.booking_nr' => 'required',
            'booking.assigned_to' => 'required',
            'booking.duration' => 'required',
            'booking.extra_dirt' => 'nullable',
            'booking.animal_hair' => 'nullable',
            'booking.loc_street_number' => 'required',
            'booking.loc_route' => 'required',
            'booking.loc_city' => 'required',
            'booking.loc_postal_code' => 'required | in:' . config('greenwiperz.service_area_postal_codes'),
            'booking.email' => 'required',
            'booking.phone' => 'required',
            'booking.notes' => 'nullable',
            'booking.base_cost' => 'required',
            'booking.extra_cost' => 'required',
            'booking.fleet_discount' => 'required',
            'booking.discounted_cost' => 'required',
            'booking.brutto_total_amount' => 'required',
            'booking.gw_vat_number' => 'required',
            'booking.gw_company_name' => 'required',
            'booking.gw_street' => 'required',
            'booking.gw_postal_code' => 'required',
            'booking.gw_city' => 'required',
        ];
    }

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        $role = Role::whereName('greenwiper')->firstOrFail();
        $this->wipers = $role->users()->get();


        $this->booking = Booking::make([
            'type' => 'business',
            'animal_hair' => 0,
            'extra_dirt' => 0,
            'fleet_discount' => 0,
            'customer_id' => auth()->user()->id,
            'assigned_to' => $role->users->first()->id,
            'email' => auth()->user()->email,
            'booking_nr' => 'GW' . $this->generateBaseNumber(),
            'gw_vat_number' => config('greenwiperz.company.mwst_id'),
            'gw_company_name' => config('greenwiperz.company.name'),
            'gw_street' => config('greenwiperz.company.street'),
            'gw_postal_code' =>  config('greenwiperz.company.postal_code'),
            'gw_city' =>  config('greenwiperz.company.city'),
            'gw_country'  => config('greenwiperz.company.country'),
        ]);

        $this->priceList = Services::all();
        $this->addresses = auth()->user()->billingAddresses()->where('is_company', '=', 1)->get();
        $this->addressForBooking =  $this->addresses->last();
        $this->smallCars = Fleet::make(['outside' => 0, 'inoutsidebasic' => 0, 'inoutsidepremium' => 0, 'car_size' => 'small']);
        $this->mediumCars = Fleet::make(['outside' => 0, 'inoutsidebasic' => 0, 'inoutsidepremium' => 0, 'car_size' => 'medium']);
        $this->largeCars = Fleet::make(['outside' => 0, 'inoutsidebasic' => 0, 'inoutsidepremium' => 0, 'car_size' => 'large']);
        $this->xlargeCars = Fleet::make(['outside' => 0, 'inoutsidebasic' => 0, 'inoutsidepremium' => 0, 'car_size' => 'x-large']);

        $this->recalculatePriceAndTime();
    }

    public function updated()
    {
        $this->recalculatePriceAndTime();
    }

    public function addressSaved()
    {
        $this->addresses = auth()->user()->billingAddresses()->where('is_company', '=', 1)->get();
        $this->addressForBooking = $this->addresses->last();
    }

    public function showAddresses()
    {
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
        $this->addresses = auth()->user()->billingAddresses()->where('is_company', '=', 1)->get();
        if ($this->addressForBooking->is($billingAddress)) {
            $this->addressForBooking = $this->addresses->first();
        }
        $this->showSelectAddressModal = false;
    }

    /**
     *
     */
    public function recalculatePriceAndTime()
    {
        $this->booking->base_cost = 0;
        $this->booking->fleet_discount = 0;
        $this->booking->duration = 0;


        $smallOut = intval($this->smallCars->outside);
        $smallInOutBasic = intval($this->smallCars->inoutsidebasic);
        $smallInOutPremium = intval($this->smallCars->inoutsidepremium);

        $priceSmallOut =  $this->priceList->where('type', 'outside')->where('vehicle_size', 'small')->first();
        $priceSmallInOutBasic =  $this->priceList->where('type', 'inside-outside-basic')->where('vehicle_size', 'small')->first();
        $priceSmallInOutPremium =  $this->priceList->where('type', 'inside-outside-premium')->where('vehicle_size', 'small')->first();
        $this->booking->base_cost += $priceSmallOut->price * $smallOut;
        $this->booking->base_cost += $priceSmallInOutBasic->price * $smallInOutBasic;
        $this->booking->base_cost += $priceSmallInOutPremium->price * $smallInOutPremium;
        $this->booking->duration += ($smallOut * $priceSmallOut->duration) +
            ($smallInOutBasic * $priceSmallInOutBasic->duration) +
            ($smallInOutPremium * $priceSmallInOutPremium->duration);


        $mediumOut = intval($this->mediumCars->outside);
        $mediumInOutBasic = intval($this->mediumCars->inoutsidebasic);
        $mediumInOutPremium = intval($this->mediumCars->inoutsidepremium);

        $priceMediumOut =  $this->priceList->where('type', 'outside')->where('vehicle_size', 'medium')->first();
        $priceMediumInOutBasic =  $this->priceList->where('type', 'inside-outside-basic')->where('vehicle_size', 'medium')->first();
        $priceMediumInOutPremium =  $this->priceList->where('type', 'inside-outside-premium')->where('vehicle_size', 'medium')->first();
        $this->booking->base_cost += $priceMediumOut->price *  $mediumOut;
        $this->booking->base_cost += $priceMediumInOutBasic->price *  $mediumInOutBasic;
        $this->booking->base_cost += $priceMediumInOutPremium->price *  $mediumInOutPremium;
        $this->booking->duration += ($mediumOut  * $priceMediumOut->duration) +
            ($mediumInOutBasic * $priceMediumInOutBasic->duration) +
            ($mediumInOutPremium * $priceMediumInOutPremium->duration);

        $largeOut = intval($this->largeCars->outside);
        $largeInOutBasic = intval($this->largeCars->inoutsidebasic);
        $largeInOutPremium = intval($this->largeCars->inoutsidepremium);

        $priceLargeOut =  $this->priceList->where('type', 'outside')->where('vehicle_size', 'large')->first();
        $priceLargeInOutBasic =  $this->priceList->where('type', 'inside-outside-basic')->where('vehicle_size', 'large')->first();
        $priceLargeInOutPremium =  $this->priceList->where('type', 'inside-outside-premium')->where('vehicle_size', 'large')->first();
        $this->booking->base_cost += $priceLargeOut->price *  $largeOut;
        $this->booking->base_cost += $priceLargeInOutBasic->price *  $largeInOutBasic;
        $this->booking->base_cost += $priceLargeInOutPremium->price *  $largeInOutPremium;
        $this->booking->duration += ($largeOut * $priceLargeOut->duration) +
            ($largeInOutBasic * $priceLargeInOutBasic->duration) +
            ($largeInOutPremium * $priceLargeInOutPremium->duration);

        $xlargeOut = intval($this->xlargeCars->outside);
        $xlargeInOutBasic = intval($this->xlargeCars->inoutsidebasic);
        $xlargeInOutPremium = intval($this->xlargeCars->inoutsidepremium);

        $priceXLargeOut =  $this->priceList->where('type', 'outside')->where('vehicle_size', 'x-large')->first();
        $priceXLargeInOutBasic =  $this->priceList->where('type', 'inside-outside-basic')->where('vehicle_size', 'x-large')->first();
        $priceXLargeInOutPremium =  $this->priceList->where('type', 'inside-outside-premium')->where('vehicle_size', 'x-large')->first();
        $this->booking->base_cost += $priceXLargeOut->price *  $xlargeOut;
        $this->booking->base_cost += $priceXLargeInOutBasic->price *  $xlargeInOutBasic;
        $this->booking->base_cost += $priceXLargeInOutPremium->price *  $xlargeInOutPremium;
        $this->booking->duration += ($xlargeOut * $priceXLargeOut->duration) +
            ($xlargeInOutBasic * $priceXLargeInOutBasic->duration) +
            ($xlargeInOutPremium * $priceXLargeInOutPremium->duration);

        $animal_hair = intval($this->booking->animal_hair);
        $extra_dirt = intval($this->booking->extra_dirt);

        $this->booking->duration += 15 * $animal_hair;
        $this->booking->duration += 15 * $extra_dirt;

        $this->booking->extra_cost = 0;
        $this->booking->extra_cost += ($animal_hair * config('greenwiperz.company.dirty_surcharge'));
        $this->booking->extra_cost += ($extra_dirt * config('greenwiperz.company.dirty_surcharge'));

        $this->booking->fleet_discount = $smallOut +
            $smallInOutBasic +
            $smallInOutPremium +
            $mediumOut +
            $mediumInOutBasic +
            $mediumInOutPremium +
            $largeOut  +
            $largeInOutBasic  +
            $largeInOutPremium  +
            $xlargeOut +
            $xlargeInOutBasic +
            $xlargeInOutPremium;;

        $this->booking->brutto_total_amount = $this->booking->base_cost + $this->booking->extra_cost;

        if ($this->booking->fleet_discount > 30) {
            $this->booking->fleet_discount = 30;
        }
        $this->booking->discounted_cost =   $this->booking->brutto_total_amount - ($this->booking->fleet_discount * 0.01 * $this->booking->brutto_total_amount);
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
                'postal_code' => 'required | in:' . config('greenwiperz.service_area_postal_codes'),
            ]
        )->validate();

        $this->booking->loc_street_number = $placeData['street_number'];
        $this->booking->loc_route = $placeData['route'];
        $this->booking->loc_city = $placeData['locality'];
        $this->booking->loc_postal_code = $placeData['postal_code'];
        $this->emit('addressEntered', $placeData);
    }

    public function saveBooking()
    {
        $this->validate();
        $this->booking->save();
        $this->booking->fleets()->save($this->smallCars);
        $this->booking->fleets()->save($this->mediumCars);
        $this->booking->fleets()->save($this->largeCars);
        $this->booking->fleets()->save($this->xlargeCars);
        $this->booking->billingAddress()->create($this->addressForBooking->toArray());



        $this->booking->appointments()->create([
            'user_id' => auth()->user()->id,
            'date' => $this->timeslot_date,
            'start_time' => '00:00',
            'end_time' => '00:00',
            'assigned_to' => $this->booking->assigned_to,
        ]);

        $this->booking->push();
        return redirect(route('bookings.company.review', ['booking' => $this->booking]));
    }


    public function render()
    {
        return view('livewire.booking.create-company-form');
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
}
