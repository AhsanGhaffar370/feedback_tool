@extends('front_layout.app')

@section('page_title','| Feedback View')

@section('css')
{{-- Page css files --}}

@endsection

@section('content')
  <div class="container py-4">
    <div class="card">
      <div class="card-header pb-0 px-3">
        <h6 class="mb-0">{{ __('View Feedback') }}</h6>
      </div>
      <div class="card-body pt-4 p-3">
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



          
          <div class="mb-3 mt-5">
            <label class="font-weight-bold">Votes</label><br>
            <a href="{{ route('feedback.vote.store',['feedback_id' => $feedback->id]) }}" class="mx-1 mr-5" data-bs-toggle="tooltip" data-bs-original-title="Vote Feedback"
              onclick="event.preventDefault(); document.getElementById('vote_up_feedback_{{$feedback->id}}').submit();">
              <i class="fa-solid fa-thumbs-up text-success fa-2x"></i> {{ $feedback->vote_up_count()}}
            </a>
            <form id="vote_up_feedback_{{$feedback->id}}" action="{{ route('feedback.vote.store',['feedback_id' => $feedback->id]) }}" method="POST" class="d-none">
              @csrf
              <input type="hidden" name="is_like" value="1">
            </form>
            <a href="{{ route('feedback.vote.store',['feedback_id' => $feedback->id]) }}" class="mx-1" data-bs-toggle="tooltip" data-bs-original-title="Vote Feedback"
              onclick="event.preventDefault(); document.getElementById('vote_down_feedback_{{$feedback->id}}').submit();">
              <i class="fa-solid fa-thumbs-down text-danger fa-2x"></i> {{ $feedback->vote_down_count()}}
            </a>
            <form id="vote_down_feedback_{{$feedback->id}}" action="{{ route('feedback.vote.store',['feedback_id' => $feedback->id]) }}" method="POST" class="d-none">
              @csrf
              <input type="hidden" name="is_like" value="0">
            </form>
          </div>
          
        
      </div>
    </div>
  </div>




  <div class="container py-4">


<h4 class="card-title">Comments</h4>
<hr>
    
{{-- list all comments --}}
@forelse($feedback->comments as $comment)
	<div class="card-text mt-3 pt-3">
		<b>{{ $comment->user->name }}</b> said
		<small class="text-muted">
		    {{ $comment->created_at->diffForHumans() }}
		</small>
		<p>{!! $comment->content !!}</p>

	</div>
@empty
	<p class="card-text">no comments yet!</p>
@endforelse


{{-- add comment form --}}
@include('front.user.feedback.add_comment')
</div>
@endsection

@section('js')
  {{-- Page js files --}}

@endsection




