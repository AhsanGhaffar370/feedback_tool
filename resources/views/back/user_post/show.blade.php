@extends('back_layout.app')

@section('page_title', '| Register')

@section('css')
  {{-- Page css files --}}

@endsection

@section('content')
    <div class="container-fluid py-4">
      <div class="card">
        <div class="card-header pb-0 px-3">
          <h6 class="mb-0">{{ __('View User Post') }}</h6>
        </div>
        <div class="card-body pt-4 p-3">
          <form method="POST" action="{{ route('admin.update.account_details') }}" enctype="multipart/form-data">
            @csrf
            @include('admin_alerts')
            <div class="mt-3">
              <label >Title<span class="text-danger">*</span></label>
              <input type="text"
              placeholder="Title" class="form-control" 
              name="title" value="{{ old('title',$user_post->title) }}" 
              disabled required>
            </div>
            <div class="mt-3">
              <label >Make<span class="text-danger">*</span></label>
              <input type="text"
              placeholder="make" class="form-control" 
              name="make" value="{{ old('make',$user_post->make) }}" 
              disabled required>
            </div>
            <div class="mt-3">
              <label >Model<span class="text-danger">*</span></label>
              <input type="text"
              placeholder="model" class="form-control" 
              name="model" value="{{ old('model',$user_post->model) }}" 
              disabled required>
            </div>
            <div class="mt-3">
              <label >Year<span class="text-danger">*</span></label>
              <input type="text"
              placeholder="year" class="form-control" 
              name="year" value="{{ old('year',$user_post->year) }}" 
              disabled required>
            </div>
            <div class="mt-3">
              <label >Service Looking For<span class="text-danger">*</span></label>
              <input type="text"
              placeholder="Title" class="form-control" 
              name="service_type_id" value="{{ old('service_type_id',$user_post->serviceType->name) }}" 
              disabled required>
            </div>
            <div class="mt-3">
              <label >Description<span class="text-danger">*</span></label>
              <div class="p-3 border border-secondary rounded bg-light">
                {!! old('long_desc',$user_post->long_desc) !!}
              </div>
            </div>
            <div class="mt-3">
              <label >Video</label>
              @if($user_post->video != null)
              <div class="mb-3">
                  <video width="500" height="500" class="img-thumbnail img-fluid" controls>
                    <source src="{{ Helper::getImg(config('globals.USER_POST_IMAGES_PATH'), $user_post->video) }}">
                  </video>
              </div>
              @else
              <p>No Video Available</p>
              @endif
            </div>
            <div class="mt-3">
              <label >Post Images<span class="text-danger">*</span></label>
              <div class=" m-1 p-2 border border-secondary rounded">
                <div class="row m-0">
                @foreach($user_post->images as $user_post_image)
                  <div class="col-4 mb-1 p-1">
                    <img 
                    src="{{ Helper::getImg(config('globals.USER_POST_IMAGES_PATH'), $user_post_image->name) }}"
                    id="bss_image_preview"
                    class="img-thumbnail img-fluid"
                    alt="Post Image"
                    >
                  </div>
                @endforeach
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection

@section('js')
  {{-- Page js files --}}

@endsection
