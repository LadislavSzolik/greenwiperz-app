<x-guest-layout>
    <x-guest-navigation />
    <main class="relative pt-16">

        <!-- Hero section -->
        <section class="bg-white py-10">
            <div class="max-w-7xl mx-auto flex flex-wrap sm:flex-no-wrap px-4 sm:px-6">

                <div class="text-center sm:text-left w-full sm:w-2/5">
                    <div class="flex items-center justify-center sm:justify-start mb-4">
                        <x-application-logo class="h-20 text-green-500" />
                    </div>
                    <h1 class="text-4xl tracking-tight leading-10 font-extrabold text-green-500 sm:text-5xl sm:leading-none">
                        Greenwiperz
                        <br />
                        <span class="text-gray-900"> {{ __('homepage.sloganShort') }}
                    </h1>

                    <p class="mt-3 max-w-md mx-auto text-lg text-gray-500 sm:text-xl md:mt-5 md:max-w-3xl">
                        {{ __('homepage.sloganLong') }}
                    </p>

                    <div class="mt-5 sm:flex">
                        @if (config('greenwiperz.registration_enabled'))
                        <a href="{{ route('bookings.private.create') }}" class="flex items-center justify-center px-8 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition duration-150 ease-in-out md:py-4 md:text-lg md:px-10 ">
                            {{ __('action-buttons.bookACleaningCTA') }}
                        </a>
                        @else
                        <a href="{{ route('waitingvisitors.create') }}" class="flex items-center justify-center px-8 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition duration-150 ease-in-out md:py-4 md:text-lg md:px-10">
                            {{ __('action-buttons.notifyMe') }}
                        </a>
                        @endif
                    </div>
                </div>

                <div class="flex justify-center w-full sm:w-3/5 px-2 sm:px-0 mt-8">
                    <img class="shadow-2xl h-48 sm:h-80 rounded-lg" src="{{ asset('img/hero-image.png') }}" alt="Hero image" />
                </div>
            </div>
        </section>

       

        <!-- KEY FEATURES -->
        <section class="my-24">
            <div class="max-w-6xl mx-auto px-4 sm:px-6">
                <ul class="md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
                    <li>
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-300 text-white">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M17.6569 16.6569C16.7202 17.5935 14.7616 19.5521 13.4138 20.8999C12.6327 21.681 11.3677 21.6814 10.5866 20.9003C9.26234 19.576 7.34159 17.6553 6.34315 16.6569C3.21895 13.5327 3.21895 8.46734 6.34315 5.34315C9.46734 2.21895 14.5327 2.21895 17.6569 5.34315C20.781 8.46734 20.781 13.5327 17.6569 16.6569Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M15 11C15 12.6569 13.6569 14 12 14C10.3431 14 9 12.6569 9 11C9 9.34315 10.3431 8 12 8C13.6569 8 15 9.34315 15 11Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg leading-6 font-bold text-gray-900">
                                    {{ __('homepage.feature1Title') }}
                                </h4>
                                <p class="mt-2 text-base leading-6 text-gray-500">
                                    {{ __('homepage.feature1Description') }}
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="mt-10 md:mt-0">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-300 text-white">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M4.31802 6.31802C2.56066 8.07538 2.56066 10.9246 4.31802 12.682L12.0001 20.364L19.682 12.682C21.4393 10.9246 21.4393 8.07538 19.682 6.31802C17.9246 4.56066 15.0754 4.56066 13.318 6.31802L12.0001 7.63609L10.682 6.31802C8.92462 4.56066 6.07538 4.56066 4.31802 6.31802Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg leading-6 font-bold text-gray-900">
                                    {{ __('homepage.feature2Title') }}
                                </h4>
                                <p class="mt-2 text-base leading-6 text-gray-500">
                                    {{ __('homepage.feature2Description') }}
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="mt-10 md:mt-0">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-300 text-white">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path d="M3 10H21M7 15H8M12 15H13M6 19H18C19.6569 19 21 17.6569 21 16V8C21 6.34315 19.6569 5 18 5H6C4.34315 5 3 6.34315 3 8V16C3 17.6569 4.34315 19 6 19Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg leading-6 font-bold text-gray-900">
                                    {{ __('homepage.feature3Title') }}
                                </h4>
                                <p class="mt-2 text-base leading-6 text-gray-500">
                                    {{ __('homepage.feature3Description') }}
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </section>



        <!-- BENEFIT: SAVE WITH US -->
        <section class="my-24">
            <div class="max-w-6xl mx-auto px-4 sm:px-6">
                <div class="mb-8 max-w-2xl mx-auto text-center">
                    <h2 class="text-4xl tracking-tight leading-10 font-extrabold text-gray-800 sm:text-5xl sm:leading-none text-center">
                        {{ __('homepage.benefitMainTitle') }}
                    </h2>
                </div>

                <dl class="rounded bg-white shadow-md sm:grid sm:grid-cols-3">
                    <div class="flex flex-col border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                        <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500" id="item-1">
                            {{ __('homepage.benefit1Description') }}
                        </dt>
                        <dd class="order-1 text-2xl leading-none font-extrabold text-green-600" aria-describedby="item-1">
                            <img class="h-48 sm:h-80 mx-auto" src="{{ asset('img/save_water.png') }}" alt="Water saving" />
                            {{ __('homepage.benefit1Title') }}
                        </dd>
                    </div>
                    <div class="flex flex-col border-t border-b border-gray-100 p-6 text-center sm:border-0 sm:border-l sm:border-r">
                        <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                            {{ __('homepage.benefit2Description') }}
                        </dt>
                        <dd class="order-1 text-2xl leading-none font-extrabold text-green-600">

                            <img class="h-48 sm:h-80 mx-auto" src="{{ asset('img/one_hour_hustle.png') }}" alt="Hustling" />

                            {{ __('homepage.benefit2Title') }}
                        </dd>
                    </div>
                    <div class="flex flex-col border-t border-gray-100 p-6 text-center sm:border-0 sm:border-l">
                        <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                            {{ __('homepage.benefit3Description') }}
                        </dt>
                        <dd class="order-1 text-2xl leading-none font-extrabold text-green-600">
                            <img class="h-48 sm:h-80 mx-auto" src="{{ asset('img/shame.png') }}" alt="Feeling shamed" />
                            {{ __('homepage.benefit3Title') }}
                        </dd>
                    </div>
                </dl>
            </div>
        </section>

        

        @livewire('show-public-ratings')

         <!-- BEFORE/AFTER -->
         <section>
            @livewire('show-work')
        </section>

    </main>
    <x-footer />
</x-guest-layout>