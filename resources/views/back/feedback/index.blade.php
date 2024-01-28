@extends('back.layout.app')

@section('page_title','| Feedbacks')

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
                            <h5 class="mb-0">All Feedbacks</h5>
                        </div>
                        {{-- <a href="#" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New User</a> --}}
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0" style="overflow-y: hidden;">
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
                                        Title
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Description
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Category
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Like
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                              @forelse($feedbacks as $feedback)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{$feedback->id}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$feedback->user->name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$feedback->title}}</p>
                                    </td>
                                    <td class="text-center">
                                      <p class="text-xs font-weight-bold mb-0">{!!$feedback->description !!}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$feedback->category->name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <select name="status_id" 
                                        data-href="{{ route('admin.feedback.update_status', $feedback->id) }}"
                                        class="bss_select change_status form-control" required>
                                        @foreach($statuses as $status)
                                        <option value="{{$status->id}}" {{ (old('status_id',$feedback->status_id) == $status->id) ? 'selected' : '' }}>{{$status->name}}</option>
                                        @endforeach
                                      </select>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$feedback->vote_up_count()}}</p>
                                    </td>
                                    <td class="text-center">
                                      <span class="text-secondary text-xs font-weight-bold">{{\Carbon\Carbon::parse($feedback->created_at)->format('d/m/y')}}</span>
                                    </td>
                                </tr>
                                @empty
                                  <tr>
                                    <td colspan="6" class="text-center">No Records Found</td>
                                  </tr>
                                @endforelse
                            </tbody>
                        </table>
                        @if ($feedbacks->hasPages())
                            <div class="pagination-wrapper">
                                {{ $feedbacks->links() }}
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
  let status_id = $(this).val();
  let href = $(this).attr('data-href');
  $.ajax({
        type: 'POST',
        url: href,
        data: {
            status_id: status_id,
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
<script>


</script>
@endsection




