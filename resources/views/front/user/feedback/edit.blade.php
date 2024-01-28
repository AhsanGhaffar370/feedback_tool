@extends('front.layout.app')

@section('page_title','| Feedback Edit')

@section('css')
{{-- Page css files --}}

@endsection

@section('content')
  <div class="container py-4">
    <div class="card">
      <div class="card-header pb-0 px-3">
        <h6 class="mb-0">{{ __('Edit Feedback') }}</h6>
      </div>
      <div class="card-body pt-4 p-3">
        <form method="PUT" action="{{ route('user.feedback.update', $feedback->id) }}" enctype="multipart/form-data">
          @csrf
          @include('alerts')
          <div class="mb-3">
            <label>Title<span class="text-danger">*</span></label>
            <input type="text" placeholder="Title" class="form-control" name="title" value="{{ old('title', $feedback->title) }}"
              required>
          </div>
          <div class="mb-3">
            <label>Description<span class="text-danger">*</span></label> 
            <textarea placeholder="Description" class="form-control bss_editor" name="description"
              >{{ old('description', $feedback->description) }}</textarea>
              
          </div>
          <div class="mb-3">
            <label>Category<span class="text-danger">*</span></label>
            <select name="category_id" class="bss_select form-control" required>
              <option value="" selected disabled>Select Category</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $feedback->category_id) == $category->id ? 'selected' : '' }}>
                  {{ $category->name }}</option>
              @endforeach
            </select>
          </div>
          <button class="btn btn-primary btn-sm mb-0" type="submit">Submit</button>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('js')
  {{-- Page js files --}}

@endsection




