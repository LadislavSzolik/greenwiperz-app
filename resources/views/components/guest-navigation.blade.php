<nav x-data="{ open: false }" class="fixed top-0 right-0 w-full bg-white border-b border-gray-100 z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a class="inline-flex items-center" href="{{ route('home') }}">
                        <x-application-logo class="h-10 text-green-500 " />
                        <span class="block sm:hidden ml-2 font-extrabold uppercase text-green-600">Greenwiperz</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-8 sm:-my-px sm:ml-10">
                    <x-jet-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('how.it.works') }}" :active="request()->routeIs('how.it.works')">
                        {{ __('How it works') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('prices') }}" :active="request()->routeIs('prices')">
                        {{ __('Prices') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('service.area') }}" :active="request()->routeIs('service.area')">
                        {{ __('Service area') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')">
                        {{ __('About us') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')">
                        {{ __('Contact') }}
                    </x-jet-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex items-center">
                 
                <div class="text-sm text-green-600 mr-6 space-x-2">
                    <a class=”” href="{{ route('language', ['locale' => 'en']) }}" id="de"> English</a> 
                    <a class=”” href="{{ route('language', ['locale' => 'de']) }}" id="de"> Deutsch</a> 
                </div>
                @auth
                    <a href="{{ route('bookings.index') }}" class="text-gray-700 underline">My Bookings</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 underline">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-gray-700 underline">Register</a>
                    @endif
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

                    <div class="text-sm text-green-700 ml-4 my-4 space-x-4 uppercase">
                        <a class="" href="{{ route('language', ['locale' => 'en']) }}" id="de"> English</a> 
                        <a class=”” href="{{ route('language', ['locale' => 'de']) }}" id="de"> Deutsch</a> 
                    </div>

                    <x-jet-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                        {{ __('Register') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-jet-responsive-nav-link>
                </div>
            </div>



            <div class="pt-2 pb-3 space-y-1">
                <div class="pt-2 pb-3 space-y-1">
                    <x-jet-responsive-nav-link href="{{ route('home') }}"
                        :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-jet-responsive-nav-link>
                    <x-jet-responsive-nav-link href="{{ route('how.it.works') }}"
                        :active="request()->routeIs('how.it.works')">
                        {{ __('How it works') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route('prices') }}" :active="request()->routeIs('prices')">
                        {{ __('Prices') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route('service.area') }}"
                        :active="request()->routeIs('service.area')">
                        {{ __('Service area') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route('about') }}"
                        :active="request()->routeIs('about')">
                        {{ __('About us') }}
                    </x-jet-responsive-nav-link>

                    <x-jet-responsive-nav-link href="{{ route('contact') }}"
                        :active="request()->routeIs('contact')">
                        {{ __('Contact') }}
                    </x-jet-responsive-nav-link>
                </div>
            </div>
        </div>
    </nav>
