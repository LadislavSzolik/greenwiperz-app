<x-guest-layout>
    <div class="max-w-7xl mx-auto py-16 sm:px-6 lg:px-8">

        <x-guest-navigation />

        <div class="sm:pb-6 bg-white rounded">
            <div class="mt-8 max-w-screen-xl mx-auto py-6  px-4 sm:px-16 lg:px-20">

                <h3 class="font-black text-2xl text-gray-800 leading-tight m-4">{{ __('Our prices') }}</h3>

                <div class="flex flex-col">
                    <div class="hidden sm:block -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class=" overflow-hidden border-b border-gray-200 ">
                                <table class="min-w-full divide-y divide-green-400">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs leading-4 font-medium text-green-700 uppercase tracking-wider">
                                                Car categories
                                            </th>
                                            <th
                                                class="px-6 py-3 text-left text-xs leading-4 font-medium text-green-700 uppercase tracking-wider">
                                                Exterior only
                                            </th>
                                            <th
                                                class="px-6 py-3 text-left text-xs leading-4 font-medium text-green-700 uppercase tracking-wider">
                                                Interior & Exterior
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <x-prices.row size='S' exteriorPrice='CHF 60.00' exteriorDuration='40 min*' intextPrice='CHF 110.00' intextDuration='80 min*'>
                                            <x-slot name="carType" >
                                                Small cars
                                            </x-slot>
                                            <x-slot name="carExamples" >
                                                e.g. Smart, Mini, Fiat500
                                            </x-slot>
                                        </x-prices.row>
                
                                        <x-prices.row size='M'  exteriorPrice='CHF 70.00' exteriorDuration='45 min*' intextPrice='CHF 130.00' intextDuration='90 min*'>
                                            <x-slot name="carType" >
                                                Medium cars
                                            </x-slot>
                                            <x-slot name="carExamples" >
                                                e.g. VW Golf, VW Passat, Ford Focus (most cars belong to this category)
                                            </x-slot>
                                        </x-prices.row>                 
                
                                        <x-prices.row size='L'  exteriorPrice='CHF 80.00' exteriorDuration='50 min*' intextPrice='CHF 150.00' intextDuration='100 min*'>
                                            <x-slot name="carType" >
                                                Big cars
                                            </x-slot>
                                            <x-slot name="carExamples" >
                                                e.g. SUV
                                            </x-slot>
                                        </x-prices.row>
                
                                        <x-prices.row size='XL' exteriorPrice='CHF 90.00' exteriorDuration='70 min*' intextPrice='CHF 165.00' intextDuration='120 min*'>
                                            <x-slot name="carType" >
                                                Extra-large cars
                                            </x-slot>
                                            <x-slot name="carExamples" >
                                                e.g. transporter, minibus, minivan
                                            </x-slot>
                                        </x-prices.row>
                                    </tbody>
                                </table>

                            </div>                            
                        </div>
                    </div>

                    <ul class="grid sm:hidden grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <x-prices.card size='S' colorSelected="0" exteriorPrice='CHF 60.00' exteriorDuration='40 min*' intextPrice='CHF 110.00' intextDuration='80 min*'>
                            <x-slot name="carType" >
                                Small cars
                            </x-slot>
                            <x-slot name="carExamples" >
                                e.g. Smart, Mini, Fiat500
                            </x-slot>
                        </x-prices.card>

                        <x-prices.card size='M' colorSelected="1" exteriorPrice='CHF 70.00' exteriorDuration='45 min*' intextPrice='CHF 130.00' intextDuration='90 min*'>
                            <x-slot name="carType" >
                                Medium cars
                            </x-slot>
                            <x-slot name="carExamples" >
                                e.g. VW Golf, VW Passat, Ford Focus (most cars belong to this category)
                            </x-slot>
                        </x-prices.card>                 

                        <x-prices.card size='L' colorSelected="2" exteriorPrice='CHF 80.00' exteriorDuration='50 min*' intextPrice='CHF 150.00' intextDuration='100 min*'>
                            <x-slot name="carType" >
                                Big cars
                            </x-slot>
                            <x-slot name="carExamples" >
                                e.g. SUV
                            </x-slot>
                        </x-prices.card>

                        <x-prices.card size='XL' colorSelected="3" exteriorPrice='CHF 90.00' exteriorDuration='70 min*' intextPrice='CHF 165.00' intextDuration='120 min*'>
                            <x-slot name="carType" >
                                Extra-large cars
                            </x-slot>
                            <x-slot name="carExamples" >
                                e.g. transporter, minibus, minivan
                            </x-slot>
                        </x-prices.card>
                    </ul>


                    <div class="mt-2 text-xs text-gray-600">
                        *The durations above serve as an approximate estimation based on our experience.
                    </div>

                    <div class="mt-4 bg-blue-50 border-l-4 border-blue-400 p-4">
                        <div class="flex">
                          <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                              </svg>
                          </div>
                          <div class="text-sm leading-5 text-blue-700 ml-3">
                            <p class="font-bold">DIRRRTY surcharge</p>
                            <p class="">                                
                                If your car is especially dirty, eg. the exterior has a lot of bugs and/or the interior has a lot of dog hair or stains: 30 CHF. Please be honest about this when you order our service. 
                            </p>
                          </div>
                        </div>
                      </div>


                    <!-- TODO: use the global button instead of a -->
                    <div class="mt-5 flex items-center justify-end sm:px-6 ">
                        <a href="{{ route('bookings.create') }}"
                            class="text-white px-4 py-2 bg-green-500 rounded-md ">Book a car cleaning</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
    
</x-guest-layout>
