@extends('front.layout.app')

@section('page_title','| Register')

@section('css')
{{-- Page css files --}}

@endsection

@section('content')

  <section class="min-vh-100 mb-1 mt-5">
    
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10">
        <div class="col-xl-8 col-lg-8 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              <h5>Register Account</h5>
            </div>
            
            <div class="card-body">
              <form role="form text-left" method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="mb-3">
                  <label >Name</label>
                  <input id="name" type="text"
                  placeholder="Name" class="form-control @error('name') is-invalid @enderror" 
                  name="name" value="{{ old('name') }}" required autocomplete="name">

                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label >Email</label>
                  <input id="email" type="email"
                  placeholder="Email" class="form-control @error('email') is-invalid @enderror" 
                  name="email" value="{{ old('email') }}" required autocomplete="email">

                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                
                <div class="mb-3">
                  <label >Password</label>
                  <input id="password" type="password" 
                  placeholder="Password" class="form-control @error('password') is-invalid @enderror" 
                  name="password" required autocomplete="new-password">

                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label >Confirm Password</label>
                  <input id="password-confirm" type="password"
                  placeholder="Confirm Password" class="form-control" name="password_confirmation" 
                  required autocomplete="new-password">
                </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary w-100 my-4 mb-2">Sign up</button>
                </div>
                <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Sign in</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  @endsection

  @section('js')
  {{-- Page js files --}}
  
  @endsection
  

