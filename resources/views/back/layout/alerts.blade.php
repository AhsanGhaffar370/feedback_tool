@if(Session::has('success'))
    <div class="alert alert-success pt-2 pl-2 pr-2 pb-0" role="alert">
        <h6 class="alert-heading font-weight-bold">Success</h6>
        <div class="alert-body">
            {{ Session::get('success') }}
        </div>
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger pt-2 pl-2 pr-2 pb-0" role="alert">
        <h6 class="alert-heading font-weight-bold">Error</h6>
        <div class="alert-body">
            {{ Session::get('error') }}
        </div>
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger pt-2 pl-2 pr-2 pb-0" role="alert">
        <h6 class="alert-heading font-weight-bold">Error</h6>
        <div class="alert-body">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
@if(Session::has('warning'))
    <div class="alert alert-warning pt-2 pl-2 pr-2 pb-0" role="alert">
        <h6 class="alert-heading font-weight-bold">Warning</h6>
        <div class="alert-body">
            {{ Session::get('warning') }}
        </div>
    </div>
@endif