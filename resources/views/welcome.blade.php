<x-guest-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


                @if (Route::has('login'))
                    <div class="fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                            <a href="{{ route('bookings.create') }}" class="text-gray-700 underline">Book a car cleaning</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 underline">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-gray-700 underline">Register</a>
                            @endif
                    @endif
                </div>
                @endif

                <div class="px-6 py-12 sm:px-20 bg-white border-b border-gray-200">
                
                    <div class="flex justify-center ">
                        <x-application-logo class="h-16 text-green-500" />
                    </div>

                    <div class="text-2xl flex justify-center text-green-600 font-bold">
                        
                        <div>Welcome to Greenwiperz!</div>
                    </div>

                    <div class="mt-10 flex items-center justify-center sm:px-6 ">
                        <a href="{{ route('bookings.create') }}"
                        class="text-white px-4 py-2 bg-green-500 rounded-md ">Book a car cleaning</a>
                    </div>
                    
                </div>
            </div>
        </div>
        </div>
    </x-guest-layout>
