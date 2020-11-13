@component('mail::message')
# Cancelation confirmation

The following booking has been canceled:

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

**Amount refunded**  
{{ $refundedAmount }}  

@component('mail::button', ['url' => $url])
View my bookings
@endcomponent

Thanks,<br>
The Greenwiperz team
@endcomponent