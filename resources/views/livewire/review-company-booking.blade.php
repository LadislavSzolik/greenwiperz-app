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

                    <div class="col-span-6 ">
                        <label class='block font-medium text-sm text-gray-700 mb-2'>
                            {{ __('Location') }}
                        </label>
                        {!! $booking->parkingLocationAddress !!}
                    </div>

                    <div class="col-span-6 mt-2">
                        <!-- SMALL -->
                        @if($smallCars->outside > 0 || $smallCars->inoutside > 0)
                        <div class="grid grid-cols-6 gap-3">
                            <h3 class="col-span-6 text-1xl font-bold text-gray-900">{{ __('pricespage.carcategory1type') }} <span class="font-normal">{{ __('pricespage.carcategory1examples') }}</span></h3>

                            <div class="col-span-6 border-cool-gray-200 border-b"></div>

                            <label class='col-span-4 block font-medium text-sm text-gray-700 '>
                                {{ __('app.in_outside')}} ({{ __('Piece') }})
                            </label>

                            <div class='col-span-2'>
                                {{ $smallCars->outside}}
                            </div>

                            <div class="col-span-6 border-cool-gray-200 border-b"></div>

                            <label class='col-span-4 block font-medium text-sm text-gray-700'>
                                {{ __('app.outside')}} ({{ __('Piece') }})
                            </label>

                            <div class='col-span-2'>
                                {{ $smallCars->inoutside}}
                            </div>
                            <div class="col-span-6 border-cool-gray-200 border-b"></div>
                        </div>
                        @endif

                        <!-- MEDIUM -->
                        @if($mediumCars->outside > 0 || $mediumCars->inoutside > 0)
                        <div class="grid grid-cols-6 gap-3">
                            <h3 class="col-span-6 text-1xl font-bold text-gray-900 mt-6">{{ __('pricespage.carcategory2type') }} <span class="font-normal">{{ __('pricespage.carcategory2examples') }}</span></h3>

                            <div class="col-span-6 border-cool-gray-200 border-b"></div>

                            <label class='col-span-4 block font-medium text-sm text-gray-700 '>
                                {{ __('app.in_outside')}} ({{ __('Piece') }})
                            </label>

                            <div class='col-span-2'>
                                {{ $mediumCars->outside}}
                            </div>

                            <div class="col-span-6 border-cool-gray-200 border-b"></div>

                            <label class='col-span-4 block font-medium text-sm text-gray-700'>
                                {{ __('app.outside')}} ({{ __('Piece') }})
                            </label>

                            <div class='col-span-2'>
                                {{ $mediumCars->inoutside}}
                            </div>
                            <div class="col-span-6 border-cool-gray-200 border-b"></div>
                        </div>
                        @endif

                        @if($largeCars->outside > 0 || $largeCars->inoutside >0 )
                        <!-- LARGE -->
                        <div class="grid grid-cols-6 gap-3">
                            <h3 class="col-span-6 text-1xl font-bold text-gray-900 mt-6">{{ __('pricespage.carcategory3type') }} <span class="font-normal">{{ __('pricespage.carcategory3examples') }}</span></h3>

                            <div class="col-span-6 border-cool-gray-200 border-b"></div>

                            <label class='col-span-4 block font-medium text-sm text-gray-700 '>
                                {{ __('app.in_outside')}} ({{ __('Piece') }})
                            </label>

                            <div class='col-span-2'>
                                {{ $largeCars->outside}}
                            </div>

                            <div class="col-span-6 border-cool-gray-200 border-b"></div>

                            <label class='col-span-4 block font-medium text-sm text-gray-700'>
                                {{ __('app.outside')}} ({{ __('Piece') }})
                            </label>

                            <div class='col-span-2'>
                                {{ $largeCars->inoutside}}
                            </div>
                            <div class="col-span-6 border-cool-gray-200 border-b"></div>
                        </div>
                        @endif

                        @if($xlargeCars->outside > 0 || $xlargeCars->inoutside > 0 )
                        <!-- XLARGE -->
                        <div class="grid grid-cols-6 gap-3">
                            <h3 class="col-span-6 text-1xl font-bold text-gray-900 mt-6">{{ __('pricespage.carcategory4type') }} <span class="font-normal">{{ __('pricespage.carcategory4examples') }}</span></h3>

                            <div class="col-span-6 border-cool-gray-200 border-b"></div>

                            <label class='col-span-4 block font-medium text-sm text-gray-700 '>
                                {{ __('app.in_outside')}} ({{ __('Piece') }})
                            </label>

                            <div class='col-span-2'>
                                {{ $xlargeCars->outside}}
                            </div>

                            <div class="col-span-6 border-cool-gray-200 border-b"></div>

                            <label class='col-span-4 block font-medium text-sm text-gray-700'>
                                {{ __('app.outside')}} ({{ __('Piece') }})
                            </label>

                            <div class='col-span-2'>
                                {{ $xlargeCars->inoutside}}
                            </div>
                            <div class="col-span-6 border-cool-gray-200 border-b"></div>
                        </div>
                        @endif
                        
                        <!-- DIRTY_SURCHARGE -->
                        <div class="grid grid-cols-6 gap-3">
                            <h3 class="col-span-6 text-1xl font-bold text-gray-900 mt-6">{{ __('app.dirty_surcharge') }} </h3>

                            <div class="col-span-6 border-cool-gray-200 border-b"></div>

                            <label class='col-span-4 block font-medium text-sm text-gray-700 '>
                                {{ __('app.extra_dirt')}} ({{ __('Piece') }})
                            </label>

                            <div class='col-span-2'>
                                {{ $booking->extra_dirt}}
                            </div>

                            <div class="col-span-6 border-cool-gray-200 border-b"></div>

                            <label class='col-span-4 block font-medium text-sm text-gray-700'>
                                {{ __('app.animal_hair')}} ({{ __('Piece') }})
                            </label>

                            <div class='col-span-2'>
                                {{ $booking->animal_hair}}
                            </div>
                            <div class="col-span-6 border-cool-gray-200 border-b"></div>
                        </div>                    

                    </div>


                    <div class="col-span-6 sm:col-span-3">
                        <label class='block font-medium text-sm text-gray-700 mb-2'>
                            {{ __('app.email') }}
                        </label>
                        @isset($booking->email)
                        {{ $booking->email }}
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label class='block font-medium text-sm text-gray-700 mb-2'>
                            {{ __('app.phone') }}
                        </label>
                        @isset($booking->phone)
                        {{ $booking->phone }}
                        @else
                        <span class="text-gray-400">-</span>
                        @endif
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label class='block font-medium text-sm text-gray-700 mb-2'>
                            {{ __('app.date_time') }}
                        </label>
                        {{ $booking->date}}
                    </div>


                    <div class="col-span-6">
                        <label class='block font-medium text-sm text-gray-700 mb-2'>
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
                                <label class="block font-medium text-sm text-gray-700">
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

                <!-- DESKTOP & MOBILE -->
                <div class="col-span-6 sm:col-span-2">
                    <div class="shadow px-4 py-5 bg-white rounded-md sticky top-0">
                        <div class="text-xl mb-4 font-extrabold">{{ __('app.summary') }} </div>

                        <div class="flex justify-between border-t border-b border-cool-gray-200 py-2">
                            <div>
                                <div>{{ __('Fee') }}</div>
                                <div>{{ __('app.dirty_surcharge') }}</div>
                            </div>
                            <div>
                                <div class="text-gray-500 text-right"> {{ $booking->formatedBaseCost }} </div>
                                <div class="text-gray-500 text-right">{{ $booking->formatedExtraCost }} </div>
                            </div>
                        </div>
                        <div class="flex justify-between border-b border-cool-gray-200 py-2">
                            <div>
                                <div class="font-semibold">{{ __('Sub total') }}</div>
                            </div>
                            <div>
                                <div class="font-semibold text-right"> {{ $booking->formatedTotalCost }} </div>
                            </div>
                        </div>

                        <div class="flex justify-between border-b border-cool-gray-200 py-2">
                            <div>
                                <div>{{ __('Fleet discount') }}</div>
                                <div class="font-semibold">{{ __('Discounted cost') }}</div>
                            </div>
                            <div>
                                <div class="text-right">{{ $booking->fleet_discount }} %</div>
                                <div class="font-semibold"> {{ $booking->formatedDiscountedCost }}</div>
                            </div>
                        </div>


                        <div class="flex justify-between py-2">
                            <div>{{ __('app.duration') }}</div>
                            <div> {{ $booking->formatedDuration }}</div>
                        </div>

                        <div class="flex items-center justify-between pt-4 ">
                            <x-div-button wire:click="destroy" buttonType="tertiary">
                                {{ __('Cancel') }}
                            </x-div-button>
                            <x-button wire:loading.attr="disabled" buttonType="primary" type="submit">
                                {{ __('Submit') }}
                            </x-button>
                        </div>
                    </div>
                </div>
                <!-- EOF PRICE WIDGET -->
            </div>
        </div>
    </form>
</div>