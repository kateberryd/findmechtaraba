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
      </div>
    </div>
    <!-- /Basic Ends -->

   


</section>
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/maps/leaflet.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/maps/map-leaflet.js')) }}"></script>
@endsection
