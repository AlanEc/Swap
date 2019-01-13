
import $ from 'jquery';
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.css';

require('../css/app.css');
$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip();

    var input = document.getElementById('pac-input');
    var autocomplete = new google.maps.places.Autocomplete(input);

    if (document.getElementById('map') == null) {
        google.maps.event.addListener(autocomplete, 'place_changed', function(event) {
            var place = autocomplete.getPlace();
            sessionStorage.setItem('lat', place.geometry.location.lat());
            sessionStorage.setItem('lng', place.geometry.location.lng());
            console.log(place.geometry.location.lat());
            //var place = document.getElementById("pac-input").value;
            window.location.href = "/search/" ;
        });
    }
});


