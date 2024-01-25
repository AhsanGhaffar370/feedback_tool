@extends('front_layout.app')

@section('page_title','| Login')

@section('css')
{{-- Page css files --}}

@endsection

@section('content')




  <!-- LOGIN AREA START -->
  <div class=" mt-5">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="text-center">
                      <h1 class="section-title">Sign into your Account</h1>
                  </div>
              </div>
          </div>
          <div class="row d-flex justify-content-center mt-4">
              <div class="col-lg-6">
                <form method="POST" action="{{ route('login_check') }}" class="ltn__form-box contact-form-box">
                    @csrf
                    @include('alerts')
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input  type="email" class="form-control @error('email') is-invalid @enderror" 
                        name="email" value="{{ old('email') }}"  placeholder="Email*"
                        required autocomplete="email" autofocus
                        id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                      
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input  id="password" type="password" placeholder="Password*" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" 
                        id="exampleInputPassword1" >
                    </div>

                    <p> DON'T HAVE AN ACCOUNT? <a href="{{ route('register') }}">CREATE ACCOUNT</a></p>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>

              </div>
          </div>
      </div>
  </div>
  <!-- LOGIN AREA END -->

@endsection

@section('js')
{{-- Page js files --}}

@endsection
