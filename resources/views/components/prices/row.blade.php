@props([
    'size', 'exteriorPrice', 'exteriorDuration', 'intextPrice' , 'intextDuration',
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
        <span class="font-black">{{ $exteriorPrice }}</span> / {{ $exteriorDuration }}
    </td>
    <td class="px-6 py-4 whitespace-no-wrap ">
        <span class="font-black">{{ $intextPrice }}</span> / {{ $intextDuration }}
    </td>
</tr>