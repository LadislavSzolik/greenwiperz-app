<x-guest-layout>
    <x-guest-navigation />
    <main class="relative pt-16">

        <section class="bg-white py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-16 pb-10">

                <div class="mb-8">
                    <h2 class="text-4xl tracking-tight leading-10 font-extrabold text-gray-800 sm:text-5xl sm:leading-none text-center">
                        {{ __('pricespage.title') }}
                    </h2>
                </div>

                <div class="flex flex-col">
                    <div class="hidden sm:block -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class=" overflow-hidden border-b border-gray-200 ">
                                <table class="min-w-full divide-y divide-green-400">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs leading-4 font-medium text-green-700 uppercase tracking-wider">
                                                {{ __('pricespage.carcategories') }}
                                            </th>
                                            <th
                                                class="px-6 py-3 text-left text-xs leading-4 font-medium text-green-700 uppercase tracking-wider">
                                                {{ __('pricespage.exterior') }}
                                            </th>
                                            <th
                                                class="px-6 py-3 text-left text-xs leading-4 font-medium text-green-700 uppercase tracking-wider">
                                                {{ __('pricespage.intexterior') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <x-prices.row size='S' exteriorPrice='CHF 60.00' exteriorDuration='40 min*'
                                            intextPrice='CHF 110.00' intextDuration='80 min*'>
                                            <x-slot name="carType">
                                                {{ __('pricespage.carcategory1type') }}
                                            </x-slot>
                                            <x-slot name="carExamples">
                                                {{ __('pricespage.carcategory1examples') }}
                                            </x-slot>
                                        </x-prices.row>

                                        <x-prices.row size='M' exteriorPrice='CHF 70.00' exteriorDuration='45 min*'
                                            intextPrice='CHF 130.00' intextDuration='90 min*'>
                                            <x-slot name="carType">
                                                {{ __('pricespage.carcategory2type') }}
                                            </x-slot>
                                            <x-slot name="carExamples">
                                                {{ __('pricespage.carcategory2examples') }}
                                                <br />{{ __('pricespage.carcategory2desc') }}
                                                </p>
                                            </x-slot>
                                        </x-prices.row>

                                        <x-prices.row size='L' exteriorPrice='CHF 80.00' exteriorDuration='50 min*'
                                            intextPrice='CHF 150.00' intextDuration='100 min*'>
                                            <x-slot name="carType">
                                                {{ __('pricespage.carcategory3type') }}
                                            </x-slot>
                                            <x-slot name="carExamples">
                                                {{ __('pricespage.carcategory3examples') }}
                                            </x-slot>
                                        </x-prices.row>

                                        <x-prices.row size='XL' exteriorPrice='CHF 90.00' exteriorDuration='70 min*'
                                            intextPrice='CHF 165.00' intextDuration='120 min*'>
                                            <x-slot name="carType">
                                                {{ __('pricespage.carcategory4type') }}
                                            </x-slot>
                                            <x-slot name="carExamples">
                                                {{ __('pricespage.carcategory4examples') }}
                                            </x-slot>
                                        </x-prices.row>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <ul class=" grid sm:hidden grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <x-prices.card size='S' colorSelected="0" exteriorPrice='CHF 60.00' exteriorDuration='40 min*'
                            intextPrice='CHF 110.00' intextDuration='80 min*'>
                            <x-slot name="carType">
                                {{ __('pricespage.carcategory1type') }}
                            </x-slot>
                            <x-slot name="carExamples">
                                {{ __('pricespage.carcategory1examples') }}
                            </x-slot>
                        </x-prices.card>

                        <x-prices.card size='M' colorSelected="1" exteriorPrice='CHF 70.00' exteriorDuration='45 min*'
                            intextPrice='CHF 130.00' intextDuration='90 min*'>
                            <x-slot name="carType">
                                {{ __('pricespage.carcategory2type') }}
                            </x-slot>
                            <x-slot name="carExamples">
                                {{ __('pricespage.carcategory2examples') }} {{ __('pricespage.carcategory2desc') }}
                            </x-slot>
                        </x-prices.card>

                        <x-prices.card size='L' colorSelected="2" exteriorPrice='CHF 80.00' exteriorDuration='50 min*'
                            intextPrice='CHF 150.00' intextDuration='100 min*'>
                            <x-slot name="carType">
                                {{ __('pricespage.carcategory3type') }}
                            </x-slot>
                            <x-slot name="carExamples">
                                {{ __('pricespage.carcategory3examples') }}
                            </x-slot>
                        </x-prices.card>

                        <x-prices.card size='XL' colorSelected="3" exteriorPrice='CHF 90.00' exteriorDuration='70 min*'
                            intextPrice='CHF 165.00' intextDuration='120 min*'>
                            <x-slot name="carType">
                                {{ __('pricespage.carcategory4type') }}
                            </x-slot>
                            <x-slot name="carExamples">
                                {{ __('pricespage.carcategory4examples') }}
                            </x-slot>
                        </x-prices.card>
                    </ul>


                    <div class="mt-4 sm:mt-2 text-xs text-gray-600 text-center sm:text-left">
                        {{ __('pricespage.duractionDesc') }}
                    </div>

                    <div class="mt-10 bg-gray-50 border-l-4 border-blue-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="text-sm leading-5 text-blue-700 ml-3">
                                <p class="font-bold">{{ __('pricespage.dirtySurcharge') }}</p>
                                <p class="">
                                    {{ __('pricespage.dirtySurchargeDesc') }}
                                </p>
                            </div>
                        </div>
                    </div>


                    <!-- TODO: use the global button instead of a -->

                    @if (config('greenwiperz.registration_enabled'))
                        <div class="mt-5 flex items-center justify-end sm:px-6 ">
                            <a href="{{ route('bookings.private.create') }}"
                                class="text-white px-4 py-2 bg-green-500 rounded-md ">{{ __('action-buttons.bookACleaningCTA') }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
    <x-footer />
</x-guest-layout>
