@extends('front.layout.app')

@section('page_title', '| Notifications')

@section('css')
  {{-- Page css files --}}
<style>


</style>
@endsection

@section('content')

  <div class="row">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header pb-0">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0">Notifications</h5>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive p-0" style="overflow-y: hidden;">
                  <table class="table">
                    <tbody class="notification">
                      @forelse($notifications as $notification)
                        <tr>
                            <td width="5%" class="">
                              <a href="#" data-id="{{ $notification->id }}" class="delete btn btn-secondary text-white " >x</a>
                            </td>
                            <td width="70%" class="">
                              <a href="{{URL::to('/')}}{{ $notification->url }}">
                                <p>{{$notification->message}}</p>
                              </a>
                            </td>
                            <td width="10%" class="">
                              <small>{{ $notification->created_at->diffForHumans() }}</small>
                            </td>
                            <td width="25%" class="">
                              @if($notification->seen == 0)
                                <a class="mark_as_read btn btn-success btn-sm" href="#" data-id="{{ $notification->id }}" >Mark As Read</a>
                                @endif
                            </td>
                        </tr>
                        @empty
                          <tr>No data found</tr>
                        @endforelse
                    </tbody>
                  </table>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@section('js')
  {{-- Page js files --}}
  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script>
// Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;


 var pusher=new Pusher("{{env('PUSHER_APP_KEY')}}", {
  cluster: "{{env('PUSHER_APP_CLUSTER')}}",
  forceTLS: true
});
    
    var channel=pusher.subscribe("notification.send");
    channel.bind("App\\Events\\NewNotification", (data)=>{
       
        if(data.user_id == {{Auth()->user()->id }}){
            $('.notification').prepend(`
            <tr>
              
              <td class="">
                <a href="#" data-id="`+ data.id + `" class="delete  btn btn-secondary text-white">x</a>
              </td>
              <td class="">
                <a href="{{URL::to('/')}}` + data.url + `">
                  <p>`+ data.message + `</p>
                </a>
              </td>
              <td>
                <small>0 minutes ago</small>
              </td>
              <td class="">
                <a class="mark_as_read btn btn-success btn-sm" href="#" data-id="`+ data.id + `" >Mark As Read</a>
              </td>
            </tr>
            `);
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $(document).on('click', '.mark_as_read', function(e) {
      e.preventDefault();
      let th =$(this);
      let id = th.attr('data-id');
      $.ajax({
        url: "{{ route('notification.mark_as_read') }}",
        method: "POST",
        data: {
          id: id
        },
        success: function (data) {
            if (data.code == 200) {
              th.css('visibility', 'hidden');
            } else {
              errortoast(data.message);
            }
        },
        error: function (error) {
          errortoast('something went wrong');
        }
      });
    });

    $(document).on('click', '.delete', function(e) {
      e.preventDefault();
      let th =$(this);
      let id = th.attr('data-id');
      $.ajax({
        url: "{{ route('notification.delete') }}",
        method: "POST",
        data: {
          id: id
        },
        success: function (data) {
            if (data.code == 200) {
              th.closest('tr').remove();
            } else {
              errortoast(data.message);
            }
        },
        error: function (error) {
          errortoast('something went wrong');
        }
      });
    });
  </script>
@endsection
