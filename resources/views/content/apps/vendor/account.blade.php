@extends('layouts/contentLayoutMaster')

@section('title', 'Account Settings')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel='stylesheet' href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel='stylesheet' href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<!-- account setting page -->
<section id="page-account-settings">
  <div class="row">
    <!-- left menu section -->
    <div class="col-md-3 mb-2 mb-md-0">
      <ul class="nav nav-pills flex-column nav-left">
        <!-- general -->
        <li class="nav-item">
          <a
            class="nav-link active"
            id="account-pill-general"
            data-toggle="pill"
            href="#account-vertical-general"
            aria-expanded="true"
          >
            <i data-feather="user" class="font-medium-3 mr-1"></i>
            <span class="font-weight-bold">General</span>
          </a>
        </li>

       
      
   
      </ul>
    </div>
    <!--/ left menu section -->

    <!-- right content section -->
    <div class="col-md-9">
      <div class="card">
        <div class="card-body">
          <div class="row">
             @include('layouts.messages')
          </div>
          <div class="tab-content">
            <!-- general tab -->
            <div
              role="tabpanel"
              class="tab-pane active"
              id="account-vertical-general"
              aria-labelledby="account-pill-general"
              aria-expanded="true"
            >
              <!-- header media -->
              <div class="media">
                <a href="javascript:void(0);" class="mr-25">
                  <img
                    src="{{ $user->shop_image == null ? asset('images/banner/shop.jpg') :  asset('/uploads/'.$user->shop_image) }}"
                    id="account-upload-img"
                    class="rounded mr-50"
                    alt="profile image"
                    height="80"
                    width="80"
                  />
                </a>
                <form class=" mt-2" action="{{route('account-setttings.post')}}" method="POST"  enctype="multipart/form-data">

                <!-- upload and reset button -->
                <div class="media-body mt-75 ml-1">
                  <label for="account-upload" class="btn btn-sm btn-primary mb-75 mr-75">Upload</label>
                  <input type="file" id="account-upload" hidden accept="image/*" name="shop_image" />
                  <button class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                  <p>Allowed JPG, GIF or PNG. Max size of 800kB</p>
                </div>
                <small class="text-danger">{{$errors->first('shop_image')}}</small>

                <!--/ upload and reset button -->
              </div>
              <!--/ header media -->

              <!-- form -->
                 @csrf
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-username">First Name</label>
                      <input
                        type="text"
                        class="form-control"
                        id="account-username"
                        name="first_name"
                        placeholder="First Name"
                      />
                    </div>
                    <small class="text-danger">{{$errors->first('first_name')}}</small>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-name">Last Name</label>
                      <input
                        type="text"
                        class="form-control"
                        id="last_name"
                        name="last_name"
                        placeholder="Last Name"
                      />
                    </div>
                    <small class="text-danger">{{$errors->first('last_name')}}</small>

                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-e-mail">E-mail</label>
                      <input
                        type="email"
                        class="form-control"
                        id="account-e-mail"
                        name="email"
                        placeholder="Email"
                        value="{{$user->email}}"
                      />
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-company">Phone Number</label>
                      <input
                        type="text"
                        class="form-control"
                        id="account-company"
                        name="phone_number"
                        placeholder="Phone Number"
                      />
                    </div>
                    <small class="text-danger">{{$errors->first('phone_number')}}</small>

                  </div>
                  
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-company">Company</label>
                      <input
                        type="text"
                        class="form-control"
                        id="account-company"
                        name="company_name"
                        placeholder="Company name"
                      />
                    </div>
                    <small class="text-danger">{{$errors->first('company_name')}}</small>

                  </div>  
                  
                  <div class="col-12 col-sm-6">
                    <div class="form-group">
                      <label for="account-company">Company Address</label>
                      <input
                        type="text"
                        class="form-control"
                        id="account-company"
                        name="company_address"
                        placeholder="Company Address"
                      />
                    </div>
                    <small class="text-danger">{{$errors->first('company_address')}}</small>

                  </div>  
              
                </div>
                <div class="col-12">
                  </div>
                  <button type="submit" class="btn btn-primary mt-2 mr-1">Save changes</button>

              </form>
            </div>
           
          </div>
        </div>
      </div>
    </div>
    <!--/ right content section -->
  </div>
</section>
<!-- / account setting page -->
@endsection

@section('vendor-script')
  <!-- vendor files -->
  {{-- select2 min js --}}
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  {{--  jQuery Validation JS --}}
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/dropzone.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/page-account-settings.js')) }}"></script>
@endsection
