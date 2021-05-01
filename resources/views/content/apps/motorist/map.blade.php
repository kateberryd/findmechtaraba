@extends('layouts/contentLayoutMaster')

@section('title', 'Mechanic on map')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/maps/leaflet.min.css')) }}">
@endsection

@section('page-style')
 <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/maps/map-leaflet.css')) }}">
@endsection

@section('content')
<section class="maps-leaflet">
  <div class="row">
    <!-- Basic Starts -->
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header">
          <h4 class="card-title">Map</h4>
        </div>
      
        <div class="card-body">
          <div class="leaflet-map" id="basic-map"></div>
        </div>
        <input type="text" value="{{$vendor->longitude}}" id="lon">
        <input type="hidden" value="{{$vendor->latitude}}" id="lat">
      </div>
    </div>
    <!-- /Basic Ends -->

   


</section>
@endsection


<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJLga2AtOFaX13wAzkopq6hISmzv6rdzo&callback=initMap&libraries=&v=weekly"
      async
    ></script>
<script>
    // Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see the error "The Geolocation service
// failed.", it means you probably did not give permission for the browser to
// locate you.
let map, infoWindow;

;

function initMap() {

  let lat = Number(document.getElementById("lat").value)
  let lon = Number(document.getElementById("lon").value)
  map = new google.maps.Map(document.getElementById("basic-map"), {
    center: { lat: lat, lng: lon },
    zoom: 15,
  });
  new google.maps.Marker({
    position: { lat: lat, lng: lon },
    map,
    title: "Hello World!",
  });
  infoWindow = new google.maps.InfoWindow(); 
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: The Geolocation service failed."
      : "Error: Your browser doesn't support geolocation."
  );
  infoWindow.open(map);
}
</script>
@section('vendor-script')
  <!-- vendor files -->
<script src="{{ asset(mix('vendors/js/maps/leaflet.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/maps/map-leaflet.js')) }}"></script>
@endsection
