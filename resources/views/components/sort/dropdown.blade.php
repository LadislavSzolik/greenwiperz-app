<div x-data="{show: false}" @click.away="show=false">
    <button @click="show=!show" class="px-4 py-2 flex items-center text-sm font-medium text-gray-500 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
        <div> {{ $trigger }}</div>

        <div class="ml-1">
            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </div>
    </button>

    <div style="display: none;" class="absolute rounded bg-white shadow-lg mt-1" x-show="show" x-transition:enter="transition duration-200 transform" x-transition:enter-start="-translate-y-2 opacity-0" x-transition:leave="transition duration-100 transform" x-transition:leave-end="-translate-y-2 opacity-0">
        {{ $slot}}
    </div>
</div>