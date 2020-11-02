<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking details') }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto pt-5 sm:py-5 sm:px-6 lg:px-8 ">
        <div class=" bg-white rounded ">
            <div class=" max-w-screen-xl mx-auto py-8 px-4 sm:px-16 lg:px-20">
                @if ($booking->payment)
                    @if ($booking->payment['status'] == 'failed')
                        <div class="py-4 w-full sm:max-w-7xl mx-auto ">
                            <x-flash.error x-data="{open: true}" x-show.transition.out="open">
                                <x-slot name="title">
                                    Payment could not be completed
                                </x-slot>

                                <x-slot name="description">
                                    Reason: {{ $booking->payment['detail_fail_msg'] }}
                                </x-slot>

                                <x-slot name="actions">
                                    <a href="/payments/redirectToDatatrans/{{ $booking->id }}"
                                        class="ml-3 px-2 py-1.5 rounded-md text-sm leading-5 font-medium text-red-800 hover:bg-red-100 focus:outline-none focus:bg-red-100 transition ease-in-out duration-150">
                                        Try again
                                    </a>

                                    <x-form action='/bookings/{{ $booking->id }}/delete'>
                                        <button
                                            class="ml-3 px-2 py-1.5 rounded-md text-sm leading-5 font-medium text-red-800 hover:bg-red-100 focus:outline-none focus:bg-red-100 transition ease-in-out duration-150">
                                            Delete booking
                                        </button>
                                    </x-form>
                                </x-slot>
                            </x-flash.error>
                        </div>
                    @endif
                @endif


                <div class="px-4 py-5 sm:p-0">
                    <dl>
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                                {{ __('Cleaning service') }}
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                @if ($booking['service_type'] == 'outside')
                                    {{ __('Outside only') }}
                                @else
                                    {{ __('Inside and outsdie') }}
                                @endif
                            </dd>
                        </div>
                        <div
                            class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                                {{ __('Service price') }}
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $booking->moneyPrice }}
                                @if ($booking->payment && $booking->payment['status'] == 'settled')
                                    <span
                                        class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-green-100 text-green-800">
                                        Paid
                                    </span>
                                @else
                                    <span
                                        class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-yellow-100 text-yellow-800">
                                        Not yet paid
                                    </span>
                                @endif

                                
                                <div class="mt-4">
                                    @if ($booking->payment)
                                    <a href="" class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-lg text-gray-800 bg-gray-100 hover:bg-gray-300 focus:outline-none focus:border-gray-300 focus:shadow-outline-gray active:bg-gray-400 transition ease-in-out duration-150">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3 17C3 16.4477 3.44772 16 4 16H16C16.5523 16 17 16.4477 17 17C17 17.5523 16.5523 18 16 18H4C3.44772 18 3 17.5523 3 17ZM6.29289 9.29289C6.68342 8.90237 7.31658 8.90237 7.70711 9.29289L9 10.5858L9 3C9 2.44772 9.44771 2 10 2C10.5523 2 11 2.44771 11 3L11 10.5858L12.2929 9.29289C12.6834 8.90237 13.3166 8.90237 13.7071 9.29289C14.0976 9.68342 14.0976 10.3166 13.7071 10.7071L10.7071 13.7071C10.5196 13.8946 10.2652 14 10 14C9.73478 14 9.48043 13.8946 9.29289 13.7071L6.29289 10.7071C5.90237 10.3166 5.90237 9.68342 6.29289 9.29289Z" fill="currentColor"/>
                                            </svg>
                                            Invoice
                                    </a>
                                    @endif

                                    @if ($booking->payment && $booking->payment['status'] == 'settled')
                                    <a href="" class="inline-flex items-center ml-4 px-3 py-1 border border-transparent text-sm font-medium rounded-lg text-gray-800 bg-gray-100 hover:bg-gray-300 focus:outline-none focus:border-gray-300 focus:shadow-outline-gray active:bg-gray-400 transition ease-in-out duration-150">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3 17C3 16.4477 3.44772 16 4 16H16C16.5523 16 17 16.4477 17 17C17 17.5523 16.5523 18 16 18H4C3.44772 18 3 17.5523 3 17ZM6.29289 9.29289C6.68342 8.90237 7.31658 8.90237 7.70711 9.29289L9 10.5858L9 3C9 2.44772 9.44771 2 10 2C10.5523 2 11 2.44771 11 3L11 10.5858L12.2929 9.29289C12.6834 8.90237 13.3166 8.90237 13.7071 9.29289C14.0976 9.68342 14.0976 10.3166 13.7071 10.7071L10.7071 13.7071C10.5196 13.8946 10.2652 14 10 14C9.73478 14 9.48043 13.8946 9.29289 13.7071L6.29289 10.7071C5.90237 10.3166 5.90237 9.68342 6.29289 9.29289Z" fill="currentColor"/>
                                            </svg>
                                            Reciept
                                    </a>
                                    @endif
                                </div>
                                
                            </dd>
                        </div>
                        <div
                            class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                                Location of cleaning
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $booking['parking_route'] }} {{ $booking['parking_street_number'] }},
                                {{ $booking['parking_city'] }}, {{ $booking['parking_postal_code'] }}
                            </dd>
                        </div>
                        <div
                            class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                                Car information
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $booking['vehicle_model'] }}, {{ $booking['vehicle_color'] }},
                                {{ $booking['number_plate'] }}
                            </dd>
                        </div>
                        <div
                            class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                                Car category
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                @if ($booking['vehicle_size'] == 'small')
                                    {{ __('Small') }}
                                @elseif($booking['vehicle_size'] == 'medium')
                                    {{ __('Medium') }}
                                @elseif($booking['vehicle_size'] == 'large')
                                    {{ __('Large') }}
                                @else
                                    {{ __('Extra large') }}
                                @endif
                            </dd>
                        </div>
                        <div
                            class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                                Cleaning date and time
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $booking->bookingTimeslot->date }} {{ $booking->bookingTimeslot->start_time }} <span
                                    class="text-gray-500"> (c.a. {{ $booking['service_duration'] }} min)
                            </dd>
                        </div>
                        <div
                            class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                                Billing address
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                <p>
                                    {{ $booking['billing_first_name'] }} {{ $booking['billing_last_name'] }},
                                </p>
                                <p>
                                    {{ $booking['billing_street'] }}
                                </p>
                                <p>
                                    {{ $booking['billing_postal_code'] }}, {{ $booking['billing_city'] }}
                                </p>
                                {{ $booking['billing_country'] }}
                            </dd>
                        </div>
                        <div
                            class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-b sm:border-gray-200 sm:px-6 sm:py-5">
                            <dt class="text-sm leading-5 font-medium text-gray-500">
                                Notes
                            </dt>
                            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                @if ($booking['notes'])
                                    {{ $booking['notes'] }}
                                @else
                                    -
                                @endif
                            </dd>
                        </div>

                    </dl>
                </div>

                <div class="mt-4 bg-blue-50 border-l-4 border-blue-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="text-sm leading-5 text-blue-700 ml-3">
                            <p class="font-bold">Cancelation policy</p>
                            <p class="">
                                3 hours before the Cleaning - Full refund
                            </p>
                            <p class="">
                                2 hours before the Cleaning - 50% refund
                            </p>
                            <p class="">
                                1 hour before the Cleaning - 20% refund
                            </p>
                            <p class="">
                                less than a hour before the Cleaning or without cancelation - no refund
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-4 sm:flex  justify-between space-y-5 sm:space-y-0">
                    <a  href="/bookings/" >
                        <x-div-button class="w-full sm:w-auto" buttonType="secondary">
                            {{ __('Back to overview') }}
                        </x-div-button>
                    </a>  

                    <x-confirms-cancelation actionLink="/bookings/{{ $booking->id }}/delete">
                        <x-div-button class="w-full sm:w-auto" buttonType="destructive">
                            Cancel booking
                        </x-div-button>
                    </x-confirms-cancelation>
                </div>

            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
