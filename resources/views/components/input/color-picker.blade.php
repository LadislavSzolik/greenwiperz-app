<div {{$attributes}} x-data="colorPicker()"  x-init="initColor()">

    <div @click="open=true" class='mt-1 form-input rounded-md shadow-sm relative cursor-pointer'>
        <div class="flex items-center">
            <div :style="'background: ' +selectedColor.name" class="rounded border w-4 h-4 mr-2"></div>
            <div class="capitalize" x-text="selectedColor.name"></div>
        </div>
    </div>

    <!-- custom dropdown -->
    <div x-show.transition.opacity="open" @click.away="open = false"
        class="absolute border rounded bg-white shadow-lg w-60 ">

        <template x-for="(color, index) in colors" :key="index">

            <div @click="setColor(color);$dispatch('input',color.name);open=false;"
                class="inline-flex justify-between items-center w-full h-8 pl-2 cursor-pointer hover:bg-gray-200">

                <div class="flex items-center">
                    <div class="rounded w-4 h-4 mr-2 border" :style="'background:'+ color.name "></div>
                    <div class="capitalize" x-text="color.name"></div>
                </div>

                <div x-show="color.selected"><svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"
                            d="M16.7071 5.29289C17.0976 5.68342 17.0976 6.31658 16.7071 6.70711L8.70711 14.7071C8.31658 15.0976 7.68342 15.0976 7.29289 14.7071L3.29289 10.7071C2.90237 10.3166 2.90237 9.68342 3.29289 9.29289C3.68342 8.90237 4.31658 8.90237 4.70711 9.29289L8 12.5858L15.2929 5.29289C15.6834 4.90237 16.3166 4.90237 16.7071 5.29289Z"
                            fill="#4A5568" /></svg>
                </div>
            </div>

        </template>

    </div>
</div>

<script>
    function colorPicker() {
        return {
            colorFromParentComponent: @entangle($attributes->wire('model')),
            open: false,
            colors: [{
                    name: 'black',
                    selected: false
                },
                {
                name: 'gray',
                    selected: false
                },
                {
                name: 'silver',
                    selected: false
                },
                {
                    name: 'white',
                    selected: false
                },
                {
                    name: 'red',
                    selected: false
                },
                {
                    name: 'orange',
                    selected: false
                },
                {
                    name: 'yellow',
                    selected: false
                },
                {
                    name: 'brown',
                    selected: false
                },
                {
                    name: 'green',
                    selected: false
                },
                {
                    name: 'teal',
                    selected: false
                },
                {
                    name: 'pink',
                    selected: false
                }
            ],
            get selectedColor() {
                return this.colors.find(color => {
                    return color.selected === true
                });
            },
            setColor(color) {
                this.colors.forEach(color => color.selected = false);
                color.selected = true;                                
            },
            initColor() {    
                const colorName = this.colorFromParentComponent;
                this.colors.forEach(color => { colorName === color.name ? color.selected =true  : color.selected=false});
            }
        }
    }

</script>
