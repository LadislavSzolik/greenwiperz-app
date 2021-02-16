@props([
'size', 'exteriorPrice', 'exteriorDuration', 'intextBasicPrice' , 'intextBasicDuration', 'intextPremiumPrice' , 'intextPremiumDuration',
'colors' => ['bg-green-50','bg-green-100','bg-green-200','bg-green-300'],
'colorSelected' => 0
])

<li class="col-span-1 bg-white rounded-lg shadow-lg border-t border-gray-100 ">
    <div class="w-full flex items-center justify-between p-6 space-x-6">
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
    <div class="bg-gray-50 w-full px-4 py-2 space-y-3">
        <div class="flex justify-between ">
            <div class="text-sm text-gray-700 ">
                {{ __('pricespage.exterior') }}
            </div>
            <div class="text-right">
                <p class="font-black text-base">CHF {{ $exteriorPrice }}.- </p> 
                {{ $exteriorDuration }} {{ __('pricespage.minutes') }} *
            </div>
        </div>
        <div class="flex justify-between ">
            <div class="text-sm text-gray-700 ">
                {{ __('pricespage.intexteriorBasic') }}
            </div>
            <div class="text-right">
                <p class="font-black text-base">CHF {{ $intextBasicPrice }}.- </p>
                {{ $intextBasicDuration }} {{ __('pricespage.minutes') }} *
            </div>
        </div>
        <div class="flex justify-between ">
            <div class="text-sm text-gray-700 ">
                {{ __('pricespage.intexteriorPremium') }}
            </div>
            <div class="text-right">
                <p class="font-black text-base">CHF {{ $intextPremiumPrice }}.- </p>
                {{ $intextPremiumDuration }} {{ __('pricespage.minutes') }} *
            </div>
        </div>
    </div>    
</li>