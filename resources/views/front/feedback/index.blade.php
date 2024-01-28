@extends('front.layout.app')

@section('page_title','| Feedback List')

@section('css')
{{-- Page css files --}}

@endsection

@section('content')
<div>
    @include('alerts')

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Feedbacks</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0" style="overflow-y: hidden;">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                      Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                      Title
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                      Description
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                      Category
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                      Status
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                      Likes
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
                              @forelse($feedbacks as $feedback)
                                <tr>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$feedback->user->name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$feedback->title}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{!! $feedback->description !!}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$feedback->category->name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$feedback->status->name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$feedback->vote_up_count()}}</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{\Carbon\Carbon::parse($feedback->created_at)->format('d/m/y')}}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('feedback.show', $feedback->id) }}" class="mx-1" data-bs-toggle="tooltip" data-bs-original-title="View Feedback">
                                            <i class="fas fa-eye text-secondary"></i>
                                        </a>
                                        
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


</script>
@endsection