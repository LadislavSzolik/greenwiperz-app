<section id="welcome-benefits">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="mb-8 max-w-2xl mx-auto text-center">
            <h2 class="text-4xl tracking-tight leading-10 font-extrabold text-gray-800 sm:text-5xl sm:leading-none text-center">
                {{ __('homepage.benefitMainTitle') }}
            </h2>
        </div>

        <dl class="rounded bg-white shadow-md sm:grid sm:grid-cols-3">
            <div class="flex flex-col border-b border-gray-100 p-6 text-center sm:border-0 sm:border-r">
                <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500" id="item-1">
                    {{ __('homepage.benefit1Description') }}
                </dt>
                <dd class="order-1 text-2xl leading-none font-extrabold text-green-600" aria-describedby="item-1">
                    <img class="mx-auto" src="{{ asset('img/save_water.png') }}" alt="Water saving" />
                    {{ __('homepage.benefit1Title') }}
                </dd>
            </div>
            <div class="flex flex-col border-t border-b border-gray-100 p-6 text-center sm:border-0 sm:border-l sm:border-r">
                <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                    {{ __('homepage.benefit2Description') }}
                </dt>
                <dd class="order-1 text-2xl leading-none font-extrabold text-green-600">

                    <img class="mx-auto" src="{{ asset('img/one_hour_hustle.png') }}" alt="Hustling" />

                    {{ __('homepage.benefit2Title') }}
                </dd>
            </div>
            <div class="flex flex-col border-t border-gray-100 p-6 text-center sm:border-0 sm:border-l">
                <dt class="order-2 mt-2 text-lg leading-6 font-medium text-gray-500">
                    {{ __('homepage.benefit3Description') }}
                </dt>
                <dd class="order-1 text-2xl leading-none font-extrabold text-green-600">
                    <img class="mx-auto" src="{{ asset('img/shame.png') }}" alt="Feeling shamed" />
                    {{ __('homepage.benefit3Title') }}
                </dd>
            </div>
        </dl>
    </div>
</section>
