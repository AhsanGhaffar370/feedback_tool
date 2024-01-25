<div class="col-lg-4">
  <div class="ltn__tab-menu-list mb-50">
    <div class="nav">
      <a class="{{(Route::currentRouteName() == 'user.dashboard' || Route::currentRouteName() == 'user.account_details') ? 'active show' : ''}}" href="{{ route('user.dashboard') }}">Dashboard <i class="fas fa-user"></i></a>
      <a class="{{(Route::currentRouteName() == 'user.post.create') ? 'active show' : ''}}" href="{{ route('user.post.create') }}">Post a Job  <i class="fa-solid fa-upload"></i></a>      
      <a class="{{(Route::currentRouteName() == 'user.chat') ? 'active show' : ''}}" href="{{ route('user.chat') }}">Messages <i class="fa-solid fa-comment"></i></a>
            <a class="{{($post_status ?? '') == 'all' ? 'active show' : ''}}" href="{{ route('user.post.list', ['post_status' => 'all']) }}">My Projects <i class="fa-solid fa-list"></i></i></a>
      <a class="{{($post_status ?? '') == 'in-progress' ? 'active show' : ''}}" href="{{ route('user.post.list', ['post_status' => 'in-progress']) }}">Work in Progress <i class="fa-solid fa-list"></i></a>      
      <a class="{{($post_status ?? '') == 'completed' ? 'active show' : ''}}"  href="{{ route('user.post.list', ['post_status' => 'completed']) }}">Completed Projects <i class="fa-solid fa-list"></i></a>
      {{-- <a href="#liton_tab_1_4">My Orders <i class="fas fa-map-marker-alt"></i></a> --}}
      <a class="{{(Route::currentRouteName() == 'user.edit_password') ? 'active show' : ''}}" href="{{ route('user.edit_password') }}">Change Password <i class="fa-solid fa-lock"></i></i></a>
      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout <i class="fas fa-sign-out-alt"></i>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>                                        
    </div>
  </div>
</div>
