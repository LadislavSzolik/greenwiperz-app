@component('mail::message')
# {{__('Cancelation confirmation')}}

{{__('The following booking has been canceled')}}  

**{{__('Booking reference')}}**  
{{ $booking_nr }}

**{{__('Location')}}**  
{{ $route}} {{ $street_number}}  
{{ $postal_code }} {{ $city }}  


@component('mail::button', ['url' => $url])
{{__('View my bookings')}}
@endcomponent

{{__('Thanks')}},<br>
The Greenwiperz Team
@endcomponent