@props([
    'colors' => App\Models\Car::COLORS,
    ])
<div x-data="{selectedColor: @entangle($attributes->wire('model'))}" 
    class="mt-1 flex rounded-md shadow-sm">

    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">    
        <div :style="'background: ' +selectedColor"  class="w-4 h-4"> </div>                
    </span>
    <select {{ $attributes }} class="rounded-none rounded-r-md flex-1 form-input block w-full capitalize" autocomplete=off required >            
        <option value="">--</option>
        @foreach($colors as $color)
        <option class="capitalize" value="{{ $color }}" >{{ __($color) }}</option>
        @endforeach       
        
    </select>

</div>