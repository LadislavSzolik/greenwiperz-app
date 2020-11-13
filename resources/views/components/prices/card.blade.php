@props([
    'size', 'exteriorPrice', 'exteriorDuration', 'intextPrice' , 'intextDuration',
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
    <div class="bg-gray-50">
        <div class="-mt-px flex">
            <div class="w-0 flex-1 flex">
                <div class="ml-4 my-2">
                    <p class="text-sm text-gray-500 ">
                        {{ __('Exterior only') }}
                    </p>
                    <p class="mt-2 font-black text-lg">
                        {{ $exteriorPrice }}
                    </p>
                    <p>
                        {{ $exteriorDuration }}
                    </p>
                </div>
            </div>
            <div class="-ml-px w-0 flex-1 flex">
                <div class="ml-4 my-2">
                    <p class="text-sm text-gray-500 ">
                        {{ __('Interior & Exterior') }} 
                    </p>
                    <p class="mt-2 font-black text-lg">
                        {{ $intextPrice }}
                    </p>
                    <p>
                        {{ $intextDuration }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</li>