import 'flexslider'
import 'gasparesganga-jquery-loading-overlay'

require('../css/searchSwapService.css');

$(document).ready(function() {

        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);

        var lat = parseFloat(sessionStorage.getItem('lat'));
        var lng = parseFloat(sessionStorage.getItem('lng'));

        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: lat, lng: lng},
            zoom: 5,
            mapTypeId: 'roadmap'
        });

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function () {
            searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function () {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            // Clear out the old markers.
            markers.forEach(function (marker) {
                marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function (place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };

                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });

        google.maps.event.addListener(map, 'idle', function() {
            deleteMarkers();
            removeElement();

            console.log('hey');

            var bounds = map.getBounds();
            var swPoint = bounds.getSouthWest();
            var nePoint = bounds.getNorthEast();

            var swLat = swPoint.lat();
            var swLng = swPoint.lng();
            var neLat = nePoint.lat();
            var neLng = nePoint.lng();

            var dataJson = {
                'swlat': swLat,
                'swlng': swLng,
                'nelat': neLat,
                'nelng': neLng
            };

            var marker = [];

            $.LoadingOverlay("show");

            $.ajax({
                url : 'ajax_search',
                type : 'POST',
                dataType: 'json',
                data : dataJson,
                success :function(data) {
                    console.log(data);
                    for ( var i=0; i<data.length; i++){
                        $('#resultSearch').append('<div class="panel panel-default ' + i + ' "><div class="row">' +
                            '<div class= col-md-3 ">' + data[i]['User'] + '</div>' +
                            '<div class="col-md-5 ">' + data[i]['Category'] + '</br>' +
                            '<p>Nombre de personne:' + data[i]['Quantity'] + '</p></div>' +
                            '<div class="col-md-3 "><a href="booking/new/' +  data[i]['Id'] + '">Voir le Swap</a></div></div></div>');
                        //$('#resir le Swap</a></div></div><b>Nom</b> : ' + data[i]['Latitude'] + '</div>');
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(data[i]['Latitude'], data[i]['Longitude']),
                            map: map
                        });
                        markers.push(marker);
                    }
                },
                complete: function() {
                    $.LoadingOverlay("hide");
                }
            });
        });

        // Deletes all markers in the array by removing references to them.
        function deleteMarkers() {
            clearMarkers();
            markers = [];
        }

        // Removes the markers from the map, but keeps them in the array.
        function clearMarkers() {
            setMapOnAll(null);
        }

        // Sets the map on all markers in the array.
        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }

        function removeElement() {
            // Removes an element from the document
            var element = document.getElementsByClassName('panel');
            var element1 = document.getElementById('resultSearch');
            while (element1.firstChild) {
                element1.removeChild(element1.firstChild);
            }
        }
});

