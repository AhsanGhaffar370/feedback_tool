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
                            <h5 class="mb-0">All Users</h5>
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
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                              @forelse($users as $user)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{$user->id}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$user->name}}</p>
                                    </td>
                                    <td class="text-center">
                                      <p class="text-xs font-weight-bold mb-0">{{$user->email}}</p>
                                    </td>
                                    <td class="text-center">
                                      <span class="text-secondary text-xs font-weight-bold">{{\Carbon\Carbon::parse($user->created_at)->format('d/m/y')}}</span>
                                    </td>
                                </tr>
                                @empty
                                  <tr>
                                    <td colspan="6" class="text-center">No Records Found</td>
                                  </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if ($users->hasPages())
                            <div class="pagination-wrapper">
                                {{ $users->links() }}
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
$(document).on('change', '.change_status', function (e) {
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


</script>
@endsection
