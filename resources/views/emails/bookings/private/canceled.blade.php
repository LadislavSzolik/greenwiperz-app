@component('mail::message')
# {{__('Cancelation confirmation')}}

{{__('The following booking has been canceled')}}  

**{{__('Booking reference')}}**  
{{ $booking_nr }}

**{{__('Car')}}**  
{{ $car}}  
{{ $number_plate }}  
{{ __($color) }} 

**{{__('Date and Time of cleaning')}}**  
{{ $date}} {{ $time}}  


**{{__('Car parking')}}**  
{{ $route}} {{ $street_number}}  
{{ $postal_code }} {{ $city }}  

**{{__('Amount')}}**  
{{ $price }}  

**{{__('Amount refunded')}}**  
{{ $refundedAmount }}  

@component('mail::button', ['url' => $url])
{{__('View my bookings')}}
@endcomponent

{{__('Thanks')}},  
The Greenwiperz Team
@endcomponent