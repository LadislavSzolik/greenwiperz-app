@component('mail::message')
# {{__('Booking completion confirmation')}}

{{__('Thank you for choosing us!')}}  
{{__('We are done with making your cars shiny and clean again!')}}

**{{__('Booking reference')}}**  
{{ $booking_nr }}

**{{__('Number of cars cleaned')}}**  
{{ $numberOfCars}}  

**{{__('Location')}}**  
{{ $route}} {{ $street_number}}  
{{ $postal_code }} {{ $city }}  


@component('mail::button', [ 'url' => $rating_url])
{{__('Rate your cleaning')}}
@endcomponent

@component('mail::button', ['color'=>'secondary','url' => $url])
{{__('Book another cleaning')}}
@endcomponent



{{__('Thanks')}},<br>
The Greenwiperz Team
@endcomponent