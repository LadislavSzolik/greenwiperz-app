<x-app-layout>
    <x-slot name="header">
        <div class="inline-flex  items-center justify-between w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Your bookings') }}
            </h2>
            <x-form-button method="GET" action="{{ route('bookings.create') }}" buttonType="primary">New</x-form-button>
        </div>
    </x-slot>


    @if (session()->has('success'))
        <div class="py-4 sm:px-6 px-4 w-full sm:max-w-7xl mx-auto ">
            <x-flash.success x-data="{open: true}" x-show.transition.out="open">
                <x-slot name="title">
                    Booking confirmation
                </x-slot>

                <x-slot name="description">
                    Your booking was successful.
                </x-slot>

                <x-slot name="actions">
                    <x-form method="GET" action="/bookings/{{ session('success') }}">
                        <button
                            class="px-2 py-1.5 rounded-md text-sm leading-5 font-medium text-green-800 hover:bg-green-100 focus:outline-none focus:bg-green-100 transition ease-in-out duration-150">
                            View details
                        </button>
                    </x-form>
                    <button x-on:click="open=false"
                        class="ml-3 px-2 py-1.5 rounded-md text-sm leading-5 font-medium text-green-800 hover:bg-green-100 focus:outline-none focus:bg-green-100 transition ease-in-out duration-150">
                        Dismiss
                    </button>
                </x-slot>
            </x-flash.success>
        </div>
    @endif

    @if (session()->has('deleted'))
        <div class="py-4 sm:px-6 px-4 w-full sm:max-w-7xl mx-auto ">
            <x-flash.success x-data="{open: true}" x-show.transition.out="open">
                <x-slot name="title">
                    Booking deletion
                </x-slot>

                <x-slot name="description">
                    Your booking was successfully deleted. There were no charges.
                </x-slot>

                <x-slot name="actions">
                    <button x-on:click="open=false"
                        class="ml-3 px-2 py-1.5 rounded-md text-sm leading-5 font-medium text-green-800 hover:bg-green-100 focus:outline-none focus:bg-green-100 transition ease-in-out duration-150">
                        Dismiss
                    </button>
                </x-slot>
            </x-flash.success>
        </div>
    @endif


    @if (session()->has('cancel'))
        <div class="py-4 sm:px-6 px-4 w-full sm:max-w-7xl mx-auto ">
            <x-flash.cancel x-data="{open: true}" x-show.transition.out="open">
                <x-slot name="title">
                    Booking cancelation
                </x-slot>

                <x-slot name="description">
                    {{ session('cancel') }}
                </x-slot>

                <x-slot name="actions">
                    <button x-on:click="open=false"
                        class="ml-3 px-2 py-1.5 rounded-md text-sm leading-5 font-medium text-yellow-800 hover:bg-yellow-100 focus:outline-none focus:bg-yellow-100 transition ease-in-out duration-150">
                        Dismiss
                    </button>
                </x-slot>¯
            </x-flash.cancel>
        </div>
    @endif



    <div class="py-4 sm:px-6 lg:px-8 w-full sm:max-w-7xl mx-auto hidden sm:block">
        <!--  -->
        <x-table>
            <x-slot name="head">
                <x-table.heading sortable>Cleaning date</x-table.heading>
                <x-table.heading>Car</x-table.heading>
                <x-table.heading>Car parking</x-table.heading>
                <x-table.heading>Cleaning</x-table.heading>
                <x-table.heading>Amount </x-table.heading>
                <x-table.heading> </x-table.heading>
            </x-slot>

            <x-slot name="body">
                @foreach ($bookings as $booking)
                    <x-table.row>

                        <x-table.cell>
                            {{ $booking->bookingTimeslot->date }} {{ $booking->bookingTimeslot->start_time }}
                        </x-table.cell>

                        <x-table.cell>
                           <div>
                               {{ $booking->number_plate }}
                           </div>
                            <div>
                                {{ $booking->vehicle_model }}
                            </div>
                        </x-table.cell>

                        <x-table.cell>
                            {{ $booking->parking_route }} {{ $booking->parking_street_number }}
                        </x-table.cell>

                        <x-table.cell>
                            {{ $booking->service_type }}                         

                        </x-table.cell>

                        <x-table.cell>
                            <span class="text-cool-gray-900 font-medium">{{ $booking->moneyPrice  }}</span>
                           
                           
                        @if ($booking->payment && $booking->payment['status'] == 'settled')
                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-green-100 text-green-800">
                            Paid
                        </span>
                        @else
                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-yellow-100 text-yellow-800">
                            Not yet paid
                        </span>
                        @endif
                            
                        </x-table.cell>

                        <x-table.cell>
                            <x-form-button method="GET" action="/bookings/{{ $booking->id }}" buttonType="secondary">
                                {{ __('details') }}
                            </x-form-button>                                
                        </x-table.cell>
                    </x-table.row>
                @endforeach
            </x-slot>
        </x-table>
    </div>

    <div class="block sm:hidden px-2 py-4">
        <x-grid.list>
            @foreach ($bookings as $booking)
                <x-grid.list.card>
                    <x-slot name="information">
                        <div class="flex-1 truncate">
                            <p class="mt-1 text-gray-500 text-sm leading-5 truncate"> Cleaning date and time
                            </p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                {{ $booking->bookingTimeslot->date }} {{ $booking->bookingTimeslot->start_time }}
                            </div>

                            <p class="mt-2 text-gray-500 text-sm leading-5 truncate">Car
                            </p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                <span class="font-semibold">{{ $booking->number_plate }}</span>
                                {{ $booking->vehicle_model }}
                            </div>

                            <p class="mt-2 text-gray-500 text-sm leading-5 truncate">Car parking place
                            </p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                {{ $booking->parking_route }} {{ $booking->parking_street_number }}
                            </div>

                            <p class="mt-2 text-gray-500 text-sm leading-5 truncate"> Cleaning service</p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                {{ $booking->service_type }}
                            </div>

                            <p class="mt-2 text-gray-500 text-sm leading-5 truncate">Price</p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                <span>{{ $booking->moneyPrice  }}</span>
                            </div>

                        </div>
                    </x-slot>
                    <x-slot name="actions">
                        <div class="flex flex-no-wrap h-12 justify-center items-center w-full">                            
                            <div class="flex-none w-1/2 text-center">
                                <x-form-button method="GET" action="/bookings/{{ $booking->id }}" buttonType="tertiary">
                                    {{ __('details') }}
                                </x-form-button>
                            </div>
                        </div>
                    </x-slot>
                </x-grid.list.card>
            @endforeach
        </x-grid.list>
    </div>

    <x-footer />
</x-app-layout>
