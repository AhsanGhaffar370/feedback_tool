<!--
=========================================================
* Soft UI Dashboard - v1.0.3
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>

<html lang="en" >


<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
  <title>
    feedback @yield('page_title')
  </title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  @include('back_layout.style')

  {{-- Page Styles --}}
  @yield('css')
</head>

<body class="g-sidenav-show  bg-gray-100  ">

    @if(Route::currentRouteName() == 'admin.login' || Route::currentRouteName() == 'register' || Route::currentRouteName() == 'send-email') 
        @yield('content') 
    @else
      @include('back_layout.sidebar')
      <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
          @include('back_layout.nav')
          <div class="container-fluid py-4">
              @yield('content')
              @include('back_layout.footer')
          </div>
      </main>
      
    @endif

  {{-- @if(session()->has('success'))
    <div x-data="{ show: true}"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        class="position-fixed bg-success rounded right-3 text-sm py-2 px-4">
      <p class="m-0">{{ session('success')}}</p>
    </div>
  @endif --}}

  
  @include('back_layout.script')

  {{-- Page Scripts --}}
  @yield('js')

  <script>
    
    @if (Session::has('success'))
      successtoast('{{ Session::get('success') }}');
    @endif
    @if (Session::has('error'))
      errortoast('{{ Session::get('error') }}');
    @endif
  </script>
</body>

</html>
