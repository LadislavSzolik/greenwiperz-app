<x-guest-layout>
    <x-guest-navigation />
    <div class="max-w-7xl mx-auto pt-20  ">
        <div class="bg-white rounded-lg shadow-sm px-4 py-6 sm:px-16 sm:py-12">
            <div class="flex flex-wrap sm:flex-no-wrap">
                <div class="text-center sm:text-left w-full sm:w-2/5 px-4 sm:px-0">
                    <div class="flex items-center justify-center sm:justify-start">
                        <x-application-logo class="h-20 text-green-500" />
                    </div>
                    <p class="text-2xl leading-10 text-green-600 font-semibold tracking-wide uppercase">
                        Greenwiperz</p>
                    <h3 class="mt-1 leading-8 text-gray-800 font-bold text-xl sm:text-2xl sm:leading-10">
                        {{ __('homepage.sloganShort') }}
                    </h3>

                    <p class="text-lg sm:text-xl leading-7 text-gray-500 ">
                        {{ __('homepage.sloganLong') }}
                    </p>
                    <div class="mt-5 sm:flex">
                        <a href="{{ route('bookings.create') }}"
                            class="text-white px-4 py-2 bg-green-500 rounded-md ">{{ __('buttons.bookACleaningCTA') }}</a>
                    </div>
                </div>

                <div class="flex justify-center w-full sm:w-3/5 px-2 sm:px-0 mt-6">
                    <img class="shadow-2xl sm:w-96 object-cover" src="{{ asset('img/hero-image.png') }}"
                        alt="Hero image" />
                </div>
            </div>

            <!-- KEY FEATURES -->
            <div class="mt-16">
                <ul class="md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
                    <li>
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div
                                    class="flex items-center justify-center h-12 w-12 rounded-md bg-green-300 text-white">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path
                                            d="M17.6569 16.6569C16.7202 17.5935 14.7616 19.5521 13.4138 20.8999C12.6327 21.681 11.3677 21.6814 10.5866 20.9003C9.26234 19.576 7.34159 17.6553 6.34315 16.6569C3.21895 13.5327 3.21895 8.46734 6.34315 5.34315C9.46734 2.21895 14.5327 2.21895 17.6569 5.34315C20.781 8.46734 20.781 13.5327 17.6569 16.6569Z"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M15 11C15 12.6569 13.6569 14 12 14C10.3431 14 9 12.6569 9 11C9 9.34315 10.3431 8 12 8C13.6569 8 15 9.34315 15 11Z"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
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
                                <div
                                    class="flex items-center justify-center h-12 w-12 rounded-md bg-green-300 text-white">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path
                                            d="M4.31802 6.31802C2.56066 8.07538 2.56066 10.9246 4.31802 12.682L12.0001 20.364L19.682 12.682C21.4393 10.9246 21.4393 8.07538 19.682 6.31802C17.9246 4.56066 15.0754 4.56066 13.318 6.31802L12.0001 7.63609L10.682 6.31802C8.92462 4.56066 6.07538 4.56066 4.31802 6.31802Z"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
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
                                <div
                                    class="flex items-center justify-center h-12 w-12 rounded-md bg-green-300 text-white">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path
                                            d="M3 10H21M7 15H8M12 15H13M6 19H18C19.6569 19 21 17.6569 21 16V8C21 6.34315 19.6569 5 18 5H6C4.34315 5 3 6.34315 3 8V16C3 17.6569 4.34315 19 6 19Z"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
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

            <!-- BENEFITS -->
            <div class="my-16">
                <h2 class="text-xl leading-9 tracking-tight font-bold text-gray-900 sm:text-2xl sm:leading-10 mb-4 uppercase  text-center">
                    {{ __('homepage.benefitMainTitle') }}
                </h2>

                <dl class="rounded-lg bg-white shadow-lg sm:grid sm:grid-cols-3">
                    <div class="flex flex-col border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                        <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500" id="item-1">
                            {{ __('homepage.benefit1Description') }}
                        </dt>
                        <dd class="order-1 text-2xl leading-none font-extrabold text-green-600"
                            aria-describedby="item-1">
                            {{ __('homepage.benefit1Title') }}
                        </dd>
                    </div>
                    <div
                        class="flex flex-col border-t border-b border-gray-100 p-6 text-center sm:border-0 sm:border-l sm:border-r">
                        <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                            {{ __('homepage.benefit2Description') }}
                        </dt>
                        <dd class="order-1 text-2xl leading-none font-extrabold text-green-600">
                            {{ __('homepage.benefit2Title') }}
                        </dd>
                    </div>
                    <div class="flex flex-col border-t border-gray-100 p-6 text-center sm:border-0 sm:border-l">
                        <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                            {{ __('homepage.benefit3Description') }}
                        </dt>
                        <dd class="order-1 text-2xl leading-none font-extrabold text-green-600">
                            {{ __('homepage.benefit3Title') }} 
                        </dd>
                    </div>
                </dl>
            </div>

            <!-- HOW IT WORKS -->
            <div class="my-16 ">
                <h2 class="text-xl leading-9 tracking-tight font-bold text-gray-900 sm:text-2xl sm:leading-10 mb-4 uppercase text-center">
                    {{ __('homepage.howWorksMainTitle') }} 
                </h2>

                <div class="prose prose-lg text-gray-500 mx-auto">                
                    <ul>
                      <li>{{ __('homepage.howWorksParagrph1') }} </li>
                      <li>{{ __('homepage.howWorksParagrph2') }} </li>
                      <li>{{ __('homepage.howWorksParagrph3') }} </li>
                      <li>{{ __('homepage.howWorksParagrph4') }} </li>
                      <li>{{ __('homepage.howWorksParagrph5') }} </li>
                      <li>{{ __('homepage.howWorksParagrph6') }} </li>
                    </ul>                    
                  </div>
                
            </div>

            <x-jet-section-border />

            <!-- HOW NANOTECH WOKRS -->
            <div class="my-16 ">
                <h2 class="text-xl leading-9 tracking-normal font-bold text-gray-900 sm:text-2xl sm:leading-10 mb-4 uppercase text-center">
                    {{ __('homepage.howNanotechMainTitle') }} 
                </h2>

                <div class="prose prose-lg text-gray-500 mx-auto">                
                    <ul>
                        <li>{{ __('homepage.howNanotechParagrph1') }} </li>
                        <li>{{ __('homepage.howNanotechParagrph2') }} </li>
                        <li>{{ __('homepage.howNanotechParagrph3') }} </li>
                        <li>{{ __('homepage.howNanotechParagrph4') }} </li>
                        <li>{{ __('homepage.howNanotechParagrph5') }} </li>                     
                    </ul>                    
                  </div>                
            </div>


            <!-- EXCLUDED -->
            <div class="my-16 ">
                <h2 class="text-xl leading-9 tracking-normal font-bold text-gray-900 sm:text-2xl sm:leading-10 mb-4 uppercase text-center">
                    {{ __('homepage.exclConditionMainTitle') }}
                </h2>

                <div class="prose prose-lg text-gray-500 mx-auto">                
                    <ul>
                        <li>{{ __('homepage.exclConditionParagrph1') }}</li>
                    </ul>
                  </div>                
            </div>

        </div>
    </div>
    <x-footer />

</x-guest-layout>
