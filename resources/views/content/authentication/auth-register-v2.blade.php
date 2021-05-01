@php
$configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Register Page')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">

  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection

@section('content')
<div class="auth-wrapper auth-v2">
  <div class="auth-inner row m-0">
    <!-- Brand logo-->
    <a class="brand-logo" href="javascript:void(0);">
      <h2 class="brand-text text-primary ml-1">FindMechanic Wukari</h2>
    </a>
    <!-- /Brand logo-->
    <!-- Left Text-->
    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
      <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
        @if($configData['theme'] === 'dark')
        <img class="img-fluid" src="{{asset('images/pages/register-v2-dark.svg')}}" alt="Register V2" />
        @else
        <img class="img-fluid" src="{{asset('images/pages/register-v2.svg')}}" alt="Register V2" />
        @endif
      </div>
    </div>
      <!-- /Left Text-->
      <!-- Register-->
    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
      <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
      @include('layouts.messages')

        <p class="card-text mb-2">Create an Account!</p>
        <form class="auth-register-form mt-2" action="{{route('register.post')}}" method="POST">
          @csrf

          <div class="form-group">
            <label class="form-label" for="register-email">Email</label>
            <input class="form-control" id="register-email" type="text" name="email" placeholder="john@example.com" aria-describedby="register-email" tabindex="2" />
            <small class="text-danger">{{$errors->first('email')}}</small>

          </div>
          
          <div class="form-group">
            <label for="customSelect">What are you?</label>
            <select class="custom-select" id="customSelect" name="user_role">
              <option selected>select......</option>
              <option value="vendor">Mechanic</option>
              <option value="user">Motorist</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label" for="register-password">Password</label>
            <div class="input-group input-group-merge form-password-toggle">
              <input class="form-control form-control-merge" id="register-password" type="password" name="password" placeholder="············" aria-describedby="register-password" tabindex="3" />
              <div class="input-group-append">
                <span class="input-group-text cursor-pointer">
                  <i data-feather="eye"></i>
                </span>
              </div>
            </div>
            <small class="text-danger">{{$errors->first('password')}}</small>
          </div>
          <div class="form-group">
            <label class="form-label" for="register-password">Confirm Password</label>
            <div class="input-group input-group-merge form-password-toggle">
              <input class="form-control form-control-merge" id="register-password" type="password" name="confirm_password" placeholder="············" aria-describedby="register-password" tabindex="3" />
              <div class="input-group-append">
                <span class="input-group-text cursor-pointer">
                  <i data-feather="eye"></i>
                </span>
              </div>
            </div>
            <small class="text-danger">{{$errors->first('confirm_password')}}</small>
          </div>
          <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input" id="register-privacy-policy" type="checkbox" tabindex="4" />
              <label class="custom-control-label" for="register-privacy-policy">I agree to<a href="javascript:void(0);">&nbsp;privacy policy & terms</a></label>
            </div>
          </div>
          <button class="btn btn-primary btn-block" tabindex="5">Sign up</button>
        </form>
        <p class="text-center mt-2">
          <span>Already have an account?</span>
          <a href="{{url('/auth/login')}}"><span>&nbsp;Sign in instead</span></a>
        </p>
       
      </div>
    </div>
  <!-- /Register-->
  </div>
</div>
@endsection

@section('vendor-script')
<script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>

<script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>

<script src="{{asset('js/scripts/pages/page-auth-register.js')}}"></script>
@endsection
