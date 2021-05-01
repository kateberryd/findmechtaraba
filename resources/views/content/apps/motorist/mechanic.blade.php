@extends('layouts/contentLayoutMaster')

@section('title', 'Nearest Mechanics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset(mix('vendors/css/charts/apexcharts.css'))}}">
@endsection
@section('page-style')
<link rel="stylesheet" href="{{asset(mix('css/base/pages/app-chat-list.css'))}}">
@endsection

@section('content')
<!-- Card Advance -->
<div class="row match-height">
  

  <!-- Apply Job Card -->
  
  <div class="col-lg-4 col-md-6 col-12">
    <div class="card card-apply-job">
      <div class="card-body">
      @if($vendors != null)
        @foreach($vendors as $vendor)
        @if($vendor->user_role == 'vendor')
          <div class="d-flex justify-content-between align-items-center mb-1">
          <div class="media">
            <div class="avatar mr-1">
              <img
                src="/uploads/{{$vendor->shop_image}}"
                alt="Avatar"
                width="42"
                height="42"
              />
            </div>
            <div class="media-body">
              <h5 class="mb-0">{{$vendor->first_name}} {{$vendor->last_name}}</h5>
              <small class="text-muted">{{date('d-m-Y', strtotime($vendor->created_at))}}</small>
            </div>
          </div>
          <div class="badge badge-pill badge-light-primary"></div>
        </div>
             <h5 class="apply-job-title">{{$vendor->company_name}}.</h5>
            <p class="card-text mb-2">
            {{$vendor->company_address}}
            {{$vendor->phone_number}}
            </p>
        
        <a href="/users/map/{{$vendor->id}}" class="btn btn-primary btn-block">View Map</a>
        @endif
      @endforeach
      @else
      <h2 class="h4">No nearest mechanics</h2>

      @endif
      </div>
    </div>
  </div>
 
</div>
@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/charts/apexcharts.min.js'))}}"></script>
@endsection
@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/cards/card-advance.js')) }}"></script>
@endsection
