@extends('front_layout.app')

@section('page_title','| Dashboard')

@section('css')
{{-- Page css files --}}

@endsection

@section('content')


@endsection

@section('js')
{{-- Page js files --}}


<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
{{-- <script src="{{ asset('js/ckeditor.js') }}"></script> --}}
<script>
  if ($("#long_desc").length) {
    ClassicEditor
      .create( document.querySelector( '#long_desc' ), {
        toolbar: [ 'heading', '|', 'bold', 'italic', 'link', '|', 'bulletedList', 'numberedList', '|', 'blockQuote', '|', 'undo', 'redo' ],
      })
      .catch( error => {
          console.error( error );
      });
  }
  
</script>
@endsection
