<div  x-data="timeSlotPickerData()" {{ $attributes }}
>

    <div @click="open=true" class="mt-1 flex rounded-md shadow-sm ">
        <span
            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
            <svg class="w-5 h-5 text-gray-400" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18ZM11 6C11 5.44772 10.5523 5 10 5C9.44771 5 9 5.44772 9 6V10C9 10.2652 9.10536 10.5196 9.29289 10.7071L12.1213 13.5355C12.5118 13.9261 13.145 13.9261 13.5355 13.5355C13.9261 13.145 13.9261 12.5118 13.5355 12.1213L11 9.58579V6Z" />
            </svg>
        </span>
        <div x-show="timeslots.length>0" class="rounded-none rounded-r-md flex-1 form-input block w-full" x-text="startTime(selectedTimeSlot.timeslot) +'-'+ endTime(selectedTimeSlot.timeslot)"></div>
        <div x-show="timeslots.length==0" class="rounded-none rounded-r-md flex-1 form-input block w-full"> No timeslot available</div>
        <div x-show="timeslots.length>0 && !indexOfTimeSlot">Select a date </div>
        
    </div>

    <!-- timeslot dropdown -->
    <div x-show.transition.opacity="open" @click.away="open=false" class="border rounded bg-white shadow-lg">
        <div class="flex flex-wrap p-2">            
            <template x-for="(timeslot, index) in timeslots" :key="index">
                <div x-on:click="open=false;indexOfTimeSlot=index;$dispatch('input',startTime(timeslot.timeslot));" class="w-full sm:w-1/4 cursor-pointer text-center">
                    
                    <div x-show="!isSelected(index)"  
                    x-text="startTime(timeslot.timeslot)+'-'+ endTime(timeslot.timeslot)"
                    class="py-2 hover:bg-green-200">
                    </div>
                    <div x-text="index"></div>

                    <div x-show="isSelected(index)" 
                    x-text="startTime(timeslot.timeslot)+'-'+ endTime(timeslot.timeslot)"
                    class="py-2 text-green-500">
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

<script>
    function timeSlotPickerData() {
        return {
            open: false,
            indexOfTimeSlot: @entangle('indexOfSelectedTime'),
            timeslots: @entangle('availableSlots'),
            duration: @entangle('serviceDuration'),

            startTime(startTime){                
                return moment(startTime, 'HH:mm:ss').add(30, 'minutes').format('HH:mm');
            },
            endTime(startTime) {
                return moment(startTime, 'HH:mm:ss').add(this.duration+30, 'minutes').format('HH:mm');
            },
            get selectedTimeSlot() {
                if(this.timeslots.length > 0) {
                    return this.timeslots[this.indexOfTimeSlot];
                } else {
                    return [];
                }
            },
            isSelected(index) {
                return index === this.indexOfTimeSlot;
            }
           

        }
    }

</script>

