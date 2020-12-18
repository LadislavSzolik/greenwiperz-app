@component('mail::message')
# {{__('Booking confirmation')}}

{{ __('Dear Customer!') }}

{{__('Thank you very much for your order, we have recorded the cleaning of :numberOfCars cars in our system. Our staff will contact you shortly by phone to clarify the exact time.', ['numberOfCars' => $numberOfCars])}}

**{{__('Booking reference')}}**
{{ $booking_nr }}

**{{__('Date')}}**
{{ $date }}

**{{__('Location')}}**
{{ $route}} {{ $street_number}}
{{ $postal_code }} {{ $city }}

@component('mail::button', ['url' => $url])
{{__('View my bookings')}}
@endcomponent

{{__('Thanks')}},<br>
The Greenwiperz Team
@endcomponent
