var sidebarDisplay = false;

function initMap() {
  hideBackground();

  var princeton = {lat: 40.3474393, lng: -74.657609};
  // Note: This example requires that you consent to location sharing when
  // prompted by your browser. If you see the error "The Geolocation service
  // failed.", it means you probably did not give permission for the browser to
  // locate you.
  var map;
  map = new google.maps.Map(document.getElementById('map'), {
    zoomControl: true,
    zoomControlOptions: {
      position: google.maps.ControlPosition.LEFT_BOTTOM
    },
    mapTypeControl: false,
    scaleControl: false,
    streetViewControl: false,
    rotateControl: true,
    fullscreenControl: false,
    center: princeton,
    zoom: 15,
    minZoom: 5,
    styles: [
      {
        "featureType": "landscape.man_made",
        "elementType": "geometry",
        "stylers": [
          {
            "color": "#f7f1df"
          }
        ]
      },
      {
        "featureType": "landscape.natural",
        "elementType": "geometry",
        "stylers": [
          {
            "color": "#d0e3b4"
          }
        ]
      },
      {
        "featureType": "landscape.natural.terrain",
        "elementType": "geometry",
        "stylers": [
          {
            "visibility": "off"
          }
        ]
      },
      {
        "featureType": "poi",
        "elementType": "labels",
        "stylers": [
          {
            "visibility": "on"
          }
        ]
      },
      {
        "featureType": "poi.business",
        "elementType": "all",
        "stylers": [
          {
            "visibility": "on"
          }
        ]
      },
      {
        "featureType": "poi.medical",
        "elementType": "geometry",
        "stylers": [
          {
            "color": "#fbd3da"
          }
        ]
      },
      {
        "featureType": "poi.park",
        "elementType": "geometry",
        "stylers": [
          {
            "color": "#bde6ab"
          }
        ]
      },
      {
        "featureType": "road",
        "elementType": "geometry.stroke",
        "stylers": [
          {
            "visibility": "on"
          }
        ]
      },
      {
        "featureType": "road",
        "elementType": "labels",
        "stylers": [
          {
            "visibility": "off"
          }
        ]
      },
      {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
          {
            "color": "#ffe15f"
          }
        ]
      },
      {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [
          {
            "color": "#efd151"
          }
        ]
      },
      {
        "featureType": "road.arterial",
        "elementType": "geometry.fill",
        "stylers": [
          {
            "color": "#ffffff"
          }
        ]
      },
      {
        "featureType": "road.local",
        "elementType": "geometry.fill",
        "stylers": [
          {
            "color": "black"
          }
        ]
      },
      {
        "featureType": "transit.station.airport",
        "elementType": "geometry.fill",
        "stylers": [
          {
            "color": "#cfb2db"
          }
        ]
      },
      {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
          {
            "color": "#a2daf2"
          }
        ]
      }
    ],
  });

  geocoder = new google.maps.Geocoder();

  var iconBase = '';
        var icons = {
          ANI: {
            icon: iconBase + './icons/015-animals.png'
          },
          ENV: {
            icon: iconBase + './icons/013-plant.png'
          },
          EDU: {
            icon: iconBase + './icons/007-books.png'
          },
          CPU: {
            icon: iconBase + './icons/009-imac.png'
          },
          MED: {
            icon: iconBase + './icons/012-medical.png'
          },
          HOM: {
            icon: iconBase + './icons/006-real-estate.png'
          },
          CHD: {
            icon: iconBase + './icons/003-teddy-bear.png'
          }
        };

  // Create the search box and link it to the UI element.
  var input = document.getElementById('pac-input');
  var searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  var markers = [];
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
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
      /* markers.push(new google.maps.Marker({
        map: map,
        icon: icon,
        title: place.name,
        position: place.geometry.location
      }));
      */
      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });

  var event_ids;

  $.ajax({
    async: false,
    url: "http://10.25.53.76/scripts/get_all_events.php",
    success: function(data) {
      event_ids = data.split(",");
    },
  });

  console.log(event_ids);

  for (i = 0; i < event_ids.length; i++) {

    (function () {
      let event_id = event_ids[i];
      var resp_temp;
      var data_temp;
      $.ajax({
        async: false,
        url: "http://10.25.53.76/scripts/get_event_data.php?id=" + event_id,
        success: function(resp) {
          resp_temp = JSON.parse(resp);
          console.log(resp_temp["data"]);
          data_temp = JSON.parse(resp_temp["data"]);
        }
      });

      var cat = data_temp["category"];

      var event_mark = new google.maps.Marker({
        position: {lat: parseFloat(data_temp["lat"]), lng: parseFloat(data_temp["long"])},
        icon: icons[cat].icon,
        map: map,
        title: data_temp["name"]
      });

      event_mark.addListener('click', function() {
        map.setZoom(15);
        map.setCenter(event_mark.getPosition());
        updateSidebar(resp_temp);
      });

    })();

  }

}

function updateSidebar(resp_temp) {
  showBackground();

  let name = resp_temp["name"];
  let org_id = resp_temp["organization"];
  var org_name;
  $.ajax({
    async: false,
    url: "http://10.25.53.76/scripts/get_org_data.php?id=" + org_id,
    success: function(response) {
      org_info = JSON.parse(response);
      org_name = org_info["name"];
    }
  });

  let date = resp_temp["date"];
  let attendees = resp_temp["users"];

  let raw_data = JSON.parse(resp_temp["data"]);
  let lat = parseFloat(raw_data["lat"]);
  let lng = parseFloat(raw_data["long"]);
  let start = raw_data["start"];
  let end = raw_data["end"];
  let desc = raw_data["description"];

  $("#event-title").html(name);
  $("#event-org").html(org_name);
  $("#event-date").html(date);
  $("#event-start").html(start);
  $("#event-end").html(end);
  $("#event-description").html(desc);
  $("#event-divider").css("visibility", "visible")
  $("#event-table").css("visibility", "visible")
  codeLatLng(lat,lng);
}


function codeLatLng(lat, lng) {
  var latlng = new google.maps.LatLng(lat, lng);
  geocoder.geocode({
    'latLng': latlng
  }, function (results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      if (results[1]) {
        $("#event-loc").html(results[1].formatted_address);
      } else {
        return "Exact address not found";
      }
    } else {
      return "Exact address not found";
    }
  });
}

function toggleBackground() {
  sidebarDisplay = !sidebarDisplay;

  if (sidebarDisplay)
    showBackground();
  else
    hideBackground();
}

function hideBackground() {
  sidebarDisplay = false;
  $("nav").css("box-shadow", "none");
  $("nav").css("background-color", "#00000000");
  $("nav").css("overflow-y", "hidden");
  $("#event-table").css("visibility", "hidden");
  $("#infobox").css("visibility", "hidden");
}

function showBackground() {
  sidebarDisplay = true;
  $("nav").css("background-color", "#ffffff");
  $("nav").css("box-shadow", "-5px 0px 15px #aaa");
  $("nav").css("overflow-y", "scroll");
  $("#infobox").css("visibility", "visible");
  $("#event-table").css("visibility", "visible");
}
