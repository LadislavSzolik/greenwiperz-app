@component('mail::message')
# {{__('Booking completion confirmation')}}

{{__('Thank you for choosing us!')}}  
{{__('We are done with making your car shiny and clean again!')}}

**{{__('Booking reference')}}**  
{{ $bookingNumber }}

**{{__('Car')}}**  
{{ $car}}  
{{ $number_plate }}  
{{ __($color) }}  

**{{__('Date and Time of cleaning')}}**  
{{ $date}} {{ $time}} 


**{{__('Car parking')}}**  
{{ $route}} {{ $street_number}}  
{{ $postal_code }} {{ $city }}  


@component('mail::button', [ 'url' => $rating_url])
{{__('Rate your cleaning')}}
@endcomponent

@component('mail::button', ['color'=>'secondary','url' => $bookings_url])
{{__('Book another cleaning')}}
@endcomponent



{{__('Thanks')}},<br>
The Greenwiperz Team
@endcomponent