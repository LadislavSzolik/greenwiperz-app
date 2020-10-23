<div class='mt-2 md:mt-0'>
    <form wire:submit.prevent="submitBooking">
        @csrf
       
        @if (!$checkoutVisibility)
        <div  class="flex flex-wrap content-start">
                <div class="shadow overflow-hidden sm:rounded-md  w-full sm:w-4/6">
                    <div class="px-4 py-5 bg-white sm:p-10 sm:px-20">
                        <div class="grid grid-cols-6 gap-6">
                            <x-input.group for="serviceType" label="{{ __('Cleaning service') }}">
                                <x-input.radio wire:model="serviceType" name="serviceType" value="outside"
                                    text="{{ __('Outside only') }}" subText="{{ __('from CHF 65') }}">
                                </x-input.radio>
                                <x-input.radio wire:model="serviceType" name="serviceType" value="inside-outside"
                                    text="{{ __('Inside and outsdie') }}" subText="{{ __('from CHF 125') }}">
                                </x-input.radio>
                            </x-input.group>

                            <div class="col-span-6 border-cool-gray-200">
                                <h3 class="text-2xl font-medium text-gray-900">Car Information</h3>
                            </div>

                            <x-input.group for="parkingStreet" label="{{ __('Parking Location') }}">                                
                                <x-input.location-search wire:ignore id="parkingStreet" type="text" placeholder="Start typing..." />                                
                                @if($errors->has('postal_code'))
                                    <p class='text-sm text-red-600'>{{ __('Unfortunately our services are not available in this area. Please call us on +41 123 12 12 to discuss further details.')}}</p>
                                @endif   
                                                      
                            </x-input.group>

                            <x-input.group for="vehicleModel" label="{{ __('Car Model') }}">
                                <x-input.text wire:model.defer="vehicleModel" id="vehicleModel" type="text"
                                    placeholder="e.g. Honda Civic" />
                            </x-input.group>

                            <x-input.group for="numberPlate" label="{{ __('Plate number') }}">
                                <x-input.text wire:model.defer="numberPlate" id="numberPlate" type="text"
                                    placeholder="e.g. ZH123452" />
                            </x-input.group>


                            <!-- color -->
                            <x-input.flexible-group class="col-span-6" for="vehicleColor" label="{{ __('Car color') }}">
                                <x-input.color-picker wire:model="vehicleColor" />
                            </x-input.flexible-group>

                            <!-- car size -->
                            <x-input.group for="vehicleSize" label="{{ __('Car size') }}">
                                <x-input.radio wire:model="vehicleSize" name="vehicleSize" value="small"
                                    text="{{ __('Small') }}" subText="{{ __('e.g. Smart, Mini, Fiat500') }}">
                                </x-input.radio>

                                <x-input.radio wire:model="vehicleSize" name="vehicleSize" value="medium"
                                    text="{{ __('Medium') }}" subText="{{ __('e.g. Sportwagen, Limusine, Kombi') }}">
                                </x-input.radio>

                                <x-input.radio wire:model="vehicleSize" name="vehicleSize" value="large"
                                    text="{{ __('Large') }}" subText="{{ __('e.g. SUV, VAN, 7 sitzer') }}">
                                </x-input.radio>

                                <x-input.radio wire:model="vehicleSize" name="vehicleSize" value="x-large"
                                    text="{{ __('Extra large') }}" subText="{{ __('e.g. Kleinbus') }}">
                                </x-input.radio>
                            </x-input.group>




                            <!-- Extra dirt  and  Animal hair -->
                            <div class="col-span-6 sm:col-span-4">
                                <x-jet-label for="additionalInformation" value="{{ __('Additional information') }}" />
                                <div>
                                    <div class="mt-2">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" class="form-checkbox w-6 h-6 text-green-400 "
                                                wire:model.defer="hasExtraDirt">
                                            <span class="ml-2">{{ __('Extra dirt on car') }}</span>
                                        </label>
                                    </div>
                                    <div class="mt-2">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" class="form-checkbox w-6 h-6 text-green-400 "
                                                wire:model.defer="hasAnimalHair">
                                            <span class="ml-2">{{ __('Animal hair ') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-6 border-cool-gray-200">
                                <h3 class="text-2xl font-medium text-gray-900">{{ __('Date and time') }}</h3>
                                <p>Please select a date and time for the cleaning.</p>
                            </div>

                            <!-- booking date -->
                            <x-input.flexible-group class="col-span-6 ms:col-span-3" for="bookingDate"
                                label="{{ __('Day of the cleaning') }}">
                                <x-input.date-picker wire:model="bookingDate" id="bookingDate" type="text"
                                    placeholder="DD.MM.YYYY" />
                            </x-input.flexible-group>                          

                            <!-- timeslots -->
                            <x-input.flexible-group class="col-span-6 ms:col-span-3" for="bookingTime"
                                label="{{ __('Available timeslots') }}">
                                <x-input.timepicker :bookingTime="$bookingTime" :availableSlots="$availableSlots"
                                    :travelTimeNeeded="$travelTimeNeeded" :serviceDuration="$serviceDuration"
                                    id="bookingTime" type="text" />
                            </x-input.flexible-group>

                            <!-- billing addresss -->

                            <div class="col-span-6 border-cool-gray-200">
                                <h3 class="text-2xl font-medium text-gray-900">{{ __('Billing address') }}</h3>
                            </div>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingFirstName"
                                label="{{ __('First Name') }}">
                                <x-input.text wire:model.defer="billingFirstName" id="billingFirstName" type="text"
                                    placeholder="e.g. Andrea" />
                            </x-input.flexible-group>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingLastName"
                                label="{{ __('Last Name') }}">
                                <x-input.text wire:model.defer="billingLastName" id="billingLastName" type="text"
                                    placeholder="e.g. Muster" />
                            </x-input.flexible-group>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingStreet"
                                label="{{ __('Street') }}">
                                <x-input.text wire:model.defer="billingStreet" id="billingStreet" type="text"
                                    placeholder="e.g. Hauptstrasse 12" />
                            </x-input.flexible-group>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingPostalCode"
                                label="{{ __('Postal code') }}">
                                <x-input.text wire:model.defer="billingPostalCode" id="billingPostalCode" type="text"
                                    placeholder="e.g. 8046" />
                            </x-input.flexible-group>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingCity"
                                label="{{ __('City') }}">
                                <x-input.text wire:model.defer="billingCity" id="billingCity" type="text"
                                    placeholder="e.g. Zurich" />
                            </x-input.flexible-group>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingCountry"
                                label="{{ __('Country') }}">
                                <x-input.text wire:model.defer="billingCountry" id="billingCountry" type="text"
                                    placeholder="CH" />
                            </x-input.flexible-group>

                            <div class="col-span-6 ">
                                <x-jet-label for="notes" value="{{ __('Notes') }}" />
                                <textarea id="notes" name="notes" class="mt-1 block w-full form-input"
                                    wire:model="notes" rows="4" cols="50"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DESKTOP -->
                <div class="hidden sm:block  w-2/6">
                    <div class="ml-0 sm:ml-6 shadow  px-4 py-5 bg-white sm:rounded-md sticky bottom-0 sm:top-4 ">
                        <div class="text-xl mb-4">{{ __('Cleaning service') }} </div>

                        <div class="flex justify-between border-b border-cool-gray-200 py-2">
                            <div>{{ __('Total cost') }} </div>
                            <div class="font-bold"> {{ $servicePrice }}</div>
                        </div>

                        <div class="flex justify-between border-b border-cool-gray-200 py-2">
                            <div>{{ __('Aproximate duration') }} </div>
                            <div class="font-bold"> {{ $serviceDuration }} min</div>
                        </div>

                        <div class="flex items-center justify-end pt-4 ">
                            <x-div-button wire:loading.attr="disabled" wire:click="toggleCheckoutVisibility()">
                                {{ __('To the checkout') }}
                            </x-div-button>
                        </div>
                    </div>
                </div>

                <!-- MOBILE -->
                <div class="block sm:hidden w-full sticky bottom-0 shadow-md  ">
                    <div class="px-4 pt-2 pb-4 bg-cool-gray-100 ">
                        <div class="text-base mb-2">{{ __('Cleaning service price and duration') }} </div>

                        <div class="flex justify-between items-center">
                            <div class="font-bold">
                                CHF {{ $servicePrice }}/ {{ $serviceDuration }} min
                            </div>
                            <div>
                                <x-div-button wire:loading.attr="disabled" wire:click="toggleCheckoutVisibility()">
                                    {{ __('To the checkout') }}
                                </x-div-button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        @else

<!-- start of read only part -->
            <div class="flex flex-wrap content-start">
                <div class="shadow overflow-hidden sm:rounded-md  w-full sm:w-4/6">
                    <div class="px-4 py-5 bg-white sm:p-10 sm:px-20">
                        <div class="grid grid-cols-6 gap-4">

                            <x-input.group for="serviceType" label="{{ __('Cleaning service') }}">
                                <x-input.readonly>
                                    @if ($serviceType == 'outside')
                                        {{ __('Outside only') }}
                                    @else
                                        {{ __('Inside and outsdie') }}
                                    @endif
                                </x-input.readonly>
                            </x-input.group>

                            <div class="col-span-6 border-cool-gray-200 mt-4">
                                <h3 class="text-2xl font-medium text-gray-900">Car Information</h3>
                            </div>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="pakringLocation"
                                label="{{ __('Parking Location') }}">
                                <x-input.readonly>
                                    <p>{{ $parkingRoute }} {{ $parkingStreetNumber }}</p>
                                    <p>{{ $parkingPostalCode }},{{ $parkingCity }}</p>
                                </x-input.readonly>
                            </x-input.flexible-group>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="vehicleModel"
                                label="{{ __('Car Model') }}">
                                <x-input.readonly>
                                    {{ $vehicleModel }}
                                </x-input.readonly>
                            </x-input.flexible-group>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="numberPlate"
                                label="{{ __('Plate number') }}">
                                <x-input.readonly>
                                    {{ $numberPlate }}
                                </x-input.readonly>
                            </x-input.flexible-group>


                            <!-- color -->
                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="vehicleColor"
                                label="{{ __('Car color') }}">
                                <x-input.readonly class="capitalize">
                                    {{ $vehicleColor }}
                                </x-input.readonly>
                            </x-input.flexible-group>


                            <!-- car size -->
                            <x-input.group for="vehicleSize" label="{{ __('Car size') }}">
                                <x-input.readonly>
                                    @if ($vehicleSize == 'small')
                                        {{ __('Small') }}
                                    @elseif($vehicleSize  == 'medium')
                                        {{ __('Medium') }}
                                    @elseif($vehicleSize  == 'large')
                                        {{ __('Large') }}
                                    @else
                                        {{ __('Extra large') }}
                                    @endif
                                </x-input.readonly>
                            </x-input.group>


                            <!-- Extra dirt  and  Animal hair -->
                            <x-input.group for="vehicleSize" label="{{ __('Additional information') }}">
                                <x-input.readonly>
                                    @if ($hasExtraDirt == 1)
                                        <span class="ml-2">{{ __('Extra dirt on car') }}</span>

                                    @endif
                                    @if ($hasAnimalHair == 1)
                                        <span class="ml-2">{{ __('Animal hair') }}</span>
                                    @endif

                                    @if($hasExtraDirt == 0 && $hasAnimalHair == 0)
                                    -
                                    @endif
                                </x-input.readonly>
                            </x-input.group>


                            <div class="col-span-6 border-cool-gray-200 mt-4">
                                <h3 class="text-2xl font-medium text-gray-900">{{ __('Date and time') }}</h3>
                            </div>

                            <!-- booking date -->
                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="bookingDate"
                                label="{{ __('Day of the cleaning') }}">                               
                                    {{ $bookingDate }}                            
                            </x-input.flexible-group>

                            <!-- timeslots -->
                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="bookingTime"
                                label="{{ __('Starting time') }}">
                                <x-input.readonly>
                                    @if($bookingTime) 
                                    {{ Carbon\Carbon::parse($bookingTime)->addMinutes($travelTimeNeeded)->format('H:i') }} <span class="text-gray-500"> (c.a. {{ $serviceDuration }} min)
                                    @endif
                                </x-input.readonly>
                            </x-input.flexible-group>

                            <!-- billing addresss -->
                            <div class="col-span-6 border-cool-gray-200 mt-4">
                                <h3 class="text-2xl font-medium text-gray-900">{{ __('Billing address') }}</h3>
                            </div>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingFirstName"
                                label="{{ __('First Name') }}"> 
                                {{ $billingFirstName }}                               
                            </x-input.flexible-group>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingLastName"
                                label="{{ __('Last Name') }}">
                                {{ $billingLastName }}
                            </x-input.flexible-group>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingStreet"
                                label="{{ __('Street') }}">
                                {{ $billingStreet }}
                            </x-input.flexible-group>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingPostalCode"
                                label="{{ __('Postal code') }}">
                                {{ $billingPostalCode }}
                            </x-input.flexible-group>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingCity"
                                label="{{ __('City') }}">
                                {{ $billingCity }}
                            </x-input.flexible-group>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingCountry"
                                label="{{ __('Country') }}">
                                {{ $billingCountry }}
                            </x-input.flexible-group>




                            <div class="col-span-6 ">
                                <x-jet-label for="notes" value="{{ __('Notes') }}" />
                                @if ($notes)
                                    {{ $notes }}
                                @else
                                    -
                                @endif
                            </div>
                            
                        </div>
                    </div>
                </div>


                <!-- DESKTOP -->
                <div class="hidden sm:block  w-2/6">
                    <div class="ml-0 sm:ml-6 shadow  px-4 py-5 bg-white sm:rounded-md sticky bottom-0 sm:top-4 ">

                        <div class="flex justify-between border-cool-gray-200 py-1">
                            <div class="text-xl">{{ __('Total cost') }} </div>
                            <div class="text-xl font-bold"> {{ $servicePrice }}</div>
                        </div>

                        <div class="flex justify-between border-cool-gray-200 py-1 ">
                            {{ __('You will be redirected to the Datatrans payment page.') }}
                        </div>

                        <div class="flex items-center justify-between pt-4 ">
                            <x-div-button wire:loading.attr="disabled" wire:click="toggleCheckoutVisibility()">
                                {{ __('Change booking') }}
                            </x-div-button>

                            <x-button wire:loading.attr="disabled" >
                                {{ __('Pay') }}
                            </x-button>
                        </div>
                    </div>
                </div>


                <!-- MOBILE -->
            </div>
        @endif
    </form>
</div>

