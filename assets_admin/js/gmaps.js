var markers = [];
var marker;

var timestamp;


function getTimestamps() {
    var unix = Math.round(+new Date() / 1000);
    return unix;
}


function myMap() {

    var mapCanvas = document.getElementById('pro-maps_content');

    var myCenter = new google.maps.LatLng(-7.021491, 110.4271556);
    var mapOptions = {
        center: myCenter,
        zoom: 13,
        mapTypeId: 'hybrid'
    };

    var map = new google.maps.Map(mapCanvas, mapOptions);

    google.maps.event.addListener(map, 'click', function (event) {
        var value = placeMarker(map, event.latLng);
    });

    // Create the search box and link it to the UI element.
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function () {
        searchBox.setBounds(map.getBounds());
    });

    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener('places_changed', function () {
        var places = searchBox.getPlaces();
        // console.log(places);

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

            // var icon = {
            //   url: place.icon,
            //   size: new google.maps.Size(71, 71),
            //   origin: new google.maps.Point(0, 0),
            //   anchor: new google.maps.Point(17, 34),
            //   scaledSize: new google.maps.Size(25, 25)
            // };

            // Create a marker for each place.
            marker = new google.maps.Marker({
                map: map,
                // icon: icon,
                title: place.name,
                position: place.geometry.location
            });

            if (marker && marker.setMap()) {
                marker.setMap(null);
            }

            placeMarker(map, place.geometry.location);

            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });

        map.fitBounds(bounds);
    });

    google.maps.event.addDomListener(window, "load", myMap);
}

function placeMarker(map, location) {

    if (marker && marker.setMap()) {
        marker.setMap(null);
    }

    marker = new google.maps.Marker({
        position: location,
        map: map
    });

    var lat = location.lat().toString();
    var lng = location.lng().toString();

    $('#koordinat').val(+lat + ',' + lng);
}
