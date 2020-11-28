@props([
    'text',
    'subText' => null,
])

<div class="mt-2">
    <label class="inline-flex items-center ">
        <input type="radio" {!! $attributes->merge(['class' => 'form-radio text-green-400 h-6 w-6']) !!}>
        <div class="ml-2 flex flex-wrap " >
            @if ($text)
                <span class="mr-2">{{ __($text) }}</span>            
            @endif

            @if ($subText)
                <span class="text-gray-500">{{ $subText }}</span>            
            @endif
        </div>
        
    </label>
</div>

