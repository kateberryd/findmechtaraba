@php
$configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Login ')

@section('page-style')
  {{-- Page Css files --}}
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
          <img class="img-fluid" src="{{asset('images/pages/illus1.png')}}" alt="Login V2" />
          @else
          <img class="img-fluid" src="{{asset('images/pages/illus1.png')}}" alt="Login V2" />
          @endif
        </div>
      </div>
      <!-- /Left Text-->
      <!-- Login-->
      <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
              <div class="row">
                @include('layouts.messages')
            </div>
          <h4 class="card-title mb-1">Welcome to FindMechanic! &#x1F44B;</h4>
          <form class="auth-login-form mt-2" action="{{route('login.post')}}" method="POST">
          @csrf
            <div class="form-group">
              <label class="form-label" for="login-email">Email</label>
              <input class="form-control" id="login-email" type="text" name="email" placeholder="john@example.com" aria-describedby="login-email" autofocus="" tabindex="1" />
              <small class="text-danger">{{$errors->first('email')}}</small>

            </div>
            <div class="form-group">
              <div class="d-flex justify-content-between">
                <label for="login-password">Password</label>
                <a href="{{url("auth/forgot-password-v2")}}">
                  <small>Forgot Password?</small>
                </a>
              </div>
              <div class="input-group input-group-merge form-password-toggle">
                <input class="form-control form-control-merge" id="password" type="password" name="password" placeholder="············" aria-describedby="login-password" tabindex="2" />
                <div class="input-group-append">
                  <span class="input-group-text cursor-pointer">
                    <i data-feather="eye"></i>
                  </span>
                </div>
              </div>
              <small class="text-danger">{{$errors->first('password')}}</small>
            </div>
            <div class="form-group">
              <div div class="custom-control custom-checkbox">
                <input class="custom-control-input" id="remember-me" type="checkbox" tabindex="3" />
                <label class="custom-control-label" for="remember-me">Remember Me</label>
              </div>
            </div>
            <button class="btn btn-primary btn-block" tabindex="4">Sign in</button>
          </form>
          <p class="text-center mt-2">
            <span>New on our platform?</span>
            <a href="{{url('auth/register')}}"><span>&nbsp;Create an account</span></a>
          </p>
          <div class="divider my-2">
            <div class="divider-text">or</div>
          </div>
         
      </div>
    </div>
    <!-- /Login-->
  </div>
</div>
@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
<script src="{{asset(mix('js/scripts/pages/page-auth-login.js'))}}"></script>
@endsection
