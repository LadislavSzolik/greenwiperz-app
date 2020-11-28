@component('mail::message')
# {{__('Booking completion confirmation')}}

{{__('Thank you for choosing us!')}}  
{{__('We are done with making your car shiny and clean again!')}}

**{{__('Booking reference')}}**  
{{ $bookingNumber }}

**{{__('Car')}}**  
{{ $bookingCar}}  
{{ $bookingNumberPlate }}  
{{ __($bookingColor) }}  

**{{__('Date and Time of cleaning')}}**  
{{ $bookingDateTime}} 


**{{__('Car parking')}}**  
{{ $bookingRoute}} {{ $bookingStreet}}  
{{ $bookingPostalCode }} {{ $bookingCity }}  


@component('mail::button', [ 'url' => $rating_url])
{{__('Rate your cleaning')}}
@endcomponent

@component('mail::button', ['color'=>'secondary','url' => $bookings_url])
{{__('Book another cleaning')}}
@endcomponent



{{__('Thanks')}},<br>
The Greenwiperz Team
@endcomponent