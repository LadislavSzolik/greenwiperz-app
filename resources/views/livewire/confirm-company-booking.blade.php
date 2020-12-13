<div>
    <x-header>
        <x-slot name="title">{{ __('Confirmation') }}</x-slot>
        <x-slot name="actions">
        </x-slot>
    </x-header>


    <div class="py-4 sm:px-6 lg:px-8 w-full sm:max-w-4xl mx-auto">
        <div class="bg-green-50 p-4 rounded shadow-md">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p>Thank you very much for your order, we have recorded the cleaning of X cars in our system. Our staff will contact you shortly by phone to clarify the exact time.</p>
                    <a href="{{ route('bookings.index') }}" class="text-green-500 font-bold hover:text-green-700 active:text-green-800">{{ __('Bookings')}}</a>
                </div>
            </div>
        </div>

    </div>