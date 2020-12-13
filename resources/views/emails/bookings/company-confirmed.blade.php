@component('mail::message')
# {{__('Booking confirmation')}}

{{ __('Dear Customer!') }}

{{__('As agreed, we will confirm your appointment in writing:')}}

**{{__('Booking reference')}}**  
{{ $bookingNumber }}

**{{__('Date')}}**  
{{ $date }} 

**{{__('Start and estimated end of cleaning')}}**  
{{ $time }} - {{ $end_time}}

**{{__('Location')}}**  
{{ $route}} {{ $street_number}}  
{{ $postal_code }} {{ $city }}  

@component('mail::button', ['url' => $url])
{{__('View my bookings')}}
@endcomponent

{{__('Thanks')}},<br>
The Greenwiperz Team
@endcomponent