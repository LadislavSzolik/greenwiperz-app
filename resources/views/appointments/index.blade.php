<x-app-layout>
    <x-slot name="header">
       
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My appointments') }}
        </h2>                    
    </x-slot>    

    @if (session()->has('deleted'))
        <div class="py-4 sm:px-6 px-4 w-full sm:max-w-7xl mx-auto ">
            <x-flash.success x-data="{open: true}" x-show.transition.out="open">
                <x-slot name="title">
                    Booking deletion
                </x-slot>

                <x-slot name="description">
                    Your booking was successfully deleted. 
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
                <x-table.heading>Cleaning date</x-table.heading>
                <x-table.heading>Car/Parking</x-table.heading>             
                <x-table.heading>Cleaning</x-table.heading>  
                <x-table.heading>Contact</x-table.heading>             
                <x-table.heading> </x-table.heading>
            </x-slot>

            <x-slot name="body">
                @forelse ($appointments as $appointment)
                    <x-table.row>

                        <x-table.cell>
                            {{ $appointment->date }} {{ $appointment->start_time }}
                        </x-table.cell>

                        <x-table.cell>
                           <div>
                               {{ $appointment->booking->bookingService->number_plate }}
                           </div>
                            <div>
                                {{ $appointment->booking->bookingService->vehicle_model }}
                            </div>
                        </x-table.cell>

                        <x-table.cell>
                            <p>{{$appointment->booking->bookingService->parking_route }} {{$appointment->booking->bookingService->parking_street_number }}</p>
                            <p>{{$appointment->booking->bookingService->parking_postal_code }}, {{$appointment->booking->bookingService->parking_city }}
                        </x-table.cell>

                        <x-table.cell>
                            {{$appointment->booking->bookingService->service_type }}                         

                        </x-table.cell>

                        <x-table.cell>
                            <span class="text-cool-gray-900 font-medium">{{$appointment->booking->invoice->moneyPrice  }}</span>
                           
                           
                        @unless($appointment->booking->refund)
                            @isset ($appointment->booking->paid_at )
                                <span
                                    class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-green-100 text-green-800">
                                    Paid
                                </span>
                            @else
                                <span
                                    class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-yellow-100 text-yellow-800">
                                    Not yet paid
                                </span>
                            @endisset
                        @endunless
                        @isset($appointment->booking->refund)
                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-green-100 text-green-800">
                            Canceled & Refunded {{$appointment->booking->refund->moneyRefundedAmount }}
                            </span>
                        @endisset
                            
                        </x-table.cell>

                        <x-table.cell>
                            <x-form-button method="GET" action="/appointments/{{ $appointment->id }}" buttonType="secondary">
                                {{ __('details') }}
                            </x-form-button>                                
                        </x-table.cell>
                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell colspan="6" class="text-center ">
                            <span class="text-gray-500">No appointment for you</span>
                        </x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>
        </x-table>

        <div class="mt-2">
            {{ $appointments->links() }}
        </div>
    </div>

    <div class="block sm:hidden px-2 py-4">
        <x-grid.list>
            @forelse ($appointments as $appointment)
                <x-grid.list.card>
                    <x-slot name="information">
                        <div class="flex-1 truncate">
                            <p class="mt-1 text-gray-500 text-sm leading-5 truncate"> Cleaning date and time
                            </p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                {{$appointment->date }} {{$appointment->start_time }}
                            </div>

                            <p class="mt-2 text-gray-500 text-sm leading-5 truncate">Car
                            </p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                <span class="font-semibold">{{$appointment->booking->bookingService->number_plate }}</span>
                                {{$appointment->booking->bookingService->vehicle_model }}
                            </div>

                            <p class="mt-2 text-gray-500 text-sm leading-5 truncate">Car parking place
                            </p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                {{$appointment->booking->bookingService->parking_route }} {{$appointment->booking->bookingService->parking_street_number }}
                            </div>

                            <p class="mt-2 text-gray-500 text-sm leading-5 truncate"> Cleaning service</p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                {{$appointment->booking->bookingService->service_type }}
                            </div>

                            <p class="mt-2 text-gray-500 text-sm leading-5 truncate">Price</p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                <span>{{$appointment->booking->invoice->moneyPrice  }}</span>
                            </div>

                            @unless($appointment->booking->refund)
                            @isset ($appointment->booking->paid_at )
                                <span
                                    class="ml-0 sm:ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-green-100 text-green-800">
                                    Paid
                                </span>
                            @else
                                <span
                                    class="ml-0 sm:ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-yellow-100 text-yellow-800">
                                    Not yet paid
                                </span>
                            @endisset
                        @endunless
                        @isset($appointment->booking->refund)
                            <span class="ml-0 sm:ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-green-100 text-green-800">
                            Canceled & Refunded {{$appointment->booking->refund->moneyRefundedAmount }}
                            </span>
                        @endisset

                        </div>
                    </x-slot>
                    <x-slot name="actions">
                        <div class="flex flex-no-wrap h-12 justify-center items-center w-full">                            
                            <div class="flex-none w-1/2 text-center">
                                <x-form-button method="GET" action="/appointments/{{ $appointment->id }}" buttonType="tertiary">
                                    {{ __('details') }}
                                </x-form-button>
                            </div>
                        </div>a 
                    </x-slot>
                </x-grid.list.card>
            @empty
                <div class="bg-white shadow-sm rounded-md text-center py-6">
                    <span class="text-gray-500">No appointment for you</span>
                </div>
               
            @endforelse
            {{ $appointments->links() }}
        </x-grid.list>
                      
    </div>
    <x-footer />
</x-app-layout>
