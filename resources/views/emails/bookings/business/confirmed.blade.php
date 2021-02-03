@component('mail::message')
# {{__('Booking confirmation')}}

{{ __('Dear Customer!') }}

{{__('As agreed, we will confirm your appointment in writing:')}}

**{{__('Booking reference')}}**  
{{ $booking_nr }}

**{{__('Date(s)')}}**  
@foreach($appointments as $appointment)
{{ $appointment->dateForEditing }} {{ $appointment->start_time }} - {{ $appointment->end_time }}  
@endforeach

**{{__('Location')}}**  
{{ $route}} {{ $street_number}}  
{{ $postal_code }} {{ $city }}  

@component('mail::button', ['url' => $url])
{{__('View my bookings')}}
@endcomponent

{{__('Thanks')}},<br>
The Greenwiperz Team
@endcomponent