@props([
    'size', 'exteriorPrice', 'exteriorDuration', 'intextBasicPrice' , 'intextBasicDuration', 'intextPremiumPrice' , 'intextPremiumDuration',
])
<tr>
    <td class="px-6 py-4 ">
        <div class="flex items-center">
            <div class="flex-shrink-0 h-10 w-10 text-2xl font-bold">
                {{ $size }}
            </div>
            <div class="ml-4">
                <div class="text-sm leading-5 font-medium text-gray-900">
                    {{ $carType }}
                </div>
                <div class="text-sm leading-5 text-gray-500">
                    {{ $carExamples }}
                </div>
            </div>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-no-wrap">
        <span class="block font-black">CHF {{ $exteriorPrice }}.-</span> {{ $exteriorDuration }} {{ __('pricespage.minutes') }} *
    </td>
    <td class="px-6 py-4 whitespace-no-wrap ">
        <span class="block font-black">CHF {{ $intextBasicPrice }}.-</span> {{ $intextBasicDuration }} {{ __('pricespage.minutes') }} *
    </td>
    <td class="px-6 py-4 whitespace-no-wrap ">
        <span class="block font-black">CHF {{ $intextPremiumPrice }}.-</span>{{ $intextPremiumDuration }} {{ __('pricespage.minutes') }} *
    </td>
</tr>