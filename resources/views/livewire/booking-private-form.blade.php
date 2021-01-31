<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="inline-flex  items-center justify-between w-full">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('New Booking') }}
                </h2>
            </div>
        </div>
    </header>

    <form class="col-span-6" wire:submit.prevent="saveBooking">
        @csrf
        <div class="max-w-7xl mx-auto py-4 sm:px-6 lg:px-8 ">
            <div class="grid grid-cols-6 gap-3">
                <div class="col-span-6 sm:col-span-4 grid grid-cols-6 gap-6 px-4 py-5 bg-white shadow rounded-md sm:px-20">

                    @if(session()->has('message'))
                    <div class="col-span-6 bg-red-100 text-red-700 rounded p-2">{{ __(session('message')) }}</div>
                    @endif

                    <div class="col-span-6 border-b border-gray-200 flex justify-between items-center bg-white sm:pt-4 pb-2  sm:items-baseline">
                        <h2 class="text-2xl font-extrabold text-gray-900">{{ __('Client') }}</h2>
                        <div class="flex flex-shrink-0 items-center space-x-2">
                            <div class="px-4 py-2 bg-green-50 text-green-500 font-bold rounded-md">{{ __('Private')}}</div>
                            <a class="text-cool-gray-500 font-medium px-4 hover:text-green-500" href="{{ route('bookings.company.create') }}">{{ __('Business')}}</a>
                        </div>
                    </div>
                
                    <!-- CAR INFORMATION -->
                    <x-input.group class="col-span-6" for="carForBooking" label="{{ __('app.car')}}">
                        @if(count($cars) > 0)
                        <select class="rounded shadow-sm flex-1 form-input block w-full" name="carForBooking" wire:model="carForBooking" required>
                            @forelse($cars as $car)
                            <option value="{{ $car->id}}">{{ $car->car_model }}, {{ $car->number_plate }}, {{ __($car->car_size) }}, {{ __($car->car_color) }}</option>
                            @empty
                            <option value="">-</option>
                            @endforelse
                        </select>
                        @endif
                        <div class="mt-4">
                            <a wire:click="$emit('createCar')" class=" cursor-pointer px-4 py-2 bg-green-100 rounded  text-green-500 font-bold hover:text-green-700 hover:bg-green-200 active:text-green-800">{{ __('Add new')}}</a>
                        </div>
                    </x-input.group>

                    <x-input.group class="col-span-6 sm:col-span-3" for="serviceType" label="{{ __('app.cleaning')}}">
                        <x-input.radio wire:model="booking.service_type" name="serviceType" value="outside" text="{{ __('app.outside')}}">
                        </x-input.radio>
                        <x-input.radio wire:model="booking.service_type" name="serviceType" value="inside-outside" text="{{ __('app.in_outside')}}">
                        </x-input.radio>
                    </x-input.group>


                    <!-- Extra dirt  and  Animal hair -->
                    <div class="col-span-6 sm:col-span-3">
                        <x-jet-label value="{{ __('app.dirty_surcharge') }}" />
                        <div>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox w-6 h-6 text-green-400 " wire:model="hasExtraDirt">
                                    <span class="ml-2">{{ __('app.extra_dirt') }} + CHF 30.00</span>
                                </label>
                            </div>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" class="form-checkbox w-6 h-6 text-green-400 " wire:model="hasAnimalHair">
                                    <span class="ml-2">{{ __('app.animal_hair') }} + CHF 30.00</span>
                                </label>
                            </div>
                        </div>
                    </div>


                    <!-- booking.service_type -->
                    <x-input.group class="col-span-6" for="parkingStreet" label="{{ __('app.car_location')}}">
                        <div class="mt-2 bg-blue-50 border-blue-400 p-2 rounded-md">
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
                        <div x-data="{show:true}" x-on:load.window="show=false" x-show.transition="show">Loading location services...</div>
                        <div x-data="{show:false}" x-on:load.window="show=true" x-show.transition="show">
                            <x-input.location-search wire:ignore id="parkingStreet" name="parkingStreet" type="text" placeholder="{{ __('app.start_typing') }}" required />
                        </div>

                        @if ($errors->has('street_number') || $errors->has('street_number') || $errors->has('route'))
                        <p class='text-sm text-red-600'>{{ __('app.google_autocomplete_error_1') }}</p>
                        @endif

                        @error('postal_code')
                        <p class='text-sm text-red-600'>{{ __('app.google_autocomplete_error_2') }}</p>
                        @enderror
                    </x-input.group>


                    <!-- wipers -->
                    @if(count($wipers) > 1)
                    <x-input.group class="col-span-6" for="assignedTo" label="{{ __('Greenwiper') }}">
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </span>
                            <select class="rounded-none rounded-r-md flex-1 form-input block w-full" name="assignedTo" wire:model="booking.assigned_to">
                                @foreach($wipers as $wiper)
                                <option value="{{ $wiper->id }}"> {{ $wiper->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </x-input.group>
                    @endif


                    <!-- booking date -->
                    <x-input.group class="col-span-6 sm:col-span-3" for="timeslot_date" label="{{ __('app.date') }}">
                        <x-input.date wire:model="timeslot_date" name="timeslot_date" placeholder="DD.MM.YYYY" />
                    </x-input.group>

                    <!-- timeslots -->
                    <x-input.group class="col-span-6 sm:col-span-3" for="start_time" label="{{ __('app.available_timeslots') }}">
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18ZM11 6C11 5.44772 10.5523 5 10 5C9.44771 5 9 5.44772 9 6V10C9 10.2652 9.10536 10.5196 9.29289 10.7071L12.1213 13.5355C12.5118 13.9261 13.145 13.9261 13.5355 13.5355C13.9261 13.145 13.9261 12.5118 13.5355 12.1213L11 9.58579V6Z" />
                                </svg>
                            </span>
                            <select class="rounded-none rounded-r-md flex-1 form-input block w-full" name="start_time" wire:model="start_time" required>
                                @if (is_array($availableSlots) || is_object($availableSlots))
                                @forelse($availableSlots as $timeslot)
                                <option value="{{ Carbon\Carbon::parse($timeslot)->format('H:i') }}">{{ Carbon\Carbon::parse($timeslot)->format('H:i') }} </option>
                                @empty
                                <option value=''>{{ __('app.no_timeslot') }}</option>
                                @endforelse
                                @endif
                            </select>
                        </div>

                    </x-input.group>


                    <!-- email -->
                    <x-input.group class="col-span-6 sm:col-span-3" for="email" label="{{ __('app.email') }}">
                        <x-input.text wire:model="booking.email" name="email" type="email" required />
                    </x-input.group>

                    <!-- phone number -->
                    <x-input.group class="col-span-6 sm:col-span-3" for="phone" label="{{ __('app.phone') }} ({{ __('app.optional') }})">
                        <x-input.text wire:model="booking.phone" name="phone" type="tel" placeholder="e.g. +41 79 123 12 12" />
                    </x-input.group>


                    <!-- BILLING ADDRESS -->
                    <x-input.group class="col-span-6" for="addressForBooking" label="{{ __('app.billing_address') }}">
                        @isset($addressForBooking)
                        <p>{{ $addressForBooking->first_name }} {{ $addressForBooking->last_name }}, </p>
                        <p>{{ $addressForBooking->street }}</p>
                        <p>{{ $addressForBooking->postal_code }} {{ $addressForBooking->city }} </p>
                        <p>{{ $addressForBooking->country }} </p>
                        @endisset
                        <div class="space-x-4">
                            <a wire:click="$emit('createAddress')" class="cursor-pointer text-green-500 font-bold hover:text-green-700 active:text-green-800">{{ __('Add new')}}</a>
                            <a wire:click="showAddresses" class="cursor-pointer text-green-500 font-bold hover:text-green-700 active:text-green-800">{{ __('Select other')}}</a>
                        </div>
                    </x-input.group>

                    <div class="col-span-6">
                        <x-jet-label for="notes" value="{{ __('app.remarks') }}" />
                        <textarea wire:model="booking.notes" name="notes" class="mt-1 block w-full form-input my-6" rows="4" cols="50"></textarea>
                    </div>
                </div>


                <!-- DESKTOP -->
                <div class="hidden sm:block col-span-2">
                    <div class="shadow px-4 py-5 bg-white rounded-md sticky top-0">
                        <div class="text-xl mb-4 font-extrabold">{{ __('app.summary') }} </div>

                        <div class="flex justify-between border-t border-b border-cool-gray-200 py-2">
                            <div>
                                <div>{{ __('app.total_cost') }}</div>
                                <div class="text-gray-500 text-right">{{ __('app.dirty_surcharge') }}</div>
                            </div>
                            <div>
                                <div class="font-bold"> {{ $booking->formatedTotalCost }} </div>
                                <div class="text-gray-500 text-right"> + {{ $booking->formatedExtraCost }} </div>
                            </div>
                        </div>

                        <div class="flex justify-between py-2">
                            <div>{{ __('app.duration') }}</div>
                            <div class="font-bold"> {{ $booking->formatedDuration }}</div>
                        </div>

                        <div class="flex items-center justify-end pt-4 ">
                            <x-button wire:loading.attr="disabled" buttonType="primary" type="submit">
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
                                {{ $booking->formatedTotalCost }}/ {{ $booking->formatedDuration }}
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
        </div>
    </form>

    <livewire:add-booking-car>

        <livewire:add-booking-address>

            <form wire:submit.prevent="selectAddress">
                <x-jet-dialog-modal maxWidth="md" wire:model="showSelectAddressModal">
                    <x-slot name="title">
                        {{ __('Select Address') }}
                    </x-slot>
                    <x-slot name="content">
                        <ul class="text-sm h-96 overflow-auto">
                            @foreach($addresses as $address)
                            <li wire:key="{{ $loop->index }}" class="flex px-4 py-2 justify-between items-center cursor-pointer border-cool-gray-200 border-t ">
                                <div>
                                    <p>{{ $address->first_name }} {{ $address->last_name }}, </p>
                                    <p>{{ $address->street }}</p>
                                    <p>{{ $address->postal_code }} {{ $address->city }} </p>
                                    <p>{{ $address->country }} </p>
                                </div>
                                <div class="flex space-x-4">
                                    <div wire:click="selectAddress({{$address->id}})" class="text-green-500 font-semibold hover:text-green-600 active:text-green-700">Select</div>
                                    <div wire:click="deleteAddress({{$address->id}})" class="text-red-500 font-semibold hover:text-red-600 active:text-red-700">Delete</div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </x-slot>

                    <x-slot name="footer">
                        <x-jet-secondary-button wire:click="$set('showSelectAddressModal', false)" wire:loading.attr="disabled">
                            {{ __('app.cancel')}}
                        </x-jet-secondary-button>
                    </x-slot>
                </x-jet-dialog-modal>
            </form>
</div>