<x-guest-layout>
    <div class="max-w-7xl mx-auto py-16 sm:px-6 lg:px-8">

        <x-guest-navigation />

        <div class="sm:pb-6 bg-white rounded">
            <div class="my-8 max-w-screen-xl mx-auto py-6 px-4 sm:px-16 lg:px-20">

                <h3 class="font-black text-2xl text-gray-800 leading-tight my-4">{{ __('Our service area') }}</h3>

                <div class="text-gray-600 leading-7"> 
                    <p class="">Our service area is the city of Zürich in the highlighet area.</p>
                    <p class="">We cover the following postal codes: 
                        <span class="text-green-800 font-bold">8001, 8002, 8003, 8004, 8005, 8006</span>
                    </p>
                    <p class="">Living outside, but on the edge of our service area? Give us a call and we see what we can do.</p>
                </div>
            
                <div class="mt-6">
                    <img class="shadow rounded-lg"  src="{{ asset('img/service-area.png') }}" alt="Service area" />
                </div>
            </div>
        </div>
    </div>

    <x-footer />
</x-guest-layout>
