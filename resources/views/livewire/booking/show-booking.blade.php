<div>
    <x-header>
        <x-slot name="title">{{ __('app.booking_details') }}</x-slot>
        <x-slot name="actions"></x-slot>
    </x-header>


    <div class="max-w-7xl mx-auto pt-5 sm:py-5 sm:px-6 lg:px-8">
        <div class="bg-white rounded-md py-4 sm:py-6 sm:px-20 shadow">

            @if(session()->has('message'))
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

            <div class="px-4 py-5 sm:p-0">
                <dl>
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            {{ __('app.status') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            <x-booking-status :status="$booking->status" />
                        </dd>
                    </div>

                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5 sm:border-t">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            {{ __('app.booking_number') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $booking->booking_nr }}
                        </dd>
                    </div>

                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            {{ __('Location')}}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            {!! $booking->parkingLocationAddress !!}
                        </dd>
                    </div>


                    @if($booking->type == 'private')
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            {{ __('app.car')}}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $booking->car->car_model }}, {{ $booking->car->number_plate }}
                            <br />
                            {{ __($booking->car->car_color) }}, <span class="capitalize">{{ $booking->car->car_size }}</span>
                        </dd>
                    </div>


                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5 sm:border-t ">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            {{ __('app.cleaning') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            @if ($booking->service_type == 'outside')
                            {{ __('app.outside') }}
                            @else
                            {{ __('app.in_outside') }}
                            @endif
                        </dd>
                    </div>

                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            {{ __('app.dirty_surcharge')}}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            @if($booking->extra_dirt)
                            <p> &#10003; {{ __('app.extra_dirt')}} </p>
                            @else
                            <p> &#x2715; {{ __('app.extra_dirt')}}</p>
                            @endif
                            @if($booking->animal_hair)
                            <p> &#10003; {{ __('app.animal_hair')}} </p>
                            @else
                            <p> &#x2715; {{ __('app.animal_hair')}} </p>
                            @endif
                        </dd>
                    </div>
                    @endif


                    @if($booking->type == 'business')
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5 sm:border-t ">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            {{ __('Cars') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2 space-y-2">

                            @if($booking->fleets[0]->outside > 0 || $booking->fleets[0]->inoutside > 0)
                            <p>
                                {{ __('pricespage.carcategory1type') }}:
                                <span class="font-semibold">{{$booking->fleets[0]->outside}}</span>
                                <span class="text-cool-gray-500">({{ __('app.outside')}})</span>,
                                <span class="font-semibold">{{$booking->fleets[0]->inoutside}}</span>
                                <span class="text-cool-gray-500">({{ __('app.in_outside')}})</span>
                            </p>
                            @endif

                            @if($booking->fleets[1]->outside > 0 || $booking->fleets[1]->inoutside > 0)
                            <p>
                                {{ __('pricespage.carcategory2type') }}:
                                <span class="font-semibold">{{$booking->fleets[1]->outside}}</span>
                                <span class="text-cool-gray-500">({{ __('app.outside')}})</span>,
                                <span class="font-semibold">{{$booking->fleets[1]->inoutside}}</span>
                                <span class="text-cool-gray-500">({{ __('app.in_outside')}})</span>
                            </p>
                            @endif

                            @if($booking->fleets[2]->outside > 0 || $booking->fleets[2]->inoutside > 0)
                            <p>
                                {{ __('pricespage.carcategory3type') }}:
                                <span class="font-semibold">{{$booking->fleets[2]->outside}}</span>
                                <span class="text-cool-gray-500">({{ __('app.outside')}})</span>,
                                <span class="font-semibold">{{$booking->fleets[2]->inoutside}}</span>
                                <span class="text-cool-gray-500">({{ __('app.in_outside')}})</span>
                            </p>
                            @endif

                            @if($booking->fleets[3]->outside > 0 || $booking->fleets[3]->inoutside > 0)
                            <p>
                                {{ __('pricespage.carcategory4type') }}:
                                <span class="font-semibold">{{$booking->fleets[3]->outside}}</span>
                                <span class="text-cool-gray-500">({{ __('app.outside')}})</span>,
                                <span class="font-semibold">{{$booking->fleets[3]->inoutside}}</span>
                                <span class="text-cool-gray-500">({{ __('app.in_outside')}})</span>
                            </p>
                            @endif


                        </dd>
                    </div>
                    @endif

                    @if($booking->type == 'private')
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            {{ __('app.total_cost') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            <div class="sm:inline-flex items-center sm:space-x-2 space-y-2 sm:space-y-0">
                                <p>{{ $booking->formatedTotalCost }}</p>

                                <x-document-download link="{{ route('bookings.invoice', $booking->id) }}">
                                    {{ __('app.invoice')}}
                                </x-document-download>

                                @isset ($booking->receipt)
                                <x-document-download link="{{ route('bookings.receipt', $booking->id) }}">
                                    {{ __('app.reciept')}}
                                </x-document-download>
                                @endisset

                                @isset ($booking->refund)
                                <x-document-download link="{{ route('bookings.refund', $booking->id) }}">
                                    {{ __('app.refund')}}
                                </x-document-download>
                                @endisset
                            </div>
                        </dd>
                    </div>
                    @endif


                    @if($booking->type == 'business')
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            {{ __('Fees') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">

                            <div class="flex justify-between sm:justify-start space-x-4 ">
                                <div class="text-cool-gray-500 space-y-2">
                                    <p>{{ __('Fee') }}</p>
                                    <p>{{ __('app.dirty_surcharge') }}</p>
                                    <p>{{ __('Sub total') }}</p>
                                    <p>{{ __('Fleet discount') }}</p>
                                    <p class="font-semibold">{{ __('Discounted cost') }}</p>

                                </div>
                                <div class="text-right space-y-2">
                                    <p>{{ $booking->formatedBaseCost }}</p>
                                    <p>{{ $booking->formatedExtraCost }}</p>
                                    <p>{{ $booking->formatedTotalCost }}</p>
                                    <p>{{ $booking->fleet_discount }} %</p>
                                    <p class="font-semibold">{{ $booking->formatedDiscountedCost }}</p>
                                </div>
                            </div>

                        </dd>
                    </div>
                    @endif




                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            {{ __('app.cleaning_date') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            <x-jet-action-message  on="onSingleAppointmentDelete">
                                <span class="text-red-500 px-2 bg-red-50">
                                    {{ __('At least one appointment is required.') }}
                                </span>
                            </x-jet-action-message>
                            @if($booking->type == 'business' && Auth::user()->can('manage_bookings') && Str::contains($booking->status, ['pending', 'confirmed']))
                                @foreach($booking->appointments as $appointment)
                                <div class="py-4 border-b border-cool-gray-200">
                                    <livewire:bookingtimeslot.edit-booking-timeslot :appointment="$appointment" :key="$appointment->id">
                                </div>
                                @endforeach
                                <div class="pt-4">
                                    <x-button.link wire:click="addDayToBooking()">
                                        <span class="text-green-500 hover:text-green-700 hover:underline">{{ __('Add another day') }}</span>
                                    </x-button.link>
                                </div>
                            @else
                                @foreach($booking->appointments as $appointment)

                                {{ $appointment->dateForEditing  }} {{ $appointment->start_time}} (c.a. {{$booking->formatedDuration}} )

                                    <x-modals.booktime actionLink="{{ route('bookingtime.update', $appointment->id) }}"
                                                       :startDate="$appointment->dateForEditing"
                                                       :startTime="$appointment->start_time"
                                    >
                                        <x-div-button class="w-full sm:w-auto" buttonType="primary">
                                            {{ __('app.modify') }}
                                        </x-div-button>
                                    </x-modals.booktime>


                                @endforeach
                            @endif
                        </dd>
                    </div>



                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            {{ __('app.contact') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $booking->email }}, {{ $booking->phone }}
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            {{ __('app.billing_address') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            {!! $booking->completeBillingAddress !!}
                        </dd>
                    </div>
                    @can('manage_bookings')
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5 sm:border-t ">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            Timestamps
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            <p>Created {{ $booking->created_at }}</p>
                        </dd>
                    </div>
                    @endcan
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-b sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            {{ __('app.remarks') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            @if ($booking->notes)
                            {{ $booking->notes }}
                            @else
                            -
                            @endif
                        </dd>
                    </div>

                    @can('manage_bookings')
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-b sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            {{ __('app.remarks_internal') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            @isset ($booking->internal_notes)
                            <div class="mb-2">
                                {{ $booking->internal_notes }}
                            </div>
                            @endisset
                            <x-modals.comment actionLink="{{ route('comments.update', $booking->id) }}" :currentNote="$booking->internal_notes">
                                <x-div-button class="w-full sm:w-auto" buttonType="primary">
                                    {{ __('app.modify') }}
                                </x-div-button>
                            </x-modals.comment>
                        </dd>
                    </div>
                    @endcan
                </dl>
            </div>

            <div class="mt-4 bg-blue-50 border-l-4 border-blue-400 p-4 rounded-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="text-sm leading-5 text-blue-700 ml-3">
                        <p class="font-bold">{{ __('app.cancelation_policy') }}</p>
                        <p class="">
                            {{ __('app.cancelation_policy_p1') }}
                        </p>
                        <p class="">
                            {{ __('app.cancelation_policy_p2') }}
                        </p>
                        <p class="">
                            {{ __('app.cancelation_policy_p3') }}
                        </p>
                        <p class="">
                            {{ __('app.cancelation_policy_p4') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-4 sm:flex justify-between px-4 sm:px-0 space-y-5 sm:space-y-0">
                <a href="{{ route('bookings.index') }}">
                    <x-div-button class="w-full sm:w-auto" buttonType="secondary">
                        {{ __('app.back_overview') }}
                    </x-div-button>
                </a>


                @cannot('manage_bookings')
                @if(($booking->status == 'paid' || $booking->status == 'pending') && $booking->type === 'private' )
                <x-confirms-cancelation actionLink="{{ route('bookings.cancel', $booking->id) }}">
                    <x-div-button class="w-full sm:w-auto" buttonType="destructive">
                        {{ __('app.cancel_booking') }}
                    </x-div-button>
                </x-confirms-cancelation>
                @endif
                @endcannot

                <!-- WIPER SECTION -->
                @can('manage_bookings')
                @if($booking->status == 'paid' || $booking->status == 'confirmed')
                @if($booking->type === 'private')
                <x-modals.confirms-wiper-cancelation amount="{{ $booking->brutto_total_amount }}" amountToRefund="{{$booking->refundableAmount}}" actionLink="/bookings/{{ $booking->id }}/cancel">
                    <x-div-button class="w-full sm:w-auto" buttonType="destructive">
                        {{ __('app.cancel_booking') }}
                    </x-div-button>
                </x-modals.confirms-wiper-cancelation>
                @endif
                <x-confirms-completion actionLink="/bookings/{{ $booking->id }}/complete">
                    <x-div-button class="w-full sm:w-auto" buttonType="primary">
                        {{ __('app.mark_done') }}
                    </x-div-button>
                </x-confirms-completion>
                @endif
                @endcan
                <!-- EOF WIPER SECTION -->

                @if($booking->status == 'confirmed' && $booking->type === 'business')
                <x-confirms-business-cancelation actionLink="/bookings/{{ $booking->id }}/cancel">
                    <x-div-button class="w-full sm:w-auto" buttonType="destructive">
                        {{ __('app.cancel_booking') }}
                    </x-div-button>
                </x-confirms-business-cancelation>
                @endif

                <!-- WHO AND WHEN CAN DELETE A BOOKING? -->
                @if($booking->status == 'draft' || ($booking->type =='business' && $booking->status == 'pending' && blank($booking->appointments))   )
                <x-form-button method="DELETE" class="w-full sm:w-auto" action="/bookings/{{ $booking->id }}" buttonType="destructive">
                    {{ __('app.delete') }}
                </x-form-button>
                @endif
            </div>
        </div>
    </div>


</div>
