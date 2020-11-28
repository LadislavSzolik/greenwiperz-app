@component('mail::message')
# {{__('Booking confirmation')}}

{{__('Thank you for your booking. Here is the summary')}}

**{{__('Booking reference')}}**  
{{ $bookingNumber }}

**{{__('Car')}}**  
{{ $bookingVehicle}}  
{{ $bookingNumberPlate }}  
{{ __($bookingColor) }} 

**{{__('Date and Time of cleaning')}}**  
{{ $bookingDateTime}}   

**{{__('Car parking')}}**  
{{ $bookingRoute}} {{ $bookingStreet}}  
{{ $bookingPostalCode }} {{ $bookingCity }}  

**{{__('Amount')}}**  
{{ $bookingPrice }}  

@component('mail::button', ['url' => $url])
{{__('View my bookings')}}
@endcomponent

{{__('Thanks')}},<br>
The Greenwiperz Team
@endcomponent