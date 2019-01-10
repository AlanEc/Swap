
import $ from 'jquery';
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.css';

require('../css/app.css');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip();

    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);

    if (document.getElementById('map') == null) {
        searchBox.addListener('places_changed', function () {
            var place = document.getElementById("pac-input").value;
            window.location.href = "/search/" ;
        });
    }
});


