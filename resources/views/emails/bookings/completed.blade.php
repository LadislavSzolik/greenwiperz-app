@component('mail::message')
# Booking completion confirmation

Thank you for choosing us!  
We are done with making your car shiny and clean again!

**Booking reference**  
{{ $bookingNumber }}

**Car to be cleaned**  
{{ $bookingCar}}  
{{ $bookingNumberPlate }}  
{{ $bookingColor }}  

**Date and Time of cleaning**  
{{ $bookingDateTime}} 


**Place of cleaning**  
{{ $bookingRoute}} {{ $bookingStreet}}  
{{ $bookingPostalCode }} {{ $bookingCity }}  


@component('mail::button', [ 'url' => $rating_url])
Rate your cleaning
@endcomponent

@component('mail::button', ['color'=>'secondary','url' => $bookings_url])
Book another cleaning
@endcomponent



Thanks,<br>
The Greenwiperz team
@endcomponent