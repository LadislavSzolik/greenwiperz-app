<nav x-data="{ open: false }" class="fixed top-0 right-0 w-full bg-white shadow z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex justify-between md:space-x-6 h-16">

            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a class="inline-flex items-center" href="{{ route(current_lang() . '.' . 'home') }}">
                        <x-application-logo class="h-10 text-green-500 " />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-6 sm:-my-px sm:ml-6">
                    <x-jet-nav-link href="{{ route(current_lang() . '.' . 'home') }}" :active="request()->routeIs(current_lang() . '.' . 'home')">
                        {{ __('Home') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route(current_lang() . '.' . 'how.it.works') }}" :active="request()->routeIs('how.it.works')">
                        {{ __('action-buttons.how-it-works') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route(current_lang() . '.' . 'prices') }}" :active="request()->routeIs('prices')">
                        {{ __('action-buttons.prices') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route(current_lang() . '.' . 'service.area') }}" :active="request()->routeIs('service.area')">
                        {{ __('action-buttons.serviceArea') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route(current_lang() . '.' . 'terms') }}" :active="request()->routeIs('terms')">
                        {{ __('action-buttons.termsAndConditions') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route(current_lang() . '.' . 'about') }}" :active="request()->routeIs('about')">
                        {{ __('action-buttons.about') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route(current_lang() . '.' . 'contact') }}" :active="request()->routeIs('contact')">
                        {{ __('action-buttons.contact') }}
                    </x-jet-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex items-center">

                <x-app-language-switcher />

                @if(config('greenwiperz.registration_enabled'))
                    @auth
                        <a href="{{ route('bookings.index') }}" class="text-gray-700 underline">{{ __('My Bookings') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 underline">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-gray-700 underline">Register</a>
                        @endif
                    @endif
                @else
                    <a href="{{ route('waitingvisitors.create') }}" class="text-gray-700 underline">{{ __('action-buttons.notifyMe') }}</a>
                @endif

                </div>
                <!-- Hamburger -->
                <div class="-mr-2 flex items-center md:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

    <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="block md:hidden">

            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="mt-3 space-y-1">

                    <x-app-language-switcher />

                    @if(config('greenwiperz.registration_enabled'))
                        @auth
                            <x-jet-responsive-nav-link
                                href="{{ route('bookings.index') }}"
                                :active="request()->routeIs('bookings.index')">
                                    {{ __('My Bookings') }}
                            </x-jet-responsive-nav-link>
                        @else
                            <x-jet-responsive-nav-link
                                href="{{ route('login') }}"
                                :active="request()->routeIs('login')">
                                    {{ __('Login') }}
                            </x-jet-responsive-nav-link>
                            @if(Route::has('register'))
                                <x-jet-responsive-nav-link
                                    href="{{ route('register') }}"
                                    :active="request()->routeIs('register')">
                                        {{ __('Register') }}
                                </x-jet-responsive-nav-link>
                            @endif

                        @endif
                    @else
                    <x-jet-responsive-nav-link href="{{ route('waitingvisitors.create') }}">{{ __('action-buttons.notifyMe') }}</x-jet-responsive-nav-link>
                    @endif
                </div>
            </div>


            <!-- Mobile menu -->
            <div class="pt-2 pb-3 space-y-1">
                <div class="pt-2 pb-3 space-y-1">
                    <x-jet-responsive-nav-link href="{{ route(current_lang() . '.' . 'home') }}"
                        :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route(current_lang() . '.' . 'how.it.works') }}"
                        :active="request()->routeIs('how.it.works')">
                        {{ __('action-buttons.how-it-works') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route(current_lang() . '.' . 'prices') }}" :active="request()->routeIs('prices')">
                        {{ __('action-buttons.prices') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route(current_lang() . '.' . 'service.area') }}"
                        :active="request()->routeIs('service.area')">
                        {{ __('action-buttons.serviceArea') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route(current_lang() . '.' . 'terms') }}"
                        :active="request()->routeIs('terms')">
                        {{ __('action-buttons.termsAndConditions') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route(current_lang() . '.' . 'about') }}"
                        :active="request()->routeIs('about')">
                        {{ __('action-buttons.about') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route(current_lang() . '.' . 'contact') }}"
                        :active="request()->routeIs('contact')">
                        {{ __('action-buttons.contact') }}
                    </x-jet-responsive-nav-link>
                </div>
            </div>
        </div>
    </nav>
