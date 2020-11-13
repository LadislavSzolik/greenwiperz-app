<x-guest-layout>
    <x-guest-navigation />
    <main class="relative pt-16">
        <section class="bg-white py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="mb-6">
                    <h2
                        class="text-4xl tracking-tight leading-10 font-extrabold text-gray-800 sm:text-5xl sm:leading-none text-center">
                        {{ __('about.title') }}
                    </h2>
                </div>
                <div class="flex flex-wrap-reverse sm:flex-wrap">
                    <div class="w-full sm:w-2/5 px-4 sm:px-0">
                        <div class="prose prose-lg text-gray-500 mx-auto  sm:mx-px">
                            <p> {{ __('about.paragraph1') }}</p>
                            <p> {{ __('about.paragraph2') }}</p>
                            <p> {{ __('about.paragraph3') }}</p>
                        </div>
                        <div class="mt-4 text-cool-gray-900 text-2xl italic">
                            Georgie & Gabor
                        </div>
                    </div>
                    <div class="flex justify-center w-full sm:w-3/5 px-2 sm:px-0 mt-6 mb-12">
                        <img class="shadow-2xl h-58 sm:h-80 rounded-lg" src="{{ asset('img/about-us.jpg') }}"
                            alt="About us image" />
                    </div>
                </div>
            </div>
        </section>
    </main>
    <x-footer />
</x-guest-layout>
