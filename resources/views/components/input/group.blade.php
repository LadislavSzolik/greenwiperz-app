@props([
    'for', 
    'label',       
    'helpText' => false,
])

<div {{ $attributes }} >

    <label for="{{ $for }}" class='block font-medium text-sm text-gray-700'>
        {{ $label }}
    </label>
    
    {{ $slot }}

    @error($for)
        <p class='text-sm text-red-600'>{{ $message }}</p>
    @enderror

    @if ($helpText)
        <p  class='text-sm text-gray-500'>{{ $helpText }}</p>
    @endif
    
</div>

