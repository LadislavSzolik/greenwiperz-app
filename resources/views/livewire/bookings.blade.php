<div>
    <x-header>
        <x-slot name="title">{{ __('app.bookings') }}</x-slot>
        <x-slot name="actions">

            @cannot('manage_bookings')
            <x-form-button method="GET" action="{{ route('bookings.private.create') }}" buttonType="primary">
                {{ __('app.new') }}
            </x-form-button>
            @endcannot
        </x-slot>
    </x-header>

    @if (session()->has('message'))
    <div class="py-4 sm:px-6 px-4 w-full sm:max-w-7xl mx-auto ">
        <x-flash.universal x-data="{open: true}" :color="session('message')['color']" x-show.transition.out="open">
            <x-slot name="title">
                {{ __(session('message')['title']) }}
            </x-slot>

            <x-slot name="description">
                {{ __(session('message')['description']) }}
            </x-slot>
            <x-slot name="actions">
                <button x-on:click="open=false" class="px-2 py-1.5 rounded-md text-sm leading-5 font-medium hover:bg-{{session('message')['color']}}-100 focus:outline-none focus:bg-{{session('message')['color']}}-100 transition ease-in-out duration-150">
                    {{ __('app.dismiss') }}
                </button>
            </x-slot>
        </x-flash.universal>
    </div>
    @endif


    <div class="py-4 sm:px-6 lg:px-8 w-full sm:max-w-7xl mx-auto">

        <div class="hidden sm:block">
            <x-table>
                <x-slot name="head">
                    <x-table.heading sortable wire:click="sortBy('date')" :direction="$sortField == 'date' ? $sortDirection : null"> {{ __('app.cleaning_date') }}</x-table.heading>   
                    <x-table.heading sortable wire:click="sortBy('time')" :direction="$sortField == 'time' ? $sortDirection : null"> {{ __('Time') }}</x-table.heading>                
                    <x-table.heading sortable wire:click="sortBy('loc_route')" :direction="$sortField == 'loc_route' ? $sortDirection : null">{{ __('app.car_location') }}</x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('brutto_total_amount')" :direction="$sortField == 'brutto_total_amount' ? $sortDirection : null">{{ __('app.price') }}</x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('status')" :direction="$sortField == 'status' ? $sortDirection : null">{{ __('app.status') }}</x-table.heading>
                    <x-table.heading> </x-table.heading>
                </x-slot>

                <x-slot name="body">
                    @forelse ($bookings as $booking)
                    <x-table.row>
                        <x-table.cell>
                            {{ $booking->date }}
                        </x-table.cell>       
                        <x-table.cell>
                            {{ $booking->time }}
                            @empty($booking->time)
                            <p class="text-gray-400">{{ __('Pending') }}</p>
                            @endempty
                        </x-table.cell>                  
                        <x-table.cell>
                            {!! $booking->parkingLocationAddress !!}
                        </x-table.cell>                 
                        <x-table.cell>
                            {{ $booking->formatedTotalCost }}
                        </x-table.cell>
                        <x-table.cell>
                            <x-booking-status :status="$booking->status" />
                        </x-table.cell>
                        <x-table.cell>
                            @if($booking->status == 'draft')
                            @can('manage_bookings')
                                <x-form-button method="GET" action="/bookings/{{ $booking->id }}" buttonType="tertiary">
                                    {{ __('app.details') }}
                                </x-form-button>
                            @endcan
                            <x-form-button method="DELETE" action="/bookings/{{ $booking->id }}" buttonType="tertiaryDestructive">
                                {{ __('app.delete') }}
                            </x-form-button>
                            @else
                            <x-form-button method="GET" action="/bookings/{{ $booking->id }}" buttonType="tertiary">
                                {{ __('app.details') }}
                            </x-form-button>
                            @endif
                        </x-table.cell>
                    </x-table.row>
                    @empty
                    <x-table.row>
                        <x-table.cell colspan="7" class="text-center">
                            <span class="text-gray-500">{{ __('app.no_bookings')}}</span>
                        </x-table.cell>
                    </x-table.row>
                    @endforelse
                </x-slot>
            </x-table>
        </div>


        <div class="block sm:hidden px-2 pb-4">
            <div class="w-full pb-2">
                <x-sort.dropdown>
                    <x-slot name="trigger">{{__('Sorted by') }} {{ __('app.'.$sortField)}}</x-slot>
                    <x-sort.item wire:click="sortBy('date')" :direction="$sortField == 'date' ? $sortDirection : null">{{ __('app.cleaning_date')}}</x-sort.item>
                    <x-sort.item wire:click="sortBy('time')" :direction="$sortField == 'time' ? $sortDirection : null">{{ __('Time')}}</x-sort.item>
                    <x-sort.item wire:click="sortBy('loc_route')" :direction="$sortField == 'loc_route' ? $sortDirection : null">{{ __('app.car_location') }}</x-sort.item>                 
                    <x-sort.item wire:click="sortBy('brutto_total_amount')" :direction="$sortField == 'brutto_total_amount' ? $sortDirection : null">{{ __('app.price')}}</x-sort.item>
                    <x-sort.item wire:click="sortBy('status')" :direction="$sortField == 'status' ? $sortDirection : null">{{ __('app.status')}}</x-sort.item>
                </x-sort.dropdown>
            </div>


            <x-grid.list>
                @forelse ($bookings as $booking)
                <x-grid.list.card>
                    <x-slot name="information">
                        <div class="flex-1 truncate">
                            <p class="mt-1 text-gray-500 text-sm leading-5 truncate"> {{ __('app.cleaning_date')}}
                            </p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                {{ $booking->date }}
                            </div>      
                            
                            <p class="mt-1 text-gray-500 text-sm leading-5 truncate"> {{ __('Time')}}
                            </p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                {{ $booking->time }}
                                @empty($booking->time)
                                <p class="text-gray-400">{{ __('Pending') }}</p>
                                @endempty
                            </div>  

                            <p class="mt-2 text-gray-500 text-sm leading-5 truncate">{{ __('app.car_location') }}
                            </p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                {!! $booking->parkingLocationAddress !!}
                            </div>                       

                            <p class="mt-2 text-gray-500 text-sm leading-5 truncate">{{ __('app.price') }}</p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                <span>{{ $booking->formatedTotalCost  }}</span>
                            </div>
                            <p class="my-2 text-gray-500 text-sm leading-5 truncate">{{ __('app.status') }}</p>
                            <x-booking-status :status="$booking->status" />
                        </div>
                    </x-slot>
                    <x-slot name="actions">
                        <div class="flex flex-no-wrap h-12 px-4 justify-end items-center w-full space-x-8">
                            @if($booking->status == 'draft')                    
                            @can('manage_bookings')
                            <x-form-button method="GET" action="/bookings/{{ $booking->id }}" buttonType="tertiary">
                                {{ __('app.details') }}
                            </x-form-button>
                            @endcan
                            <x-form-button method="DELETE" action="/bookings/{{ $booking->id }}" buttonType="tertiaryDestructive">
                                {{ __('app.delete') }}
                            </x-form-button>
                            @else
                            <x-form-button method="GET" action="/bookings/{{ $booking->id }}" buttonType="secondary">
                                {{ __('app.details') }}
                            </x-form-button>
                            @endif
                        </div>
                    </x-slot>
                </x-grid.list.card>
                @empty
                <div class="bg-white shadow-sm rounded-md text-center py-6">
                    <span class="text-gray-500">{{ __('app.no_bookings') }} </span>
                </div>
                @endforelse
            </x-grid.list>
        </div>

        <div class="mt-2 mx-4 sm:mx-0">
            {{ $bookings->links() }}
        </div>
    </div>
</div>