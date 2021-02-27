{{--<div class="text-sm  ml-4 my-4 sm:mr-6 space-x-4 sm:space-x-2  ">--}}
{{--    <a href="{{ route('language', ['locale' => 'en']) }}" class="{{ App::isLocale('en') ? 'text-green-600':'text-gray-700' }}" id="en"> English</a>--}}
{{--    <a href="{{ route('language', ['locale' => 'de']) }}" class="{{ App::isLocale('de') ? 'text-green-600':'text-gray-700' }}" id="de"> Deutsch</a>--}}
{{--</div>--}}
<div x-data="{ dropdownOpen: false }"  class="relative">
    <button @click="dropdownOpen = ! dropdownOpen" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out px-2">
        <div>
        @switch(app()->getLocale())
            @case('en')
        English
        @break
        @case('de')
        Deutch
        @break
        @endswitch
        </div>
            <div class="ml-1">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                          clip-rule="evenodd" />
                </svg>
            </div>
    </button>
    <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>
    <div x-show="dropdownOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10">
        <a href="{{ route('language', ['locale' => 'en']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white">English</a>
        <a href="{{ route('language', ['locale' => 'de']) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-600 hover:text-white">Deutch</a>
    </div>
</div>
