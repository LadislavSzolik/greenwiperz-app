<?php

namespace App\Http\Livewire\Booking;

use App\Models\BillingAddress;
use Livewire\Component;

class NewAddressModal extends Component
{

    public $isCompany = 0;
    public $newAddress;
    public $showAddressModal = false;

    protected $listeners = ['createAddress', 'addressEntered'];

    protected $rules = [
        'newAddress.is_company' => 'required',
        'newAddress.first_name' => 'required',
        'newAddress.company_name' => 'nullable',
        'newAddress.last_name' => 'required',
        'newAddress.street' => 'required',
        'newAddress.postal_code' => 'required',
        'newAddress.city' => 'required',
        'newAddress.country' => 'required',
    ];

    public function mount()
    {
        $this->newAddress = BillingAddress::make(['is_company' => $this->isCompany, 'country'=> 'Schweiz']);
    }

    public function createAddress()
    {       
        $this->showAddressModal = true;
    }

    public function addressEntered($placeData)
    {
        $this->newAddress->street =  $placeData['route'].' '.$placeData['street_number'];
        $this->newAddress->postal_code = $placeData['postal_code'];
        $this->newAddress->city = $placeData['locality'];    
    }

    public function saveAddress()
    {  
        $this->validate();
        auth()->user()->billingAddresses()->save($this->newAddress);  
        $this->showAddressModal = false;
        $this->emit('addressSaved');
    }


    public function render()
    {
        return view('livewire.booking.new-address-modal');
    }
}
