<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('app.booking_details') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto pt-5 sm:py-5 sm:px-6 lg:px-8">
        <div class=" bg-white rounded-md sm:py-6 sm:px-20 ">

            @if(session()->has('message'))
            <div class="py-4 sm:px-6 px-4 w-full sm:max-w-7xl mx-auto ">
                <x-flash.universal x-data="{open: true}" :color="session('message')['color']" x-show.transition.out="open">
                    <x-slot name="title">
                        {{ session('message')['title'] }}
                    </x-slot>

                    <x-slot name="description">
                        {{ session('message')['description'] }}

                    </x-slot>

                    <x-slot name="actions">
                        <button x-on:click="open=false" class="ml-3 px-2 py-1.5 rounded-md text-sm leading-5 font-medium hover:bg-{{session('message')['color']}}-100 focus:outline-none focus:bg-{{session('message')['color']}}-100 transition ease-in-out duration-150">
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
                        {{ __('app.booking_number') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $booking->booking_nr }}
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
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 sm:py-5 sm:border-t ">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            {{ __('app.status') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            <x-booking-status :status="$booking->status" />
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                            {{ __('app.total_cost') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">


                            <div class="sm:inline-flex items-center sm:space-x-2 space-y-2 sm:space-y-0">
                                <p>{{ $booking->formatedTotalCost }}</p>
                                <x-document-download link="/bookings/{{ $booking->id }}/invoice">
                                    {{ __('app.invoice')}}
                                </x-document-download>

                                @isset ($booking->receipt)
                                <x-document-download link="/bookings/{{ $booking->id }}/receipt">
                                {{ __('app.reciept')}}
                                </x-document-download>
                                @endisset

                                @isset ($booking->refund)
                                <x-document-download link="/bookings/{{ $booking->id }}/refund">
                                {{ __('app.refund')}}
                                </x-document-download>
                                @endisset
                            </div>
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                        {{ __('app.dirty_surcharge')}}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            @if($booking->has_extra_dirt == 1)
                            <p> &#10003; {{ __('app.extra_dirt')}} </p>
                            @else
                            <p> &#x2715; {{ __('app.extra_dirt')}}</p>
                            @endif
                            @if($booking->has_animal_hair == 1)
                            <p> &#10003; {{ __('app.animal_hair')}} </p>
                            @else
                            <p> &#x2715; {{ __('app.animal_hair')}} </p>
                            @endif
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                        {{ __('app.car_location')}}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            {!! $booking->parkingLocationAddress !!}
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                        {{ __('app.car')}}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $booking->car->car_model }}, {{ $booking->car->number_plate }}
                            <br />
                            {{ $booking->car->car_color }}, <span class="capitalize">{{ $booking->car->car_size }}</span>
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                        {{ __('app.cleaning_date') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $booking->booking_datetime}} (c.a. {{$booking->formatedDuration}} )
                        </dd>
                    </div>
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t sm:border-gray-200 sm:px-6 sm:py-5">
                        <dt class="text-sm leading-5 font-medium text-gray-500">
                        {{ __('app.contact') }}
                        </dt>
                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $booking->customerMail }}, {{ $booking->phone }}
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
                            @if($booking->status == 'canceled')
                            <p>Canceled {{ $booking->appointment->canceled_at }}</p>
                            @endif
                            @if($booking->status == 'completed')
                            <p>Completed {{ $booking->appointment->completed_at }}</p>
                            @endif
                        </dd>
                    </div>
                    @endcan
                    <div class="mt-8 sm:mt-0 sm:grid sm:grid-cols-3 sm:gap-4 sm:border-t  sm:border-gray-200 sm:px-6 sm:py-5">
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
                            <x-modals.comment actionLink="/comments/{{ $booking->id }}" :currentNote="$booking->internal_notes">
                                <x-div-button class="w-full sm:w-auto" buttonType="secondary">
                                {{ __('app.modify') }}
                                </x-div-button>
                            </x-modals.comment>
                        </dd>
                    </div>
                    @endcan
                </dl>
            </div>

            <div class="mt-4 bg-blue-50 border-l-4 border-blue-400 p-4">
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

            <div class="mt-4 sm:flex  justify-between space-y-5 sm:space-y-0">
                <a href="/bookings/">
                    <x-div-button class="w-full sm:w-auto" buttonType="secondary">
                        {{ __('app.back_overview') }}
                    </x-div-button>
                </a>
                @cannot('manage_bookings')                
                @if($booking->status == 'paid')
                <x-confirms-cancelation actionLink="/bookings/{{ $booking->id }}/cancel">
                    <x-div-button class="w-full sm:w-auto" buttonType="destructive">
                    {{ __('app.cancel_booking') }}
                    </x-div-button>
                </x-confirms-cancelation>
                @endif
                @endcannot

                @can('manage_bookings')                               
                @if($booking->status == 'paid')        
                    <x-modals.confirms-wiper-cancelation 
                        amount="{{ $booking->brutto_total_amount }}"  
                        amountToRefund="{{$booking->refundableAmount}}" 
                        actionLink="/bookings/{{ $booking->id }}/cancel">
                        <x-div-button class="w-full sm:w-auto" buttonType="destructive">
                        {{ __('app.cancel_by_wiper') }}
                        </x-div-button>
                    </x-modals.confirms-wiper-cancelation>

                    <x-confirms-completion actionLink="/bookings/{{ $booking->id }}/complete">
                        <x-div-button class="w-full sm:w-auto" buttonType="primary" >
                        {{ __('app.mark_done') }}
                        </x-div-button>
                    </x-confirms-completion> 
                @endif
                @endcan

                @if($booking->status == 'draft' || $booking->status == 'pending')
                <x-form-button method="POST" action="/bookings/{{ $booking->id }}/destroy" buttonType="destructive">
                    {{ __('app.delete') }}
                </x-form-button>
                @endif
            </div>
        </div>
    </div>
    <x-footer />
</x-app-layout>