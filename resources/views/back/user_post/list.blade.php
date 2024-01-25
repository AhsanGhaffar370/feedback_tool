@extends('back_layout.app')

@section('page_title','| Register')

@section('css')
{{-- Page css files --}}

<style>
  .select2-results__options li {
    font-size: 12px;
  }
    .select2-container .select2-selection--single {
    height: 28px !important;
    width: auto !important;
    padding: 0px !important;
    font-size: 12px
  }
  .select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 26px !important;
  }

</style>
@endsection

@section('content')
<div>
    @include('admin_alerts')

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All User Post</h5>
                        </div>
                        {{-- <a href="#" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New User</a> --}}
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                      Title
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                      User Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Service looking for
                                    </th>
                                    <th width="10%" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                      Approval Status
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                      Status
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                      Creation Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                              @forelse($user_posts as $user_post)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{$user_post->id}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$user_post->title}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$user_post->user->name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$user_post->serviceType->name}}</p>
                                    </td>
                                    <td class="text-center">
                                      <select name="approval_status_id" 
                                      data-href="{{ route('admin.post.update_approval_status', $user_post->id) }}"
                                      class="bss_select change_approval_status form-control" required>
                                        @foreach($approval_status as $approval_status1)
                                        <option value="{{$approval_status1->id}}" {{ (old('approval_status_id',$user_post->approval_status_id) == $approval_status1->id) ? 'selected' : '' }}>{{$approval_status1->name}}</option>
                                        @endforeach
                                      </select>
                                    </td>
                                    <td class="text-center">
                                      <div class="form-check form-switch " style="display:flex; justify-content:center;">
                                        <input class="form-check-input change_status" type="checkbox" id="mySwitch" name="darkmode" 
                                        value="yes" 
                                        data-id="{{$user_post->id}}"
                                        data-href="{{ route('admin.post.update_status', $user_post->id) }}"
                                        {{$user_post->status==1 ? 'checked' : '' }}
                                        >
                                      </div>       
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{\Carbon\Carbon::parse($user_post->created_at)->format('d/m/y')}}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.post.show', $user_post->id) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="View user">
                                            <i class="fas fa-eye text-secondary"></i>
                                        </a>
                                        <span>
                                            {{-- <i class="cursor-pointer fas fa-trash text-secondary"></i> --}}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                  <tr>
                                    <td colspan="6" class="text-center">No Records Found</td>
                                  </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if ($user_posts->hasPages())
                            <div class="pagination-wrapper">
                                {{ $user_posts->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection

@section('js')
{{-- Page js files --}}

<script>
$(document).on('change', '.change_approval_status', function (e) {
  let approval_status_id = $(this).val();
  let href = $(this).attr('data-href');
  $.ajax({
        type: 'POST',
        url: href,
        data: {
            approval_status_id: approval_status_id,
            _token: $("meta[name='csrf-token']").attr("content"),
        },
        success: function (data) {
            // console.log(data);
            if (data.code == '200')
                successtoast(data.message);
            else {
                errortoast(data.message);
            }
        }
    });
});

$(document).on('change', '.change_status', function (e) {
 // e.preventDefault();
    var href = $(this).attr('data-href');
    var id = $(this).attr('data-id');

    $.ajax({
        type: 'POST',
        url: href,
        data: {
            id: id,
            _token: $("meta[name='csrf-token']").attr("content"),
        },
        success: function (data) {
            // console.log(data);
            if (data.code == '200')
                successtoast(data.message);
            else {
                errortoast(data.message);
            }
        }
    });
});

</script>
@endsection