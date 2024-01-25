@extends('back_layout.app')

@section('page_title','| Login')

@section('css')
{{-- Page css files --}}

@endsection

@section('content')
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                </div>
                <div class="card-body">
                  <form method="POST" action="{{ route('login_check') }}" class="ltn__form-box contact-form-box">
                    @csrf
                    @include('alerts')
                    <label>Email</label>
                    <div class="mb-3">
                      <input type="email" class="form-control @error('email') is-invalid @enderror" 
                      name="email" value="{{ old('email') }}"  placeholder="Email*"
                      required autocomplete="email" autofocus>
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input id="password" type="password" placeholder="Password*" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url({{ asset('assets/img/curved-images/curved6.jpg') }})"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>


  @endsection

  @section('js')
  {{-- Page js files --}}
  
  @endsection
  