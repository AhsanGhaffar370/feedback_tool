@extends('front.layout.app')

@section('page_title','| Login')

@section('css')
{{-- Page css files --}}

@endsection

@section('content')

<div class="ltn__utilize-overlay"></div>

    <!-- BREADCRUMB AREA START -->
    <div class="ltn__breadcrumb-area ltn__breadcrumb-area-2 ltn__breadcrumb-color-white bg-overlay-theme-black-90 bg-image" data-bs-bg="{{ asset('front/img/bg/9.jpg') }}">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="ltn__breadcrumb-inner ltn__breadcrumb-inner-2 justify-content-between">
                      <div class="section-title-area ltn__section-title-2">
                          <h6 class="section-subtitle ltn__secondary-color">//  Welcome to our company</h6>
                          <h1 class="section-title white-color">Reset Password</h1>
                      </div>
                      <div class="ltn__breadcrumb-list">
                          <ul>
                              <li><a href="{{ route('home') }}">Home</a></li>
                              <li>Reset Password</li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- BREADCRUMB AREA END -->

  <!-- LOGIN AREA START -->
  <div class="ltn__login-area pb-65">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="section-title-area text-center">
                      <h1 class="section-title">Reset Password</h1>
                  </div>
              </div>
          </div>
          <div class="row d-flex justify-content-center">
              <div class="col-lg-6">
                  <div class="account-login-inner">
                      <form method="POST" action="{{ route('password.email') }}" class="ltn__form-box contact-form-box">
                        @csrf
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="mb-3">
                          <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>

                          <div class="">
                              <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                              @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>

                          <div class="btn-wrapper mt-0">
                              <button class="theme-btn-1 btn btn-block w-100" type="submit">Send Password Reset Link</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- LOGIN AREA END -->

@endsection

@section('js')
{{-- Page js files --}}

@endsection









