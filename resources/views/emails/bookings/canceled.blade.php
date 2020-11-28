@component('mail::message')
# {{__('Cancelation confirmation')}}

{{__('The following booking has been canceled')}}  

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

**{{__('Amount refunded')}}**  
{{ $refundedAmount }}  

@component('mail::button', ['url' => $url])
{{__('View my bookings')}}
@endcomponent

{{__('Thanks')}},<br>
The Greenwiperz Team
@endcomponent