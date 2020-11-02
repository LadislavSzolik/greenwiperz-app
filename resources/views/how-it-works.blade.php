<x-guest-layout>
    <x-guest-navigation />
    <div class="max-w-7xl mx-auto pt-20  ">
        <div class="bg-white rounded-lg shadow-sm px-4 py-10 sm:px-16 sm:py-12">

            <!-- HOW IT WORKS -->
            <div class="my-8 ">
                <h2
                    class="text-xl leading-9 tracking-tight font-bold text-gray-900 sm:text-2xl sm:leading-10 mb-4 uppercase text-center">
                    {{ __('homepage.howWorksMainTitle') }}
                </h2>

                <div class="flex flex-wrap">
                    <div class="prose prose-lg text-gray-500 w-full sm:w-2/5">
                        <ul>
                            <li>{{ __('homepage.howWorksParagrph1') }} </li>
                            <li>{{ __('homepage.howWorksParagrph2') }} </li>
                            <li>{{ __('homepage.howWorksParagrph3') }} </li>
                            <li>{{ __('homepage.howWorksParagrph4') }} </li>
                            <li>{{ __('homepage.howWorksParagrph5') }} </li>
                            <li>{{ __('homepage.howWorksParagrph6') }} </li>
                        </ul>
                    </div>

                    <div class="flex justify-center w-full sm:w-3/5 px-2 sm:px-0 mt-6">
                        <img class="shadow-2xl h-48 sm:h-80" src="{{ asset('img/howitworks/how-it-works-biker.jpg') }}"
                            alt="Cleaning" />
                    </div>
                </div>

            </div>

            <!-- ABOUT NANOTECH -->
            <div class="my-8 ">
                <h2
                    class="text-xl leading-9 tracking-normal font-bold text-gray-900 sm:text-2xl sm:leading-10 mb-4 uppercase text-center">
                    {{ __('homepage.howNanotechMainTitle') }}
                </h2>

                <div class="flex flex-wrap">
                    <div class="flex justify-center w-full sm:w-2/5 px-2 sm:px-0 mt-6 mb-8">
                        <img class="shadow-2xl h-48 sm:h-64" src="{{ asset('img/howitworks/how-it-works-nano.jpg') }}"
                            alt="Cleaning" />
                    </div>

                    <div class="prose prose-lg text-gray-500 text-left w-full sm:w-3/5">
                        <ul>
                            <li>{{ __('homepage.howNanotechParagrph1') }} </li>
                            <li>{{ __('homepage.howNanotechParagrph2') }} </li>
                            <li>{{ __('homepage.howNanotechParagrph3') }} </li>
                            <li>{{ __('homepage.howNanotechParagrph4') }} </li>
                            <li>{{ __('homepage.howNanotechParagrph5') }} </li>
                        </ul>
                    </div>                    
                </div>

            </div>


            <!-- EXCLUDED -->
            <div class="my-8">
                <h2
                    class="text-xl leading-9 tracking-normal font-bold text-gray-900 sm:text-2xl sm:leading-10 mb-4 uppercase text-center">
                    {{ __('homepage.exclConditionMainTitle') }}
                </h2>

                <div class="prose prose-lg text-gray-500 ">
                    <ul>
                        <li>{{ __('homepage.exclConditionParagrph1') }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <x-footer />
</x-guest-layout>
