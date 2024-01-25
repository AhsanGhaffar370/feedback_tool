<nav class="navbar navbar-expand-lg navbar-light bg-light p-4">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
      </li>
      @if(Auth::check() && Auth::user()->hasRole('user'))
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.feedback.index') }}">My Feedback</a>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" href="{{ route('feedback.index') }}">All Feedback</a>
      </li>
      
    </ul>
    
    @if(Auth::check() && Auth::user()->hasRole('user'))
    <div class=" my-2 my-lg-0">

      <a class="btn btn-outline-danger my-2 my-sm-0" href="{{ route('logout') }}"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
          <span class="d-sm-inline ">Logout</span>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>
    </div>

    @else

    <div class=" my-2 my-lg-0">

    <a href="{{ route('register') }}" class="btn btn-outline-danger my-2 my-sm-0" >Register</a>
    <a href="{{ route('user.login') }}" class="btn btn-outline-danger my-2 my-sm-0" >Login</a>
    </div>
    @endif
  </div>
</nav>

