<div>
    <x-header>
        <x-slot name="title">{{ __('app.bookings') }}</x-slot>
        <x-slot name="actions">

            @cannot('manage_bookings')
            <x-form-button method="GET" action="{{ route('bookings.create') }}" buttonType="primary">
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
        <div class="px-2 py-2  sm:space-x-2">
            <label class="inline-flex items-center w-full sm:w-auto">
                <input type="checkbox" class="form-checkbox w-6 h-6 text-green-400 " wire:model="showPast">
                <span class="ml-2">{{ __('Past bookings') }}</span>
            </label>

            <label class="inline-flex items-center w-full sm:w-auto">
                <input type="checkbox" class="form-checkbox w-6 h-6 text-green-400 " wire:model="showCanceled">
                <span class="ml-2">{{ __('Canceled bookings') }}</span>
            </label>
        </div>

        <div class="hidden sm:block">
            <x-table>
                <x-slot name="head">
                    <x-table.heading sortable multi-column wire:click="sortBy('booking_datetime')" :direction="$sorts['booking_datetime'] ?? null" > {{ __('app.cleaning_date') }}</x-table.heading>
                    @can('manage_bookings')
                    <x-table.heading sortable multi-column wire:click="sortBy('number_plate')" :direction="$sorts['number_plate'] ?? null"> {{ __('app.car') }}</x-table.heading>
                    @endcan
                    <x-table.heading sortable multi-column wire:click="sortBy('loc_route')" :direction="$sorts['loc_route'] ?? null" >{{ __('app.car_location') }}</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('service_type')" :direction="$sorts['service_type'] ?? null" >{{ __('app.cleaning') }}</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('brutto_total_amount')" :direction="$sorts['brutto_total_amount'] ?? null"  >{{ __('app.price') }}</x-table.heading>
                    <x-table.heading sortable multi-column wire:click="sortBy('status')" :direction="$sorts['status'] ?? null" >{{ __('app.status') }}</x-table.heading>
                    <x-table.heading> </x-table.heading>
                </x-slot>

                <x-slot name="body">
                    @forelse ($bookings as $booking)
                    <x-table.row>
                        <x-table.cell>
                            {{ $booking->booking_datetime }}
                        </x-table.cell>
                        @can('manage_bookings')
                        <x-table.cell>
                            {{ $booking->car->car_model }}, {{ $booking->car->number_plate }}
                            <br />
                            {{ $booking->car->car_color }}, <span class="capitalize">{{ $booking->car->car_size }}</span>
                        </x-table.cell>
                        @endcan('manage_bookings')
                        <x-table.cell>
                            {!! $booking->parkingLocationAddress !!}
                        </x-table.cell>
                        <x-table.cell>
                            @if ($booking->service_type == 'outside')
                            {{ __('app.outside') }}
                            @else
                            {{ __('app.in_outside') }}
                            @endif
                        </x-table.cell>
                        <x-table.cell>
                            <span class="text-cool-gray-900 font-medium">{{ $booking->formatedTotalCost  }}</span>
                        </x-table.cell>
                        <x-table.cell>
                            <x-booking-status :status="$booking->status" />
                        </x-table.cell>
                        <x-table.cell>
                            @if($booking->status == 'draft' || $booking->status == 'pending')
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



        <!-- make mobile version work -->
        <div class="block sm:hidden px-2 py-4">
            <x-grid.list>
                @forelse ($bookings as $booking)
                <x-grid.list.card>
                    <x-slot name="information">
                        <div class="flex-1 truncate">
                            <p class="mt-1 text-gray-500 text-sm leading-5 truncate"> {{ __('app.cleaning_date')}}
                            </p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                {{ $booking->booking_datetime }}
                            </div>

                            @can('manage_bookings')
                            <p class="mt-2 text-gray-500 text-sm leading-5 truncate">{{ __('app.car') }}</p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                {{ $booking->car->car_model }}, {{ $booking->car->number_plate }}
                                <br />
                                {{ $booking->car->car_color }}, <span class="capitalize">{{ $booking->car->car_size }}</span>
                            </div>
                            @endcan

                            <p class="mt-2 text-gray-500 text-sm leading-5 truncate">{{ __('app.car_location') }}
                            </p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                {!! $booking->parkingLocationAddress !!}
                            </div>

                            <p class="mt-2 text-gray-500 text-sm leading-5 truncate">{{ __('app.cleaning') }}</p>
                            <div class="text-gray-900 text-sm leading-5 font-medium truncate">
                                @if ($booking->service_type == 'outside')
                                {{ __('app.outside') }}
                                @else
                                {{ __('app.in_outside') }}
                                @endif
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
                            @if($booking->status == 'draft' || $booking->status == 'pending')
                            @cannot('manage_bookings')
                            <x-form-button method="GET" action="/bookings/{{ $booking->id }}/edit" buttonType="primary">
                                {{ __('app.checkout') }}
                            </x-form-button>
                            @endcannot
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

        <div class="mt-2">
            {{ $bookings->links() }}
        </div>
    </div>
</div>