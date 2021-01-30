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

    <!-- MESSEGING --> 
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
    <!-- EOF MESSEGING --> 

    <div class="py-4 sm:px-6 lg:px-8 w-full sm:max-w-7xl mx-auto">
        <div class="hidden sm:block">
            <x-table>
                <x-slot name="head">
                    <x-table.heading sortable wire:click="sortBy('date')" :direction="$sortField == 'date' ? $sortDirection : null"> {{ __('app.cleaning_date') }}</x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('start_time')" :direction="$sortField == 'time' ? $sortDirection : null"> {{ __('Start time') }}</x-table.heading>
                    <x-table.heading sortable wire:click="sortBy('end_time')" :direction="$sortField == 'time' ? $sortDirection : null"> {{ __('End time') }}</x-table.heading>
                    <x-table.heading >{{ __('app.car_location') }}</x-table.heading>
                    <x-table.heading >{{ __('app.price') }}</x-table.heading>
                    <x-table.heading >{{ __('app.status') }}</x-table.heading>
                    <x-table.heading> </x-table.heading>
                </x-slot>

                <x-slot name="body">
                    @forelse ($appointments as $appointment)
                    <x-table.row>
                        <x-table.cell>
                            {{ $appointment->dateForEditing  }}
                        </x-table.cell>
                        <x-table.cell>
                            {{ $appointment->start_time }}                            
                        </x-table.cell>
                        <x-table.cell>
                            {{ $appointment->end_time }}                            
                        </x-table.cell>
                        <x-table.cell>
                            {!! $appointment->booking->parkingLocationAddress !!}
                        </x-table.cell>
                        <x-table.cell>
                            {{ $appointment->booking->formatedTotalCost }}
                        </x-table.cell>
                        <x-table.cell>
                            <x-booking-status :status="$appointment->booking->status" />
                        </x-table.cell>
                        <x-table.cell>
                            @if($appointment->booking->status == 'draft')
                            @can('manage_bookings')
                                <x-form-button method="GET" action="/bookings/{{ $appointment->booking->id }}" buttonType="tertiary">
                                    {{ __('app.details') }}
                                </x-form-button>
                            @endcan
                            <x-form-button method="DELETE" action="/bookings/{{ $appointment->booking->id }}" buttonType="tertiaryDestructive">
                                {{ __('app.delete') }}
                            </x-form-button>
                            @else
                            <x-form-button method="GET" action="/bookings/{{ $appointment->booking->id }}" buttonType="tertiary">
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

        <!-- TODO: MOBILE version -->

        <div class="mt-2 mx-4 sm:mx-0">
            {{ $appointments->links() }}
        </div>
    </div>

    

</div>