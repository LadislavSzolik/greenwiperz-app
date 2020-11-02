<div class='mt-2 md:mt-0'>
    <form wire:submit.prevent="submitBooking">
        @csrf

        @if (!$checkoutVisibility)
            <div class="flex flex-wrap content-start">
                <div class="shadow overflow-hidden sm:rounded-md  w-full sm:w-4/6 ">
                    <div class="px-4 py-5 bg-white sm:p-10 sm:px-20">
                        <div class="grid grid-cols-6 gap-6">

                            @if (session()->has('message'))
                                <div class="col-span-6 bg-red-100 text-red-800 rounded p-4">
                                    {{ session('message') }}
                                </div>
                            @endif

                            <x-input.group for="serviceType" label="{{ __('Cleaning service') }}">
                                <x-input.radio wire:model="serviceType" name="serviceType" value="outside"
                                    text="{{ __('Outside only') }}" subText=" ">
                                </x-input.radio>
                                <x-input.radio wire:model="serviceType" name="serviceType" value="inside-outside"
                                    text="{{ __('Inside and outsdie') }}" subText=" ">
                                </x-input.radio>
                            </x-input.group>

                            <div class="col-span-6 border-cool-gray-200">
                                <h3 class="text-2xl font-medium text-gray-900">Car Information</h3>
                            </div>

                            <x-input.group for="parkingStreet" label="{{ __('Parking Location') }}">
                                <p class="text-xs text-gray-500">Your address needs to be selected from the dropdown
                                    after you typed the street address.</p>
                                <x-input.location-search wire:ignore id="parkingStreet" type="text"
                                    placeholder="Start typing..." />
                                @if ($errors->has('street_number') || $errors->has('street_number') || $errors->has('route'))
                                    <p class='text-sm text-red-600'>{{ __('Please provide the entire address.') }}</p>
                                @endif

                                @error('postal_code')
                                <p class='text-sm text-red-600'>
                                    {{ __('Unfortunately our services are not yet available in this area. Please call us on +41 123 12 12 to discuss further details.') }}
                                </p>
                                @enderror

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
                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="bookingDate"
                                label="{{ __('Day of the cleaning') }}">
                                <x-input.date-picker wire:model="bookingDate" id="bookingDate" type="text"
                                    placeholder="DD.MM.YYYY" />
                            </x-input.flexible-group>

                            <!-- timeslots -->                                                   
                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="bookingTime"
                                label="{{ __('Available timeslots') }}">

                                <div class="mt-1 flex rounded-md shadow-sm ">
                                    <span
                                        class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18ZM11 6C11 5.44772 10.5523 5 10 5C9.44771 5 9 5.44772 9 6V10C9 10.2652 9.10536 10.5196 9.29289 10.7071L12.1213 13.5355C12.5118 13.9261 13.145 13.9261 13.5355 13.5355C13.9261 13.145 13.9261 12.5118 13.5355 12.1213L11 9.58579V6Z" />
                                        </svg>
                                    </span>
                                    <select class="rounded-none rounded-r-md flex-1 form-input block w-full" id="bookingTime" wire:model="bookingTime" >
                                        @if (is_array($availableSlots) || is_object($availableSlots))
                                            @forelse($availableSlots as $timeslot)
                                                <option>{{ Carbon\Carbon::parse($timeslot)->format('H:i') }} </option>
                                            @empty                                
                                                <option>No timeslot</option>
                                            @endforelse
                                        @endif
                                    </select>                                    
                                </div>
                                @empty($availableSlots)
                                    <p class="text-xs mt-1 ml-1 text-gray-500">Select a date with available timeslots</p>
                                @endempty
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
                                    placeholder="Switzerland" />
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
                            <div class="font-bold"> {{ $this->moneyPrice }}</div>
                        </div>

                        <div class="flex justify-between border-b border-cool-gray-200 py-2">
                            <div>{{ __('Aproximate duration') }} </div>
                            <div class="font-bold"> {{ $serviceDuration }} min</div>
                        </div>

                        <div class="flex items-center justify-end pt-4 ">
                            <x-div-button wire:loading.attr="disabled" buttonType="primary"
                                wire:click="goToReviewPage()">
                                {{ __('To the checkout') }}
                            </x-div-button>
                        </div>
                    </div>
                </div>

                <!-- MOBILE -->
                <div class="block sm:hidden w-full sticky bottom-0">
                    <div class="px-4 pt-2 pb-4 bg-cool-gray-300 ">
                        <div class="text-base mb-2">{{ __('Price and aprox. duration') }} </div>

                        <div class="flex justify-between items-center">
                            <div class="font-bold">
                                {{ $this->moneyPrice }}/ {{ $serviceDuration }} min
                            </div>
                            <div>
                                <x-div-button wire:loading.attr="disabled" buttonType="primary"
                                    wire:click="goToReviewPage()">
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
                                    @elseif($vehicleSize == 'medium')
                                        {{ __('Medium') }}
                                    @elseif($vehicleSize == 'large')
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

                                    @if ($hasExtraDirt == 0 && $hasAnimalHair == 0)
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
                                    @if ($bookingTime)
                                        {{ Carbon\Carbon::parse($bookingTime)->addMinutes($travelTimeNeeded)->format('H:i') }}
                                        <span class="text-gray-500"> (c.a. {{ $serviceDuration }} min)
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

                            <!-- terms and conditions -->
                            <x-input.flexible-group class="col-span-6" for="termsAndConditions"
                                label="{{ __('Terms and conditions') }}">
                                <label class="mt-2 inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox w-6 h-6 text-green-400 "
                                        wire:model.defer="termsAndConditions">
                                    <span class="ml-2">{{ __('I accept the Greenwiperz GmbH terms and conditions.') }}</span>
                                </label>
                            </x-input.flexible-group>

                        </div>
                    </div>
                </div>


                <!-- DESKTOP -->
                <div class="hidden sm:block  w-2/6">
                    <div class="ml-0 sm:ml-6 shadow  px-4 py-5 bg-white sm:rounded-md sticky bottom-0 sm:top-4 ">

                        <div class="flex justify-between border-cool-gray-200 py-1">
                            <div class="text-xl">{{ __('Total cost') }} </div>
                            <div class="text-xl font-bold">{{ $this->moneyPrice }}</div>
                        </div>

                        <div class="flex justify-between border-cool-gray-200 py-1 ">
                            {{ __('To make a payment, you will be redirected to the Datatrans payment page.') }}
                        </div>

                        <div class="flex items-center justify-between pt-4 ">
                            <x-div-button wire:loading.attr="disabled" wire:click="goBackToEdit()">
                                {{ __('Change booking') }}
                            </x-div-button>

                            <x-button buttonType="primary" wire:loading.attr="disabled">
                                {{ __('Pay') }}
                            </x-button>
                        </div>
                    </div>
                </div>


                <!-- MOBILE -->
                <div class="block sm:hidden w-full sticky bottom-0   ">
                    <div class="px-4 pt-2 pb-4 bg-cool-gray-300 shadow-2xl ">

                        <div class="flex justify-between border-cool-gray-200 py-1">
                            <div class="text-xl">{{ __('Total cost') }} </div>
                            <div class="text-xl font-bold">{{ $this->moneyPrice }}</div>
                        </div>

                        <div class="text-sm text-gray-600">
                            {{ __('To make a payment, you will be redirected to the Datatrans payment page.') }}
                        </div>

                        <div class="flex justify-between mt-2 ">
                            <x-div-button class="w-full" wire:loading.attr="disabled"
                                wire:click="goBackToEdit()">
                                {{ __('Change booking') }}
                            </x-div-button>
                            <x-button class="ml-2 w-full" buttonType="primary" wire:loading.attr="disabled">
                                {{ __('Pay') }}
                            </x-button>
                        </div>
                    </div>
                </div>


            </div>
        @endif
    </form>
</div>
