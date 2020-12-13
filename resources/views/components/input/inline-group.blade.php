@props([
    'for', 
    'label',       
    'helpText' => false,
])

<div {{ $attributes }} >

    <div class="inline-grid grid-cols-6 items-center" >
        <label for="{{ $for }}" class='block font-medium text-gray-700 text-sm col-span-3'>
            {{ $label }}
        </label>

         {{ $slot }}           
        
    </div>

    @error($for)
        <p class='text-sm text-red-600'>{{ $message }}</p>
    @enderror

    @if ($helpText)
        <p  class='text-sm text-gray-500'>{{ $helpText }}</p>
    @endif
    
</div>

