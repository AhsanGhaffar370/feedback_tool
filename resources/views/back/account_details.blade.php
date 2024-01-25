@extends('back_layout.app')

@section('page_title', '| Register')

@section('css')
  {{-- Page css files --}}

@endsection

@section('content')
  <div>
    <div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url({{ asset('assets/img/curved-images/curved0.jpg') }}); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="{{ Helper::getImg(config('globals.USER_IMAGES_PATH'), $user_details->profile_pic, 'user') }}"
              id="bss_image_preview" alt="..." class="w-100 border-radius-lg shadow-sm">
              {{-- <a href="javascript:;"
                class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Image"></i>
              </a> --}}
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                {{ $user_details->firstname }} {{ $user_details->lastname }} 
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
                {{ $user_details->name }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="card">
        <div class="card-header pb-0 px-3">
          <h6 class="mb-0">{{ __('Profile Information') }}</h6>
        </div>
        <div class="card-body pt-4 p-3">
          <form method="POST" action="{{ route('admin.update.account_details') }}" enctype="multipart/form-data">
            @csrf
            @include('admin_alerts')
            <div class="row">
              <div class="col-md-6">
                <label class="form-control-label">Username</label>
                <input type="text" name="name" value="{{ old('name', $user_details->name) }}" 
                  class="form-control" placeholder="Username">
              </div>
              <div class="col-md-6">
                <label class="form-control-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $user_details->email) }}" 
                  class="form-control" placeholder="Email">
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  {{-- Page js files --}}

@endsection
