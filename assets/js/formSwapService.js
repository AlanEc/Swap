require('../css/formSwapService.css');

$(document).ready(function() {

    var input = document.getElementById('swap_service_form_adress_1');
    var autocomplete = new google.maps.places.Autocomplete(input);

    google.maps.event.addListener(autocomplete, 'place_changed', function(event) {
        var locality = [];

        var place = autocomplete.getPlace();
        document.getElementById('swap_service_form_longitude').value = place.geometry.location.lat();
        document.getElementById('swap_service_form_latitude').value = place.geometry.location.lng();

        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];

            console.log(place);
            if (addressType == "country") {
                document.getElementById('swap_service_form_country').value = place.address_components[i].long_name;
            }

            if (addressType == "locality") {
                locality += place.address_components[i].long_name;
            }

            if (addressType == "postal_code") {
                document.getElementById('swap_service_form_postal_code').value = place.address_components[i].long_name;
            }

            if (addressType == "administrative_area_level_1") {
                document.getElementById('swap_service_form_region').value = place.address_components[i].long_name;
            }

            if (i == place.address_components.length - 1) {
                if (locality != null) {
                    document.getElementById('swap_service_form_city').value = locality;
                } else {
                    document.getElementById('swap_service_form_city').value = '';
                }
            }
        }
    });
});