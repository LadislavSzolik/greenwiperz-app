<!-- Hero section -->
<section class="bg-white py-10">
    <div class="max-w-7xl mx-auto text-center px-4 sm:px-6">

        <div class="mb-4 inline-flex justify-center">
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

        <div class="mt-5 inline-flex justify-center">
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
</section>
