













<!-- NOT USING YOU ANYMORE --> 



            <div class="flex flex-wrap content-start">
                <div class="shadow overflow-hidden sm:rounded-md  w-full sm:w-4/6">
                    <div class="px-4 py-5 bg-white sm:p-10 sm:px-20">
                        <div class="grid grid-cols-6 gap-4">

                            <x-input.group for="serviceType" label="{{ __('Cleaning service') }}">
                                <x-input.readonly>
                                    @if ($newBooking['service_type'] == 'outside')
                                        {{ __('Outside only') }}
                                    @else
                                        {{ __('Inside and outsdie') }}
                                    @endif
                                </x-input.readonly>
                            </x-input.group>

                            <div class="col-span-6 border-cool-gray-200 mt-4">
                                <h3 class="text-2xl font-medium text-gray-900">Car Information</h3>
                            </div>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="parkingStreet"
                                label="{{ __('Parking Location') }}">
                                <x-input.readonly>
                                    <p>{{ $newBooking['parking_street'] }} </p>
                                    <p>{{ $newBooking['parking_postal_code'] }},
                                        {{ $newBooking['parking_city'] }}
                                    </p>
                                </x-input.readonly>
                            </x-input.flexible-group>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="vehicleModel"
                                label="{{ __('Car Model') }}">
                                <x-input.readonly>
                                    {{ $newBooking['vehicle_model'] }}
                                </x-input.readonly>
                            </x-input.flexible-group>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="numberPlate"
                                label="{{ __('Plate number') }}">
                                <x-input.readonly>
                                    {{ $newBooking['number_plate'] }}
                                </x-input.readonly>
                            </x-input.flexible-group>


                            <!-- color -->
                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="vehicleColor"
                                label="{{ __('Car color') }}">
                                <x-input.readonly class="capitalize">
                                    {{ $newBooking['vehicle_color'] }}
                                </x-input.readonly>
                            </x-input.flexible-group>


                            <!-- car size -->
                            <x-input.group for="vehicleSize" label="{{ __('Car size') }}">
                                <x-input.readonly>
                                    @if ($newBooking['vehicle_size'] == 'small')
                                        {{ __('Small') }}
                                    @elseif($newBooking['vehicle_size'] == 'medium')
                                        {{ __('Medium') }}
                                    @elseif($newBooking['vehicle_size'] == 'large')
                                        {{ __('Large') }}
                                    @else
                                        {{ __('Extra large') }}
                                    @endif
                                </x-input.readonly>
                            </x-input.group>


                            <!-- Extra dirt  and  Animal hair -->
                            <x-input.group for="vehicleSize" label="{{ __('Additional information') }}">
                                <x-input.readonly>
                                    @if ($newBooking['has_extra_dirt'] == 1)
                                        <span class="ml-2">{{ __('Extra dirt on car') }}</span>

                                    @endif
                                    @if ($newBooking['has_animal_hair'] == 1)
                                        <span class="ml-2">{{ __('Animal hair') }}</span>
                                    @endif

                                    @if ($newBooking['has_animal_hair'] == 0 && $newBooking['has_animal_hair'] == 0)
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
                                <x-input.readonly>
                                    {{ $newBooking['BookingTimeslot']['date'] }}
                                </x-input.readonly>
                            </x-input.flexible-group>

                            <!-- timeslots -->
                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="bookingTime"
                                label="{{ __('Starting time') }}">
                                <x-input.readonly>
                                    {{  $newBooking['BookingTimeslot']['start_time'] }}
                                    <span class="text-gray-500"> (c.a. {{ $newBooking['service_duration'] }}
                                        min)
                                </x-input.readonly>
                            </x-input.flexible-group>

                            <!-- billing addresss -->

                            <div class="col-span-6 border-cool-gray-200 mt-4">
                                <h3 class="text-2xl font-medium text-gray-900">{{ __('Billing address') }}</h3>
                            </div>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingFirstName"
                                label="{{ __('First Name') }}">
                                <x-input.readonly>
                                    {{ $newBooking['billing_first_name'] }}
                                </x-input.readonly>
                            </x-input.flexible-group>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingLastName"
                                label="{{ __('Last Name') }}">
                                {{ $newBooking['billing_last_name'] }}
                            </x-input.flexible-group>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingStreet"
                                label="{{ __('Street') }}">
                                {{ $newBooking['billing_street'] }}
                            </x-input.flexible-group>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingPostalCode"
                                label="{{ __('Postal code') }}">
                                {{ $newBooking['billing_postal_code'] }}
                            </x-input.flexible-group>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingCity"
                                label="{{ __('City') }}">
                                {{ $newBooking['billing_city'] }}
                            </x-input.flexible-group>

                            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingCountry"
                                label="{{ __('Country') }}">
                                {{ $newBooking['billing_country'] }}
                            </x-input.flexible-group>




                            <div class="col-span-6 ">
                                <x-jet-label for="notes" value="{{ __('Notes') }}" />
                                @if ($newBooking['notes'])
                                    {{ $newBooking['notes'] }}
                                @else
                                    -
                                @endif
                            </div>

                            <!-- TODO: remove this -->
                            <input type="text" hidden id="aliasCC" name="aliasCC" value="noAlias">
                            <input type="text" hidden id="sign" name="sign" value="{{ $paymentDetails['sign'] }}">
                            <input type="text" hidden id="currency" name="currency"
                                value="{{ $paymentDetails['currency'] }}">
                            <input type="text" hidden id="refno" name="refno" value="{{ $paymentDetails['refno'] }}">
                            <input type="text" hidden id="amount" name="amount" value="{{ $paymentDetails['amount'] }}">
                            <input type="text" hidden id="merchantId" name="merchantId"
                                value="{{ $paymentDetails['merchantId'] }}">
                        </div>
                    </div>
                </div>



                <div class="hidden sm:block  w-2/6">
                    <div class="ml-0 sm:ml-6 shadow  px-4 py-5 bg-white sm:rounded-md sticky bottom-0 sm:top-4 ">

                        <div class="flex justify-between border-cool-gray-200 py-1">
                            <div class="text-xl">{{ __('Total cost') }} </div>
                            <div class="text-xl font-bold"> {{ $newBooking['service_price'] }}</div>
                        </div>

                        <div class="flex justify-between border-cool-gray-200 py-1 ">
                            {{ __('You will be redirected to the Datatrans payment page.') }}
                        </div>
                  
                        <div class="flex items-center justify-between pt-4 ">
                            @livewire('booking.review', ['booking' => $newBooking ])                             
                            @livewire('booking.paybutton', ['booking' => $newBooking, 'paymentDetails' => $paymentDetails ])                     
                        </div>
                    </div>
                </div>
            </div>
        </div>

