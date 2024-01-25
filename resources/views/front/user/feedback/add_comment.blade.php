
  
    <div class="card mt-5">
      <div class="card-header pb-0 px-3">
        <h6 class="mb-0">{{ __('Post a Comment') }}</h6>
      </div>
      <div class="card-body pt-4 p-3">
        @if(Auth::check() && Auth::user()->hasRole('user'))
        <form method="POST" action="{{ route('feedback.comment.store', ['feedback_id'=>$feedback->id]) }}" enctype="multipart/form-data">
          @csrf
          @include('alerts')
          <div class="mb-3">
            <label>Content<span class="text-danger">*</span></label> 
            <textarea placeholder="Content" class="form-control bss_editor" name="content"
              >{{ old('content') }}</textarea>
              
          </div>
          <button class="btn btn-primary btn-sm mb-0" type="submit">Submit</button>
        </form>
        @else
        <h5>Register or login to post a comment!</h5>
        @endif
      </div>
    </div>
