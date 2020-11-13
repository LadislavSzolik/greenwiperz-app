<x-guest-layout>

    <x-guest-navigation />
    <main class="relative pt-16">   
        
        <div class="bg-white py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">

                <h1 class="ext-4xl tracking-tight leading-10 font-extrabold text-gray-800 sm:text-5xl sm:leading-none">{{ __('homepage.contactInformation') }}</h1>

                <dl class="mt-8 text-base leading-6 text-gray-500">
                    <div>
                        <dt class="sr-only">{{ __('homepage.postalAddress') }}</dt>
                        <dd>
                            <p>{{ config('greenwiperz.company.name') }}</p>
                            <p>{{ config('greenwiperz.company.street') }} </p>
                            <p>{{ config('greenwiperz.company.postal_code') }} {{ config('greenwiperz.company.country') }}</p>                            
                        </dd>
                    </div>
                    <div class="mt-6">
                        <dt class="sr-only">{{ __('homepage.phoneNumber') }}</dt>
                        <dd class="flex"> 
                            <svg class="flex-shrink-0 h-6 w-6 text-gray-400"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span class="ml-3">
                                {{ config('greenwiperz.company.telefon') }}
                            </span>
                        </dd>
                    </div>
                    <div class="mt-3">
                        <dt class="sr-only">{{ __('homepage.email') }}  </dt>
                        <dd class="flex">                            
                            <svg class="flex-shrink-0 h-6 w-6 text-gray-400"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="ml-3">
                                {{ config('greenwiperz.company.email') }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

    </main>
    <x-footer />
</x-guest-layout>
