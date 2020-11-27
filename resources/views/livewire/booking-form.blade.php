<div  class="grid grid-cols-6 gap-3">
    <div class="col-span-6 sm:col-span-4 grid grid-cols-6 gap-6 px-4 py-5 bg-white shadow rounded-md sm:px-20">
        @csrf
        <input hidden wire:model="duration" name="duration" />
        <input hidden wire:model="baseCost" name="baseCost" />
        <input hidden wire:model="extraCost" name="extraCost" />
        <input hidden wire:model="bruttoTotalAmount" name="bruttoTotalAmount" />
        <input hidden wire:model="locStreetNumber" name="locStreetNumber" />
        <input hidden wire:model="locRoute" name="locRoute" />
        <input hidden wire:model="locPostalCode" name="locPostalCode" />
        <input hidden wire:model="locCity" name="locCity" />        
        <input hidden name="hasExtraDirt" value="{{ $hasExtraDirtLocal==1 ?  1 : 0}}" />
        <input hidden name="hasAnimalHair" value="{{ $hasAnimalHairLocal==1 ?  1 : 0}}" />

        @if(session()->has('message'))
        <div class="col-span-6 bg-red-100 text-red-700 rounded p-2">{{ __(session('message')) }}</div>
        @endif
                
        <x-input.group class="col-span-6" for="serviceType" label="{{ __('app.cleaning')}}">
            <x-input.radio wire:model="serviceType" name="serviceType" value="outside" text="{{ __('app.outside')}}" >
            </x-input.radio>
            <x-input.radio wire:model="serviceType" name="serviceType" value="inside-outside" text="{{ __('app.in_outside')}}" >
            </x-input.radio>
        </x-input.group>


        <!-- CAR INFORMATION -->
        <div class="col-span-6 border-cool-gray-200 -mb-4">
            <h3 class="text-2xl font-extrabold text-gray-900">{{ __('app.car')}}</h3>
        </div>

        <!-- booking.service_type -->
        <x-input.group class="col-span-6" for="parkingStreet" label="{{ __('app.car_location')}}">
            <div class="mt-2 mb-2 bg-blue-50 border-l-4 border-blue-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="text-sm leading-5 text-blue-700 ml-3">
                        {{ __('app.google_autocomplete_info_text')}}
                    </div>
                </div>
            </div>
            <x-input.location-search wire:ignore id="parkingStreet" name="parkingStreet" type="text" placeholder="{{ __('app.start_typing') }}" required />
            @if ($errors->has('street_number') || $errors->has('street_number') || $errors->has('route'))
            <p class='text-sm text-red-600'>{{ __('app.google_autocomplete_error_1') }}</p>
            @endif

            @error('postal_code')
            <p class='text-sm text-red-600'>
                {{ __('app.google_autocomplete_error_2') }}               
            </p>
            @enderror
        </x-input.group>

        <x-input.group class="col-span-6" for="carModel" label="{{ __('app.car_model')}}">
            <x-input.text wire:model="carModel" name="carModel" type="text" placeholder="e.g. Honda Civic" required />
        </x-input.group>

        <x-input.group class="col-span-6 sm:col-span-3" for="numberPlate" label="{{ __('app.plate_number')}}">
            <x-input.text wire:model="numberPlate" name="numberPlate" type="text" placeholder="e.g. ZH123452" required />
        </x-input.group>

        <!-- color -->
        <x-input.group class="col-span-6 sm:col-span-3" for="carColor" label="{{ __('app.car_color') }}">
            <x-input.color wire:model="carColor" name="carColor"  />
        </x-input.group>


        <!-- car size -->
        <x-input.group class="col-span-6" for="carSize" label="{{ __('app.car_category') }}">
            <x-input.radio wire:model="carSize" name="carSize" value="small" text="{{ __('pricespage.carcategory1type') }}" subText="{{ __('pricespage.carcategory1examples') }}">
            </x-input.radio>

            <x-input.radio wire:model="carSize" name="carSize" value="medium" text="{{ __('pricespage.carcategory2type') }}" subText="{{ __('pricespage.carcategory2examples') }}">
            </x-input.radio>

            <x-input.radio wire:model="carSize" name="carSize" value="large" text="{{ __('pricespage.carcategory3type') }}" subText="{{ __('pricespage.carcategory3examples') }}">
            </x-input.radio>

            <x-input.radio wire:model="carSize" name="carSize" value="x-large" text="{{ __('pricespage.carcategory4type') }}" subText="{{ __('pricespage.carcategory4examples') }}">
            </x-input.radio>
        </x-input.group>




        <!-- Extra dirt  and  Animal hair -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label value="{{ __('app.dirty_surcharge') }} + CHF 30.00" />
            <div>
                <div class="mt-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox w-6 h-6 text-green-400 " wire:model="hasExtraDirtLocal">
                        <span class="ml-2">{{ __('app.extra_dirt') }}</span>                        
                    </label>
                </div>
                <div class="mt-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox w-6 h-6 text-green-400 " wire:model="hasAnimalHairLocal" >
                        <span class="ml-2">{{ __('app.animal_hair') }}</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- phone number -->
        <x-input.group class="col-span-6" for="phone" label="{{ __('app.phone') }} ({{ __('app.optional') }})">
            <x-input.text wire:model="phone" name="phone" type="tel" placeholder="e.g. +41 79 123 12 12" />
        </x-input.group>


        <!-- DATE AND TIME -->
        <div class="col-span-6 border-cool-gray-200 -mb-4">
            <h3 class="text-2xl font-extrabold text-gray-900">{{ __('app.date_time') }}</h3>            
        </div>


        <!-- timeslots -->        
        @if(count($wipers) > 1)
        <x-input.group class="col-span-6" for="assignedTo" label="{{ __('Greenwiper') }}">
            <div class="mt-1 flex rounded-md shadow-sm">
                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </span>
                <select class="rounded-none rounded-r-md flex-1 form-input block w-full" name="assignedTo" wire:model="assignedTo">                   
                    @foreach($wipers as $wiper)
                    <option value="{{ $wiper->id }}"> {{ $wiper->name }}</option>
                    @endforeach                    
                </select>
            </div>            
        </x-input.group>
        @else
        <input hidden wire:model="assignedTo" name="assignedTo" />
        @endif


        <!-- booking date -->
        <x-input.group class="col-span-6 sm:col-span-3" for="bookingDate" label="{{ __('app.date') }}">            
            <x-input.date wire:model="bookingDate" name="bookingDate" placeholder="DD.MM.YYYY"/>
        </x-input.group>

        <!-- timeslots -->
        <x-input.group class="col-span-6 sm:col-span-3" for="bookingTime" label="{{ __('app.available_timeslots') }}">
            <div class="mt-1 flex rounded-md shadow-sm">
                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18ZM11 6C11 5.44772 10.5523 5 10 5C9.44771 5 9 5.44772 9 6V10C9 10.2652 9.10536 10.5196 9.29289 10.7071L12.1213 13.5355C12.5118 13.9261 13.145 13.9261 13.5355 13.5355C13.9261 13.145 13.9261 12.5118 13.5355 12.1213L11 9.58579V6Z" />
                    </svg>
                </span>
                <select class="rounded-none rounded-r-md flex-1 form-input block w-full" name="bookingTime" wire:model="bookingTime" required>
                    @if (is_array($availableSlots) || is_object($availableSlots))
                    @forelse($availableSlots as $timeslot)
                    <option value="{{ $timeslot }} " >{{ Carbon\Carbon::parse($timeslot)->format('H:i') }} </option>
                    @empty
                    <option value='' >{{ __('app.no_timeslot') }}</option>
                    @endforelse
                    @endif
                </select>
            </div>
            @empty($availableSlots)
            <p class="text-xs mt-1 ml-1 text-gray-500">{{ __('app.select_day_w_timeslot') }}</p>
            @endempty
        </x-input.group>


        <!-- BILLING ADDRESS -->
        <div class="col-span-6 border-cool-gray-200 -mb-4">
            <h3 class="text-2xl font-extrabold text-gray-900">{{ __('app.billing_address') }}</h3>
        </div>

        <x-input.group class="col-span-6 sm:col-span-3" for="billFirstName" label="{{ __('app.first_name') }}">
            <x-input.text wire:model="billFirstName" name="billFirstName" type="text" placeholder="e.g. Andrea" required />
        </x-input.group>

        <x-input.group class="col-span-6 sm:col-span-3" for="billLastName" label="{{ __('app.last_name') }}">
            <x-input.text wire:model="billLastName" name="billLastName" type="text" placeholder="e.g. Muster" required />
        </x-input.group>

        <x-input.group class="col-span-6" for="billCompanyName" label="{{ __('app.company_name') }} ({{ __('app.optional') }})">
            <x-input.text wire:model="billCompanyName" name="billCompanyName" type="text" placeholder="e.g. SBB" />
        </x-input.group>

        <x-input.group class="col-span-6 sm:col-span-3" for="billStreet" label="{{ __('app.street') }}">
            <x-input.text wire:model="billStreet" name="billStreet" type="text" placeholder="e.g. Hauptstrasse 12" required />
        </x-input.group>

        <x-input.group class="col-span-6 sm:col-span-3" for="billPostalCode" label="{{ __('app.postal_code') }}">
            <x-input.text wire:model="billPostalCode" name="billPostalCode" type="text" placeholder="e.g. 8046" required />
        </x-input.group>

        <x-input.group class="col-span-6 sm:col-span-3" for="billCity" label="{{ __('app.city') }}">
            <x-input.text wire:model="billCity" name="billCity" type="text" placeholder="e.g. Zurich" required />
        </x-input.group>

        <x-input.group class="col-span-6 sm:col-span-3" for="billCountry" label="{{ __('app.country') }}">
            <x-input.text wire:model="billCountry" name="billCountry" type="text" placeholder="Schweiz" />
        </x-input.group>

        <div class="col-span-6 ">
            <x-jet-label for="notes" value="{{ __('app.remarks') }}" />
            <textarea wire:model="notes" name="notes" class="mt-1 block w-full form-input" rows="4" cols="50"></textarea>
        </div>
    </div>
    <!-- DESKTOP -->
    <div class="hidden sm:block col-span-2">
        <div class="shadow px-4 py-5 bg-white rounded-md sticky bottom-0">
            <div class="text-xl mb-4 font-extrabold">{{ __('app.summary') }} </div>

            <div class="flex justify-between border-t border-b border-cool-gray-200 py-2">
                <div>
                    <div>{{ __('app.total_cost') }}</div>
                    <div class="text-gray-500 text-right">{{ __('app.dirty_surcharge') }}</div>
                </div>
                <div >
                    <div class="font-bold"> {{ $this->formatedTotalCost }} </div>
                    <div class="text-gray-500 text-right"> + {{ $this->formatedExtraCost }} </div>
                </div>
            </div>

            <div class="flex justify-between py-2">
                <div>{{ __('app.duration') }}</div>
                <div class="font-bold"> {{ $this->formatedDuration }}</div>
            </div>

            <div class="flex items-center justify-end pt-4 ">
                <x-button wire:loading.attr="disabled" buttonType="primary" type="submit" >
                {{ __('app.checkout') }}
                </x-button>
            </div>
        </div>
    </div>

    <!-- MOBILE -->
    <div class="block col-span-6 sm:hidden w-full sticky bottom-0">
        <div class="px-4 pt-2 pb-6 bg-cool-gray-100 ">
            <div class="text-base">{{ __('app.total_cost') }}/ {{ __('app.duration') }} </div>

            <div class="flex justify-between items-center">
                <div class="font-bold">
                    {{ $this->formatedTotalCost }}/ {{ $this->formatedDuration }}
                </div>
                <div>
                    <x-button wire:loading.attr="disabled" buttonType="primary" type="submit">
                    {{ __('app.checkout') }}
                    </x-button>
                </div>
            </div>
        </div>
    </div>
</div>