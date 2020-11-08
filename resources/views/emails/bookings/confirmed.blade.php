@component('mail::message')
# Booking confirmation

Thank you for your booking. Here is the summary

**Booking reference**  
{{ $bookingNumber }}

**Car to be cleaned**  
{{ $bookingVehicle}}  
{{ $bookingNumberPlate }}  
{{ $bookingColor }}  

**Date and Time of cleaning**  
{{ $bookingDate}} {{ $bookingTime }}  


**Place of cleaning**  
{{ $bookingRoute}} {{ $bookingStreet}}  
{{ $bookingPostalCode }} {{ $bookingCity }}  

**Amount payed**  
{{ $bookingPrice }}  

@component('mail::button', ['url' => $url])
View my bookings
@endcomponent

Thanks,<br>
The Greenwiperz team
@endcomponent