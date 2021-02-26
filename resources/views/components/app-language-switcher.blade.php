<div class="text-sm  ml-4 my-4 sm:mr-6 space-x-4 sm:space-x-2  ">
    <a href="{{ route(current_lang() . '.' . 'language', ['locale' => 'en']) }}" class="{{ App::isLocale('en') ? 'text-green-600':'text-gray-700' }}" id="en"> English</a>
    <a href="{{ route(current_lang() . '.' . 'language', ['locale' => 'de']) }}" class="{{ App::isLocale('de') ? 'text-green-600':'text-gray-700' }}" id="de"> Deutsch</a>
</div>
