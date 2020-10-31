<x-guest-layout>
    <x-guest-navigation />
    <div class="max-w-7xl mx-auto pt-20  ">
        <div class="bg-white rounded-lg shadow-sm px-4 py-10 sm:px-16 sm:py-12">
            <div class="flex flex-wrap">
                <div class="text-center sm:text-left w-full sm:w-2/5 px-4 sm:px-0">
                    <h2 class="text-xl leading-9 tracking-normal font-bold text-gray-900 sm:text-2xl sm:leading-10 mb-4 uppercase">
                        {{ __('about.title')}}
                    </h2>
                    <div class="prose prose-lg text-gray-500 mx-auto  sm:mx-px">
                        <p> {{ __('about.paragraph1')}}</p>
                        <p> {{ __('about.paragraph2')}}</p>
                        <p> {{ __('about.paragraph3')}}</p>
                    </div>
                    <div class="mt-4 text-cool-gray-900 text-lg">
                        Georgie & Gabor
                    </div>
                </div>
                <div class="flex justify-center w-full sm:w-3/5 px-2 sm:px-0 mt-6">
                    <img class="shadow-2xl h-48 sm:h-80" src="{{ asset('img/about-us.jpg') }}"  alt="about us image" />
                </div>
            </div>
        </div>
        <x-footer />
</x-guest-layout>
