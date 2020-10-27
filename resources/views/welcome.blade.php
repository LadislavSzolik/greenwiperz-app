<x-guest-layout>
    <div class="max-w-7xl mx-auto py-16 sm:px-6 lg:px-8">

        <x-guest-navigation/>

        <div class="pb-6 bg-white rounded">
            <div class="mt-8 max-w-screen-xl mx-auto py-6  px-4 sm:px-6 lg:px-8">

                <div class="text-center px-8 sm:px-0">
                    <div class="flex items-center justify-center">
                        <x-application-logo class="h-36 text-green-500"/>
                    </div>
                    <p class="text-2xl leading-10 text-green-600 font-semibold tracking-wide uppercase">
                        Greenwiperz</p>
                    <h3 class="mt-2 leading-8 tracking-tight text-gray-900 text-xl sm:text-2xl sm:leading-10">
                        The mobile carwash in Zürich
                    </h3>

                    <p class="text-lg sm:text-xl leading-7 text-gray-500 ">
                        We go an extra mile to keep your car shiny and our planet green.
                    </p>
                    <div class="mt-5 flex items-center justify-center sm:px-6 ">
                        <a href="{{ route('bookings.create') }}"
                           class="text-white px-4 py-2 bg-green-500 rounded-md ">Book
                            a car cleaning today</a>
                    </div>
                </div>

                <div class="mt-12">
                    <ul class="md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                        <li>
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div
                                        class="flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white">
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path
                                                d="M17.6569 16.6569C16.7202 17.5935 14.7616 19.5521 13.4138 20.8999C12.6327 21.681 11.3677 21.6814 10.5866 20.9003C9.26234 19.576 7.34159 17.6553 6.34315 16.6569C3.21895 13.5327 3.21895 8.46734 6.34315 5.34315C9.46734 2.21895 14.5327 2.21895 17.6569 5.34315C20.781 8.46734 20.781 13.5327 17.6569 16.6569Z"
                                                stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                            <path
                                                d="M15 11C15 12.6569 13.6569 14 12 14C10.3431 14 9 12.6569 9 11C9 9.34315 10.3431 8 12 8C13.6569 8 15 9.34315 15 11Z"
                                                stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg leading-6 font-medium text-gray-900">Get your car washed
                                        anywhere, anytime</h4>
                                    <p class="mt-2 text-base leading-6 text-gray-500">
                                        Parking garage or front of your aparment, during business-lunch or meeting,
                                        it is not a problem for us.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="mt-10 md:mt-0">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div
                                        class="flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white">
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path
                                                d="M4.31802 6.31802C2.56066 8.07538 2.56066 10.9246 4.31802 12.682L12.0001 20.364L19.682 12.682C21.4393 10.9246 21.4393 8.07538 19.682 6.31802C17.9246 4.56066 15.0754 4.56066 13.318 6.31802L12.0001 7.63609L10.682 6.31802C8.92462 4.56066 6.07538 4.56066 4.31802 6.31802Z"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg leading-6 font-medium text-gray-900">Save 100l water and be
                                        part of the waterless carwash movement</h4>
                                    <p class="mt-2 text-base leading-6 text-gray-500">
                                        We ride on e-Bikes to get to your car and use only 2-5 dl water per
                                        cleaning.
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="mt-10 md:mt-0">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div
                                        class="flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white">
                                        <!-- Heroicon name: lightning-bolt -->
                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path
                                                d="M3 10H21M7 15H8M12 15H13M6 19H18C19.6569 19 21 17.6569 21 16V8C21 6.34315 19.6569 5 18 5H6C4.34315 5 3 6.34315 3 8V16C3 17.6569 4.34315 19 6 19Z"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg leading-6 font-medium text-gray-900">Pay contactless,
                                        online</h4>
                                    <p class="mt-2 text-base leading-6 text-gray-500">
                                        You can easily book a cleaning and pay using our website.
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <x-footer />

</x-guest-layout>
