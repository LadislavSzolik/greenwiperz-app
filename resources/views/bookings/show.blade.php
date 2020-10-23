<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking details') }}
        </h2>
    </x-slot>

    <x-content-section>        
     
        <div class="grid grid-cols-6 gap-4">

            <x-input.group for="serviceType" label="{{ __('Cleaning service') }}">
                <x-input.readonly>
                    @if ($booking['service_type'] == 'outside')
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
                    <p>{{ $booking['parking_street'] }} </p>
                    <p>{{ $booking['parking_postal_code'] }}, {{ $booking['parking_city'] }}</p>
                </x-input.readonly>
            </x-input.flexible-group>

            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="vehicleModel"
                label="{{ __('Car Model') }}">
                <x-input.readonly>
                    {{ $booking['vehicle_model'] }}
                </x-input.readonly>
            </x-input.flexible-group>

            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="numberPlate"
                label="{{ __('Plate number') }}">
                <x-input.readonly>
                    {{ $booking['number_plate'] }}
                </x-input.readonly>
            </x-input.flexible-group>


            <!-- color -->
            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="vehicleColor"
                label="{{ __('Car color') }}">
                <x-input.readonly>
                    {{ $booking['vehicle_color'] }}
                </x-input.readonly>
            </x-input.flexible-group>


            <!-- car size -->
            <x-input.group for="vehicleSize" label="{{ __('Car size') }}">
                <x-input.readonly>
                    @if ($booking['vehicle_size'] == 'small')
                        {{ __('Small') }}
                    @elseif($booking['vehicle_size'] == 'medium')
                        {{ __('Medium') }}
                    @elseif($booking['vehicle_size'] == 'large')
                        {{ __('Large') }}
                    @else
                        {{ __('Extra large') }}
                    @endif
                </x-input.readonly>
            </x-input.group>


            <!-- Extra dirt  and  Animal hair -->
            <x-input.group for="vehicleSize" label="{{ __('Additional information') }}">
                <x-input.readonly>
                    @if ($booking['has_extra_dirt'] == 1)
                        <span class="ml-2">{{ __('Extra dirt on car') }}</span>

                    @endif
                    @if ($booking['has_animal_hair'] == 1)
                        <span class="ml-2">{{ __('Animal hair') }}</span>
                    @endif

                    @if ($booking['has_animal_hair'] == 0 && $booking['has_animal_hair'] == 0)
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
                    {{ $booking->bookingTimeslot->date }}
                </x-input.readonly>
            </x-input.flexible-group>

            <!-- timeslots -->
            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="bookingTime"
                label="{{ __('Starting time') }}">
                <x-input.readonly>
                    {{ $booking->bookingTimeslot->start_time }}
                    <span class="text-gray-500"> (c.a. {{ $booking['service_duration'] }} min)
                </x-input.readonly>
            </x-input.flexible-group>

            <!-- billing addresss -->

            <div class="col-span-6 border-cool-gray-200 mt-4">
                <h3 class="text-2xl font-medium text-gray-900">{{ __('Billing address') }}</h3>
            </div>

            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingFirstName"
                label="{{ __('First Name') }}">
                <x-input.readonly>
                    {{ $booking['billing_first_name'] }}
                </x-input.readonly>
            </x-input.flexible-group>

            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingLastName"
                label="{{ __('Last Name') }}">
                {{ $booking['billing_last_name'] }}
            </x-input.flexible-group>

            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingStreet"
                label="{{ __('Street') }}">
                {{ $booking['billing_street'] }}
            </x-input.flexible-group>

            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingPostalCode"
                label="{{ __('Postal code') }}">
                {{ $booking['billing_postal_code'] }}
            </x-input.flexible-group>

            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingCity"
                label="{{ __('City') }}">
                {{ $booking['billing_city'] }}
            </x-input.flexible-group>

            <x-input.flexible-group class="col-span-6 sm:col-span-3" for="billingCountry"
                label="{{ __('Country') }}">
                {{ $booking['billing_country'] }}
            </x-input.flexible-group>




            <div class="col-span-6 ">
                <x-jet-label for="notes" value="{{ __('Notes') }}" />
                @if ($booking['notes'])
                    {{ $booking['notes'] }}
                @else
                    -
                @endif
            </div>                
        </div>
        
        <div class="mt-2 ">
            <x-form-button method="GET" action="/bookings/" > {{ __('Back to overview') }}</x-form-button>                            
        </div>

    </x-content-section>
</x-app-layout>

