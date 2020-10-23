@props(['bookingTime',
'availableSlots',
'travelTimeNeeded',
'serviceDuration'
])
<div x-data="{ open:false }" {{ $attributes }}>

    <div @click="open=true" class="mt-1 flex rounded-md shadow-sm ">
        <span
            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
            <svg class="w-5 h-5 text-gray-400" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18ZM11 6C11 5.44772 10.5523 5 10 5C9.44771 5 9 5.44772 9 6V10C9 10.2652 9.10536 10.5196 9.29289 10.7071L12.1213 13.5355C12.5118 13.9261 13.145 13.9261 13.5355 13.5355C13.9261 13.145 13.9261 12.5118 13.5355 12.1213L11 9.58579V6Z" />
            </svg>
        </span>
        <div class="rounded-none rounded-r-md flex-1 form-input block w-full">
            @if(strtotime($bookingTime)) 
                {{ Carbon\Carbon::parse($bookingTime)->addMinutes($travelTimeNeeded)->format('H:i')  }} - {{ Carbon\Carbon::parse($bookingTime)->addMinutes($travelTimeNeeded + $serviceDuration)->format('H:i') }}                     
  
            @else
                <span class="text-sm text-gray-500">Select a date with available timeslots</p>
            @endif   
        </div>      
    </div>

    
    @if($availableSlots) 
        <div x-show.transition.opacity="open" @click.away="open=false"  class="border rounded bg-white shadow-lg">
            <div class="flex flex-wrap p-2">
                @foreach ($availableSlots as $timeslot)
                    <div wire:click="$set('bookingTime', '{{ $timeslot->timeslot }}')" @click="open=false"  class="w-full sm:w-1/3 cursor-pointer text-center text-sm">
                        <div class="py-2 hover:bg-green-200 rounded-md">{{ Carbon\Carbon::parse($timeslot->timeslot)->addMinutes($travelTimeNeeded)->format('H:i') }} - {{ Carbon\Carbon::parse($timeslot->timeslot)->addMinutes($travelTimeNeeded + $serviceDuration)->format('H:i') }} </div>
                    </div>                
                @endforeach
            </div>
        </div>               
    @endif    
</div>
