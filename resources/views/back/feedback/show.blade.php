@extends('front_layout.app')

@section('page_title','| Feedback View')

@section('css')
{{-- Page css files --}}

@endsection

@section('content')
  <div class="container-fluid py-4">
    <div class="card">
      <div class="card-header pb-0 px-3">
        <h6 class="mb-0">{{ __('View Feedback') }}</h6>
      </div>
      <div class="card-body pt-4 p-3">
        <form method="PUT" action="{{ route('user.feedback.update', $feedback->id) }}" enctype="multipart/form-data">
          @csrf
          @include('alerts')
          <div class="mb-3">
            <label>Title<span class="text-danger">*</span></label>
            <input type="text" placeholder="Title" class="form-control" name="title" value="{{ old('title', $feedback->title) }}"
              required disabled>
          </div>
          <div class="mb-3">
            <label>Description<span class="text-danger">*</span></label> 
            <div class="p-3 border border-secondary rounded bg-light">
              {!! old('description',$feedback->description) !!}
            </div>
              
          </div>
          
          <div class="mb-3">
            <label>Category<span class="text-danger">*</span></label>
            <input type="text" placeholder="Category" class="form-control" name="category" value="{{ old('category', $feedback->category->name) }}"
              required disabled>
          </div>
          
          <div class="mb-3">
            <label>Status<span class="text-danger">*</span></label>
            <input type="text" placeholder="Status" class="form-control" name="status" value="{{ old('status', $feedback->status->name) }}"
              required disabled>
          </div>
        
        </form>
      </div>
    </div>
  </div>
@endsection

@section('js')
  {{-- Page js files --}}

@endsection




