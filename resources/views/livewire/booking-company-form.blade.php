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
        <div class="max-w-7xl mx-auto py-4 sm:px-6 lg:px-8 ">
            <div class="grid grid-cols-6 gap-3">
                <div class="col-span-6 sm:col-span-4 grid grid-cols-6 gap-6 px-4 py-5 bg-white shadow rounded-md sm:px-20">
                    <div class="col-span-6  py-2 border-b border-gray-200 flex justify-between items-center bg-white pb-2 sm:pt-4 sm:items-baseline">
                        <h2 class="text-2xl font-extrabold text-gray-900">{{ __('Client') }}</h2>
                        <div class="flex flex-shrink-0 items-center space-x-2">
                            <a href="{{ route('bookings.private.create') }}" class="text-cool-gray-500 font-medium px-4 hover:text-green-500">{{ __('Private')}}</a>
                            <div class="px-4 py-2 bg-green-50 text-green-500 font-bold rounded-md">{{ __('Business')}}</div>
                        </div>
                    </div>

                    @if ($errors->any())
                    <div class="col-span-6 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- booking.service_type -->
                    <x-input.group class="col-span-6" for="parkingStreet" label="{{ __('Location of the service')}}">
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

                    <!-- SMALL -->
                    <div class="col-span-6">
                        <h3 class="text-1xl mb-2 font-bold text-gray-900">{{ __('pricespage.carcategory1type') }} <span class="font-normal">{{ __('pricespage.carcategory1examples') }}</span></h3>

                        <x-input.inline-group class="w-full" for="smallCars.outside" label="{{ __('app.outside')}} ({{ __('Piece') }})">
                            <x-input.text type="number" wire:model="smallCars.outside" min="0" max="100" value="0" required />
                        </x-input.inline-group>

                        <x-input.inline-group class="w-full " for="smallCars.inoutside" label="{{ __('app.in_outside')}} ({{ __('Piece') }})">
                            <x-input.text type="number" wire:model="smallCars.inoutside" min="0" max="100" value="0" required />
                        </x-input.inline-group>
                    </div>

                    <!-- MEDIUM -->
                    <div class="col-span-6">
                        <h3 class="text-1xl mb-2 font-bold text-gray-900">{{ __('pricespage.carcategory2type') }} <span class="font-normal">{{ __('pricespage.carcategory2examples') }}</span></h3>
                        <x-input.inline-group class="w-full" for="mediumCars.outside" label="{{ __('app.outside')}} ({{ __('Piece') }})">
                            <x-input.text type="number" wire:model="mediumCars.outside" min="0" max="100" value="0" required />
                        </x-input.inline-group>

                        <x-input.inline-group class="w-full" for="mediumCars.inoutside" label="{{ __('app.in_outside')}} ({{ __('Piece') }})">
                            <x-input.text type="number" wire:model="mediumCars.inoutside" min="0" max="100" value="0" required />
                        </x-input.inline-group>
                    </div>

                    <!-- LARGE -->
                    <div class="col-span-6">
                        <h3 class="text-1xl mb-2 font-bold text-gray-900">{{ __('pricespage.carcategory3type') }} <span class="font-normal">{{ __('pricespage.carcategory3examples') }}</span></h3>

                        <x-input.inline-group class="w-full" for="largeCars.outside" label="{{ __('app.outside')}} ({{ __('Piece') }})">
                            <x-input.text type="number" wire:model="largeCars.outside" min="0" max="100" value="0" required />
                        </x-input.inline-group>

                        <x-input.inline-group class="w-full" for="largeCars.inoutside" label="{{ __('app.in_outside')}} ({{ __('Piece') }})">
                            <x-input.text type="number" wire:model="largeCars.inoutside" min="0" max="100" value="0" required />
                        </x-input.inline-group>

                    </div>



                    <!-- X-LARGE -->
                    <div class="col-span-6">
                        <h3 class="text-1xl mb-2 font-bold text-gray-900">{{ __('pricespage.carcategory4type') }} <span class="font-normal">{{ __('pricespage.carcategory4examples') }}</span></h3>
                        <x-input.inline-group class="w-full" for="xlargeCars.outside" label="{{ __('app.outside')}} ({{ __('Piece') }})">
                            <x-input.text type="number" wire:model="xlargeCars.outside" min="0" max="100" value="0" required />
                        </x-input.inline-group>

                        <x-input.inline-group class="w-full" for="xlargeCars.inoutside" label="{{ __('app.in_outside')}} ({{ __('Piece') }})">
                            <x-input.text type="number" wire:model="xlargeCars.inoutside" min="0" max="100" value="0" required />
                        </x-input.inline-group>
                    </div>



                    <!-- SURCHARGE -->
                    <div class="col-span-6">
                        <h3 class="text-1xl mb-2 font-bold text-gray-900">{{ __('app.dirty_surcharge') }}</h3>

                        <x-input.inline-group class="w-full" for="booking.extra_dirt" label="{{ __('app.extra_dirt')}} ({{ __('Piece') }})">
                            <x-input.text wire:model="booking.extra_dirt" type="number" min="0" max="100" value="0" required />
                        </x-input.inline-group>

                        <x-input.inline-group class="w-full" for="booking.animal_hair" label="{{ __('app.animal_hair')}} ({{ __('Piece') }})">
                            <x-input.text wire:model="booking.animal_hair" type="number" min="0" max="100" value="0" required />
                        </x-input.inline-group>
                    </div>



                    <!-- booking date -->
                    <x-input.group class="col-span-6" for="date" label="{{ __('app.date') }}">
                        <x-input.date wire:model="booking.date" placeholder="DD.MM.YYYY" required />
                    </x-input.group>


                    <!-- email -->
                    <x-input.group class="col-span-6 sm:col-span-3" for="email" label="{{ __('app.email') }}">
                        <x-input.text wire:model="booking.email" name="email" type="email" required />
                    </x-input.group>

                    <!-- phone number -->
                    <x-input.group class="col-span-6 sm:col-span-3" for="phone" label="{{ __('app.phone') }}">
                        <x-input.text wire:model="booking.phone" name="phone" type="tel" placeholder="e.g. +41 79 123 12 12" required />
                    </x-input.group>


                    <!-- BILLING ADDRESS -->
                    <x-input.group class="col-span-6" for="addressForBooking" label="{{ __('app.billing_address') }}">
                        @isset($addressForBooking)
                        <p>{{ $addressForBooking->first_name }} {{ $addressForBooking->last_name }}, </p>
                        <p>{{ $addressForBooking->company_name }}, </p>
                        <p>{{ $addressForBooking->street }}</p>
                        <p>{{ $addressForBooking->postal_code }} {{ $addressForBooking->city }} </p>
                        <p>{{ $addressForBooking->country }} </p>
                        @endisset
                        <div class="space-x-4">
                            <a wire:click="$emit('createAddress')" class="cursor-pointer text-green-500 font-bold hover:text-green-700 active:text-green-800">{{ __('Add new')}}</a>
                            <a wire:click="showAddresses" class="cursor-pointer text-green-500 font-bold hover:text-green-700 active:text-green-800">{{ __('Select other')}}</a>
                        </div>
                    </x-input.group>

                    <div class="col-span-6 my-4">
                        <x-jet-label for="notes" value="{{ __('app.remarks') }}" />
                        <textarea wire:model="booking.notes" name="notes" class="mt-1 block w-full form-input" rows="4" cols="50"></textarea>
                    </div>

                </div>

                <!-- DESKTOP & MOBILE -->
                <div class="col-span-6 sm:col-span-2">
                    <div class="shadow px-4 py-5 bg-white rounded-md sticky top-0">
                        <div class="text-xl mb-4 font-extrabold">{{ __('app.summary') }} </div>

                        <div class="flex justify-between border-t border-b border-cool-gray-200 py-2">
                            <div>
                                <div>{{ __('Fee') }}</div>
                                <div>{{ __('app.dirty_surcharge') }}</div>
                            </div>
                            <div>
                                <div class="text-gray-500 text-right"> {{ $booking->formatedBaseCost }} </div>
                                <div class="text-gray-500 text-right">{{ $booking->formatedExtraCost }} </div>
                            </div>
                        </div>
                        <div class="flex justify-between border-b border-cool-gray-200 py-2">
                            <div>
                                <div class="font-semibold">{{ __('Sub total') }}</div>
                            </div>
                            <div>
                                <div class="font-semibold text-right"> {{ $booking->formatedTotalCost }} </div>
                            </div>
                        </div>

                        <div class="flex justify-between border-b border-cool-gray-200 py-2">
                            <div>
                                <div>{{ __('Fleet discount') }}</div>
                                <div class="font-semibold">{{ __('Discounted cost') }}</div>
                            </div>
                            <div>
                                <div class="text-right">{{ $booking->fleet_discount }} %</div>
                                <div class="font-semibold"> {{ $booking->formatedDiscountedCost }}</div>
                            </div>
                        </div>


                        <div class="flex justify-between py-2">
                            <div>{{ __('app.duration') }}</div>
                            <div> {{ $booking->formatedDuration }}</div>
                        </div>

                        <div class="flex items-center justify-end pt-4 ">
                            <x-button wire:loading.attr="disabled" buttonType="primary" type="submit">
                                {{ __('Review') }}
                            </x-button>
                        </div>
                    </div>
                </div>
                <!-- EOF PRICE WIDGET -->
            </div>
        </div>
    </form>

    <livewire:add-booking-address :isCompany="1">

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
                                <p>{{ $address->company_name }}, </p>
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