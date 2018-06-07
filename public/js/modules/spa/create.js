$(function(){
  $(".form-control.time-mask").inputmask('h:s - h:s', {placeholder: 'hh:mm - hh:mm'});
  $('.summernote').summernote({
    height: 600,
    placeholder: 'Description',
    onChange: function(contents, $editable) {
      $(this).val(contents);
    }
  });

  $('.summernote-simple').summernote({
    height: 200,
    toolbar: [
      // [groupName, [list of button]]
      ['style', ['bold', 'italic', 'underline', 'clear']],
      ['font', ['strikethrough', 'superscript', 'subscript']],
      ['fontsize', ['fontsize']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['height', ['height']]
    ],
    onChange: function(contents, $editable) {
      $(this).val(contents);
    }
  });

  var map;
  var marker;
  var posisi = {
    lat: $('#lat').val(),
    lng: $('#lng').val()
  };

  initMap = function() {
    var latLng = new google.maps.LatLng(posisi.lat, posisi.lng);
    map = new google.maps.Map(document.getElementById('map'), {
      center: latLng,
      zoom: 9,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    addMarker(latLng);

    google.maps.event.addListener(map, 'click', function(event){
      if (marker) {
          marker.setMap(null);
          marker = null;
       }

       $('#lat').val(event.latLng.lat);
       $('#lng').val(event.latLng.lng);

      marker = addMarker(event.latLng);
    });

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
}

  addMarker = function(latLang){
      marker = new google.maps.Marker({
        map: map,
        animation: google.maps.Animation.DROP,
        position: latLang
      });
      let content = `<b>Location</b><br />` + latLang;
      addInfoWindow(marker, content);
      return marker;
  }

  addInfoWindow = function(marker, content){
      infoWindow = new google.maps.InfoWindow({
        content: content,
        maxWeight: 600
      });
      google.maps.event.addListener(marker, 'click', (event) => {
        infoWindow.open(map, marker);
      });
  }

  $('[name="seo_title"]').keyup(function(){
    var text = $(this).val();
    var panjang = 50 - text.length;
    if(panjang < 1)
      $('.info_lenght_title').css('color', 'red');
    else
      $('.info_lenght_title').css('color', '#333');

    $('.lenght_seo_title').html(panjang);
  });

  $('[name="seo_description"]').keyup(function(){
    var text = $(this).val();
    var panjang = 160 - text.length;
    if(panjang < 1)
      $('.info_lenght_desc').css('color', 'red');
    else
      $('.info_lenght_desc').css('color', '#333');

    $('.length_seo_desc').html(panjang);
  });

});
