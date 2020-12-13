<?php

namespace App\Http\Livewire;

use App\Models\BillingAddress;
use Livewire\Component;

class AddBookingAddress extends Component
{

    public $isCompany = 0;
    public $newAddress;
    public $showAddressModal = false;

    protected $listeners = ['createAddress'];

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


    public function createAddress()
    {
        $this->newAddress = BillingAddress::make(['is_company' => $this->isCompany, 'country'=> 'Schweiz']);
        $this->showAddressModal = true;
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
        return view('livewire.add-booking-address');
    }
}
