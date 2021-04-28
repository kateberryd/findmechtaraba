@extends('layouts/contentLayoutMaster')

@section('title', 'Profile')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-profile.css')) }}">
@endsection

@section('content')
<div id="user-profile">
  <!-- profile header -->
  <div class="row">
    <div class="col-12">
      <div class="card profile-header mb-2">
        <!-- profile cover photo -->
        <img
          class="card-img-top"
          src="{{ $user->shop_image == null ? asset('images/profile/user-uploads/timeline.jpg')  :  asset('/uploads/'.$user->shop_image)}}"
          alt="User Profile Image"
          height="200"
        />
        <!--/ profile cover photo -->

        <div class="position-relative">
          <!-- profile picture -->
          <div class="profile-img-container d-flex align-items-center">
            <div class="profile-img">
              <img
                src="{{asset('images/banner/shop.jpg')}}"
                class="rounded img-fluid"
                alt="Card image"
              />
            </div>
            <!-- profile title -->
            <div class="profile-title ml-3">
              <h2 class="text-white">{{$user->first_name}} {{$user->last_name}}</h2>
              <p class="text-white">{{$user->company_name}}</p>
            </div>
          </div>
        </div>

        <!-- tabs pill -->
        <div class="profile-header-nav">
          <!-- navbar -->
          <nav class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">
            <button
              class="btn btn-icon navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <i data-feather="align-justify" class="font-medium-5"></i>
            </button>

            <!-- collapse  -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <div class="profile-tabs d-flex justify-content-between flex-wrap mt-1 mt-md-0">
         
                <!-- edit button -->
                <a href="/dashboard/account-settings/" class="btn btn-primary">
                  <i data-feather="edit" class="d-block d-md-none"></i>
                  <span class="font-weight-bold d-none d-md-block">Edit</span>
                </a>
              </div>
            </div>
            <!--/ collapse  -->
          </nav>
          <!--/ navbar -->
        </div>
      </div>
    </div>
  </div>
  <!--/ profile header -->

  <!-- profile info section -->
  <section id="profile-info">
    <div class="row">
      <!-- left profile info section -->
      <div class="col-lg-12 col-12 order-2 order-lg-1">
        <!-- about -->
        <div class="card">
          <div class="card-body">
           
            <div class="mt-2 row">
            <div class="col-md-3">
            <h5 class="mb-75">Joined:</h5>

            </div>
            <div class="col-md-3">
            <p class="card-text">{{date('d-m-Y', strtotime($user->created_at))}}</p>

            </div>
            </div>
            <div class="mt-2 row">
             <div class="col-md-3">
             <h5 class="mb-75">Company Name:</h5>
             </div>
             <div class="col-md-3">
             <p class="card-text">{{$user->company_name}}</p>
             </div>
            </div>
            <div class="mt-2 row">
              <div class="col-md-3">
              <h5 class="mb-75">Company Address:</h5>
              </div>
              <div class="col-md-3">
              <p class="card-text">{{$user->company_address}}</p>

              </div>
            </div>
            <div class="mt-2 row">
            <div class="col-md-3">
               <h5 class="mb-75">First Name:</h5>
            </div>
            <div class="col-md-4">
              <p class="card-text">{{$user->first_name}}</p>
            </div>
            </div>
            <div class="mt-2 row">
              <div class="col-md-3">
                <h5 class="mb-75">Last Name:</h5>
              </div>
             <div class="col-md-3"> <p class="card-text">{{$user->last_name}}</p></div>
            </div>
            <div class="mt-2 row">
              <div class="col-md-3">
              <h5 class="mb-75">Email:</h5>

              </div>
              <div class="col-md-3">
                <p class="card-text">{{$user->email}}</p>

              </div>
            </div>
            <div class="mt-2 row">
              <div class="col-md-3">
              <h5 class="mb-50">Phone Number:</h5>

              </div>
              <div class="col-md-3">
              <p class="card-text mb-0">{{$user->phone_number}}</p>
              </div>
            </div>
            <div class="mt-2 row">
              <div class="col-md-3">
              <h5 class="mb-50">State:</h5>
              </div>
              <div class="col-md-3">
                <p class="card-text mb-0">{{$user->state}}</p>

              </div>
            </div>
            <div class="mt-2 row">
             <div class="col-md-3">
             <h5 class="mb-50">City:</h5>
             </div>
             <div class="col-md-3">
             <p class="card-text mb-0">{{$user->city}}</p>

             </div>
            </div>
          </div>
        </div>
        <!--/ about -->



       
              <!--/ avatar group with tooltips-->
            </div>
            <!--/ polls -->
          </div>
        </div>
        <!--/ polls card -->
      </div>
      <!--/ right profile info section -->
    </div>
    <!-- reload button -->
  </section>
  <!--/ profile info section -->
</div>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/pages/page-profile.js')) }}"></script>
@endsection
