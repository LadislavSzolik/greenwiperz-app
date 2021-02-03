@component('mail::message')
# {{__('Booking confirmation')}}

{{__('Thank you for your booking! Please find below the summary')}}


**{{__('Booking reference')}}**  
{{ $booking_nr }}  

**{{__('Car')}}**  
{{ $car}}  
{{ $number_plate }}  
{{ __($color) }} 

**{{__('Date and Time of cleaning')}}**  
@foreach($appointments as $appointment)
{{ $appointment->dateForEditing }} {{ $appointment->start_time }} - {{ $appointment->end_time }}  
@endforeach

**{{__('Car parking')}}**  
{{ $route}} {{ $street_number}}  
{{ $postal_code }} {{ $city }}  

**{{__('Amount')}}**  
{{ $price }}  

@component('mail::button', ['url' => $url])
{{__('View my bookings')}}
@endcomponent

{{__('Thanks')}},  
The Greenwiperz Team
@endcomponent
