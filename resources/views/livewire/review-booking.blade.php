<div>
    <x-header>
        <x-slot name="title">{{ __('app.review_booking') }}</x-slot>
        <x-slot name="actions"></x-slot>
    </x-header>

    <form wire:submit.prevent="submit">
        @csrf
        <div class="max-w-7xl mx-auto pt-5 sm:py-5 sm:px-6 lg:px-8">
            <div class="grid grid-cols-6 gap-3">
                <div class="col-span-6 sm:col-span-4 grid grid-cols-6 gap-6 px-4 py-5 bg-white shadow rounded-md sm:p-10 sm:px-20">

                    @if (session()->has('message'))
                    <div class="col-span-6">
                        <x-flash.universal x-data="{open: true}" :color="session('message')['color']" x-show.transition.out="open">
                            <x-slot name="title">
                                {{ __(session('message')['title']) }}
                            </x-slot>

                            <x-slot name="description">
                                {{ __(session('message')['description']) }}
                            </x-slot>

                            <x-slot name="actions">
                                <div x-on:click="open=false" class="px-2 py-1.5 rounded-md text-sm leading-5 font-medium hover:bg-{{session('message')['color']}}-100 focus:outline-none focus:bg-{{session('message')['color']}}-100 transition ease-in-out duration-150 cour
                                ">
                                    {{ __('app.dismiss') }}
                                </div>
                            </x-slot>
                        </x-flash.universal>
                    </div>
                    @endif

                    <div class="col-span-6">
                        <label class='block font-medium text-sm text-gray-700'>
                            {{ __('app.car') }}
                        </label>
                        {{ $booking->car->car_model }}, {{ $booking->car->number_plate }}, {{ __($booking->car->car_color) }}, <span class="capitalize">{{ $booking->car->car_size }}</span>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label class='block font-medium text-sm text-gray-700'>
                            {{ __('app.cleaning') }}
                        </label>
                        @if ($booking->service_type == 'outside')
                        {{ __('app.outside') }}
                        @else
                        {{ __('app.in_outside') }}
                        @endif
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label class='block font-medium text-sm text-gray-700'>
                            {{ __('app.dirty_surcharge')}}
                        </label>
                        @if($booking->extra_dirt)
                        <p> &#10003; {{ __('app.extra_dirt')}} </p>
                        @else
                        <p> &#x2715; {{ __('app.extra_dirt')}} </p>
                        @endif
                        @if($booking->animal_hair)
                        <p> &#10003; {{ __('app.animal_hair')}} </p>
                        @else
                        <p> &#x2715; {{ __('app.animal_hair')}} </p>
                        @endif
                    </div>

                    <div class="col-span-6">
                        <label class='block font-medium text-sm text-gray-700'>
                            {{ __('app.car_location') }}
                        </label>
                        {!! $booking->parkingLocationAddress !!}
                    </div>
                    
                    <div class="col-span-6 sm:col-span-3">
                        <label class='block font-medium text-sm text-gray-700'>
                            {{ __('app.email') }}
                        </label>
                        @isset($booking->email)
                        {{ $booking->email }}
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label class='block font-medium text-sm text-gray-700'>
                            {{ __('app.phone') }}
                        </label>
                        @isset($booking->phone)
                        {{ $booking->phone }}
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label class='block font-medium text-sm text-gray-700'>
                            {{ __('app.date_time') }}
                        </label>
                        {{ $booking->date}} {{ $booking->time}} 
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label class='block font-medium text-sm text-gray-700'>
                            {{ __('app.duration') }}
                        </label>
                        {{ __('app.about')}} {{$booking->formatedDuration}} 
                    </div>

                    <div class="col-span-6">
                        <label class='block font-medium text-sm text-gray-700'>
                            {{ __('app.billing_address')}}
                        </label>
                        {!! $booking->completeBillingAddress !!}
                    </div>


                    <div class="col-span-6">
                        <label class='block font-bold'>
                            {{ __('app.lets_make_sure')}}
                        </label>


                        <div class="mt-2">
                            <div class="py-4 space-y-2">
                                <label class="block font-medium text-sm text-gray-700 ">
                                    {{ __('app.terms_1_title')}}
                                </label>
                                <label class="inline-flex items-start">
                                    <input type="checkbox" class="form-checkbox w-6 h-6 text-green-400 " name="terms_1" required>
                                    <span class="ml-2">{{ __('app.terms_1_sub_1')}}</span>
                                </label>

                                <label class="inline-flex items-start">
                                    <input type="checkbox" class="form-checkbox w-6 h-6 text-green-400 " name="terms_2" required>
                                    <span class="ml-2">{{ __('My car is NOT parked on public property')}}</span>
                                </label>


                                <label class="inline-flex items-start">
                                    <input type="checkbox" class="form-checkbox w-6 h-6 text-green-400 " name="terms_3" required>
                                    <span class="ml-2">{{ __('app.terms_1_sub_2')}}</span>
                                </label>
                                <label class="inline-flex items-start">
                                    <input type="checkbox" class="form-checkbox w-6 h-6 text-green-400 " name="terms_4" required>
                                    <span class="ml-2">{{ __('app.terms_1_sub_3')}}</span>
                                </label>
                                <label class="inline-flex items-start">
                                    <input type="checkbox" class="form-checkbox w-6 h-6 text-green-400 " name="terms_5" required>
                                    <span class="ml-2">{{ __('app.terms_1_sub_4')}}</span>
                                </label>
                                <label class="inline-flex items-start">
                                    <input type="checkbox" class="form-checkbox w-6 h-6 text-green-400 " name="terms_6" required>
                                    <span class="ml-2">{{ __('app.terms_1_sub_5')}}</span>
                                </label>
                            </div>


                            <div class="py-4 space-y-2">
                                <label class="block font-medium text-sm text-gray-700 mb-2">
                                    {{ __('app.terms_2_title')}}
                                </label>
                                <label class="inline-flex items-start">
                                    <input type="checkbox" class="form-checkbox w-6 h-6 text-green-400 " name="terms_7" required>
                                    <span class="ml-2">{{ __('app.terms_2_sub_1')}}</span>
                                </label>
                                <label class="inline-flex items-start">
                                    <input type="checkbox" class="form-checkbox w-6 h-6 text-green-400 " name="terms_8" required>
                                    <span class="ml-2">{{ __('app.terms_2_sub_2')}} </span>
                                </label>
                                <label class="inline-flex items-start">
                                    <input type="checkbox" class="form-checkbox w-6 h-6 text-green-400 " name="terms_9" required>
                                    <span class="ml-2">{{ __('app.terms_2_sub_3')}}</span>
                                </label>
                            </div>


                            <div class="py-4 space-y-2">
                                <label class="block font-medium text-sm text-gray-700 mb-2">
                                    @if ( App::isLocale('en'))
                                    I have also read, enjoyed and accepted the <a href="{{route('terms.inapp') }}" class="underline" target="_blank"> {{ __('app.terms_conditions')}}</a>
                                    @else
                                    Ich habe außerdem die <a href="{{route('terms.inapp') }}" class="underline" target="_blank"> {{ __('app.terms_conditions')}}</a> gelesen, genossen und sein Inhalt akzeptiert.
                                    @endif

                                </label>
                                <label class="inline-flex items-start">
                                    <input type="checkbox" class="form-checkbox w-6 h-6 text-green-400 " name="terms_10" required>
                                    <span class="ml-2">{{ __('app.terms_3_sub_1')}}</span>
                                </label>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- DESKTOP WIDGET -->
                <div class="hidden sm:block col-span-2">
                    <div class="shadow px-4 py-5 bg-white rounded-md sticky bottom-0">
                        <div class="text-xl mb-4 font-extrabold">{{ __('app.summary')}} </div>

                        <div class="flex justify-between border-b border-cool-gray-200 py-2">
                            <div>
                                <div>{{ __('app.total_cost')}}</div>
                                <div class="text-gray-500 ">{{ __('app.dirty_surcharge')}}</div>
                            </div>
                            <div class="text-right">
                                <div class="font-bold"> {{ $booking->formatedTotalCost }} </div>
                                <div class="text-gray-500 "> + {{ $booking->formatedExtraCost }} </div>
                            </div>
                        </div>

                        <div class="flex justify-between border-b border-cool-gray-200 py-2">
                            <div>{{ __('app.duration') }} </div>
                            <div class="font-bold"> {{ $booking->formatedDuration }}</div>
                        </div>

                        <div class="flex items-center justify-between pt-4 ">
                            <x-div-button wire:click="destroy" buttonType="tertiary">
                                {{ __('Cancel') }}
                            </x-div-button>
                            <x-button wire:loading.attr="disabled" buttonType="primary" type="submit">
                                {{ __('app.pay') }}
                            </x-button>
                        </div>
                    </div>
                </div>
                <!-- EOF DESKTOP WIDGET -->
                <!-- MOBILE WIDGET -->
                <div class="block col-span-6 sm:hidden w-full sticky bottom-0">
                    <div class="px-4 pt-2 pb-6 bg-cool-gray-100 ">
                        <div class="flex justify-between items-center">
                            <div class="text-base">{{ __('app.total_cost')}}/{{ __('app.duration') }} </div>
                            <div class="font-bold">{{ $booking->formatedTotalCost }}/ {{ $booking->formatedDuration }}</div>
                        </div>
                        <div class="my-2 flex justify-between items-center">
                            <x-div-button wire:click="destroy" buttonType="tertiary">
                                {{ __('Cancel') }}
                            </x-div-button>
                            <x-button wire:loading.attr="disabled" buttonType="primary" type="submit">
                                {{ __('app.pay') }}
                            </x-button>
                        </div>
                    </div>
                </div>
                <!-- EOF MOBILE WIDGET-->
            </div>
        </div>
    </form>
</div>