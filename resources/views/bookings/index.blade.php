<x-app-layout>
    <x-slot name="header">
        <div class="inline-flex  items-center justify-between w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Your bookings') }}
            </h2>
            <x-form-button method="GET" action="/bookings/create" buttonType="primary" >New</x-form-button>
        </div>
    </x-slot>

    <x-content-section>        
            @forelse ($bookings as $booking)
                <div class=" inline-flex m-2 w-full sm:max-w-sm">
                    <div class="flex-1 grid grid-cols-6 gap-2 p-4 bg-white border rounded ">
                        <div class="col-span-6 sm:col-span-2 text-sm text-gray-600">{{ __('Date and time') }}</div>
                        <div class="col-span-6 sm:col-span-4 sm:text-right">{{ $booking->bookingTimeslot->date }} {{$booking->bookingTimeslot->start_time}}</div>

                        <div class="col-span-6 sm:col-span-2 text-sm text-gray-600">{{ __('Parking place') }}</div>
                        <div class="col-span-6 sm:col-span-4 sm:text-right">{{ $booking->parking_street }} <p>{{$booking->parking_postal_code}} </p></div>

                        <div class="col-span-6 sm:col-span-2 text-sm text-gray-600">{{ __('Car to be cleaned') }}</div>
                        <div class="col-span-6 sm:col-span-4 sm:text-right">{{ $booking->number_plate }}</div>

                        <div class="col-span-6 sm:col-span-2 text-sm text-gray-600">{{ __('Service type') }}</div>
                        <div class="col-span-6 sm:col-span-4 sm:text-right">{{ $booking->service_type }}</div>
                        
                        <div class="col-span-6 mt-2 py-2 text-right">
                            <x-form-button class="mr-2" method="GET" action="" buttonType="destructive" >{{ __('Cancel cleaning') }}</x-form-button>
                            <x-form-button method="GET" action="/bookings/{{ $booking->id }}" >{{ __('Show details') }}</x-form-button>
                        </div>
                    </div>
                </div>
            @empty
                <p>{{ __('No bookings yet') }}</p>
            @endforelse       
            
           <form method="POST" action="/payments/store">
              <input type="text" name="refno" value="GW23B0E66029-0001">
              <input type="text" name="amount" value="6500">
              <input type="text" name="currency" value="CHF">
              <input type="text" name="uppTransactionId" value="123456789">
              <input type="text" name="pmethod" value="CA">
              <input type="text" name="reqtype" value="CA">
              <input type="text" name="uppMsgType" value="CA">
              <input type="text" name="status" value="success">
            <x-button>
                Submit
            </x-button>
           </form>
    </x-content-section>
</x-app-layout>
