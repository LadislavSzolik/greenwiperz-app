<x-guest-layout>
    <x-guest-navigation />
    <main class="relative pt-16">
        <section class="bg-white py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 mb-8">
                <div class="mb-6">
                    <h3 class="text-4xl tracking-tight leading-10 font-extrabold text-gray-800 sm:text-5xl sm:leading-none">
                        {{ __('homepage.serviceAreaTitle') }}
                    </h3>
                </div>

                <div class="text-gray-600 leading-7 ">
                    <p class="">{{ __('homepage.serviceAreaText1') }}</p>
                    <p class="">{{ __('homepage.serviceAreaText2') }}
                        <span class="text-green-800 font-bold">8001, 8002, 8003, 8004, 8005, 8006</span>
                    </p>
                    <p class="">{{ __('homepage.serviceAreaText3') }}</p>
                </div>

                <div class="mt-6">
                    <img class="shadow rounded-lg" src="{{ asset('img/service-area.png') }}" alt="Service area" />
                </div>

            </div>
        </section>
    </main>
    <x-footer />
</x-guest-layout>
