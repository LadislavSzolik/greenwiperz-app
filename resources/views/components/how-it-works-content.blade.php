<!-- HOW IT WORKS -->
<section class="bg-white" id="how-it-works">
    <div class="max-w-6xl mx-auto py-12 px-4 sm:px-6">
        <div class="mb-8">
            <h2  class="text-4xl tracking-tight leading-10 font-extrabold text-gray-800 sm:text-5xl sm:leading-none text-center">
                {{ __('homepage.howWorksMainTitle') }}
            </h2>
        </div>
        <div class="mb-8 mx-auto flex justify-center text-gray-500 w-3/5 px-10 text-2xl">
            {{ __('homepage.howWorksParagrph1') }}
        </div>

        <div class="flex flex-wrap">
            <div class="prose prose-lg text-gray-500 w-full sm:w-2/5">
                <ul>
                    <li>{{ __('homepage.howWorksParagrph2') }} </li>
                    <li>{{ __('homepage.howWorksParagrph3') }} </li>
                    <li>{{ __('homepage.howWorksParagrph4') }} </li>
                    <li>{{ __('homepage.howWorksParagrph5') }} </li>
                    <li>{{ __('homepage.howWorksParagrph6') }} </li>
                </ul>
            </div>
            <div class="flex justify-center w-full sm:w-3/5 px-2 sm:px-0 mt-8">
                <img class="shadow-2xl h-48 sm:h-80 rounded-lg" src="{{ asset('img/howitworks/how-it-works-biker.jpg') }}"
                    alt="Cleaning" />
            </div>
        </div>
    </div>
</section>

<!-- HOW NANOTECH WOKRS -->
<section class=" bg-white">
    <div class="max-w-6xl mx-auto py-12 px-4 sm:px-6">
        <div class="mb-8 max-w-2xl mx-auto">
            <h2 class="text-4xl tracking-tight leading-10 font-extrabold text-gray-800 sm:text-5xl sm:leading-none text-center">
                {{ __('homepage.howNanotechMainTitle') }}
            </h2>
        </div>

        <div class="flex flex-wrap">
            <div class="flex justify-center w-full sm:w-2/5 px-2 sm:px-0 mt-6 mb-8">
                <img class="shadow-2xl h-48 sm:h-64 rounded" src="{{ asset('img/howitworks/how-it-works-nano.jpg') }}"
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
</section>


<!-- EXCLUDED -->
<section class="bg-white">
    <div class="max-w-6xl mx-auto py-12 px-4 sm:px-6">
        <div class="mb-8 max-w-2xl mx-auto text-center">
            <h2 class="text-4xl tracking-tight leading-10 font-extrabold text-gray-800 sm:text-5xl sm:leading-none ">
                {{ __('homepage.exclConditionMainTitle') }}
            </h2>
        </div>
        <div class="prose prose-lg text-gray-500 mx-auto text-center">
            {{ __('homepage.exclConditionParagrph1') }}
        </div>
    </div>
</section>
