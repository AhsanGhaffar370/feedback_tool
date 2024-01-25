@if($errors->any())
    <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
        <p class="alert-text text-white"><strong>Errors!</strong>l</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li class="alert-text text-white">{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </button>
    </div>
@elseif(session('error'))
    <div class="m-3  alert alert-primary alert-dismissible fade show" id="alert-danger" role="alert">
        <span class="alert-text text-white">
        {{ session('error') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </button>
    </div>
@elseif(session('success'))
    <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
        <span class="alert-text text-white">
        {{ session('success') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </button>
    </div>
@endif