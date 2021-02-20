@props([
'size', 'exteriorPrice', 'exteriorDuration', 'intextBasicPrice' , 'intextBasicDuration', 'intextPremiumPrice' , 'intextPremiumDuration',
'colors' => ['bg-green-100','bg-green-200','bg-green-300','bg-green-400'],
'colorSelected' => 0
])

<li class="col-span-1 bg-white rounded-lg shadow-md border-t border-gray-100 ">
    <div class="w-full flex items-center justify-between p-6 space-x-6 bg-gray-50">
        <div class="flex-shrink-0 text-xl font-bold justify-center items-center text-center {{ $colors[$colorSelected] }} rounded px-4 py-2">
            {{ $size }}
        </div>
        <div class="flex-1 ">
            <h3 class="text-gray-900 text-sm leading-5 font-medium ">
                {{ $carType }}
            </h3>
            <p class="mt-1 text-gray-500 text-sm leading-5 ">
                {{ $carExamples }}
            </p>
        </div>
    </div>
    <div class="w-full px-4 py-4 space-y-4">
        <div class="flex">
            <span class="flex-1 text-sm text-gray-700 inline-flex items-center ">
                {{ __('pricespage.exterior') }}
            </span>
            <div class="flex-1 text-right">
                <p class="font-bold text-base">CHF {{ $exteriorPrice }}.- </p>
                <span class="text-sm">{{ $exteriorDuration }} {{ __('pricespage.minutes') }}*</span>
            </div>
        </div>
        <div class="flex ">
            <span class="flex-1 text-sm text-gray-700 ">
                {{ __('pricespage.intexteriorBasic') }}
            </span>
            <div class="flex-1 text-right">
                <p class="font-bold text-base">CHF {{ $intextBasicPrice }}.- </p>
                <span class="text-sm">{{ $intextBasicDuration }} {{ __('pricespage.minutes') }} *</span>
            </div>
        </div>
        <div class="flex">
            <div class="flex-1 text-sm text-gray-700 ">
                {{ __('pricespage.intexteriorPremium') }}
            </div>
            <div class="flex-1 text-right">
                <p class="font-bold text-base">CHF {{ $intextPremiumPrice }}.- </p>
                <span class="text-sm ">{{ $intextPremiumDuration }} {{ __('pricespage.minutes') }} *</span>
            </div>
        </div>
    </div>
</li>