<input {{ $attributes->merge(['class' => 'mt-1 block w-full form-input rounded-md shadow-sm']) }}  />


<!-- order is important, first my script after that the google -->
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('greenwiperz.google_maps_api_key') }}&libraries=places&v=weekly"></script>
<script defer="defer">
    

    let placeSearch;
    let autocomplete;

    const componentForm = {
        street_number: "short_name",
        route: "long_name",
        locality: "long_name",
        postal_code: "short_name"
    };

    initAutocomplete = function() {
        autocomplete = new google.maps.places.Autocomplete(
            document.getElementById("parkingStreet"), {
                types: ["geocode"]
            }
        );
        autocomplete.setFields(["address_component"]);
        autocomplete.addListener("place_changed", fillInAddress);
        document.getElementById("parkingStreet").value = '';
    }



    function fillInAddress() {
        var placeData = {
            'street_number': '',
            'route': '',
            'locality': '',
            'postal_code': '',
        }

        const place = autocomplete.getPlace();

        for (const component of place.address_components) {
            const addressType = component.types[0];
            if (componentForm[addressType]) {
                const val = component[componentForm[addressType]];
                placeData[addressType] = val;
            }
        }

        window.livewire.emit('placeChanged', placeData);
    }
    google.maps.event.addDomListener(window, 'load', initAutocomplete);

    initAutocomplete();
    

</script>
