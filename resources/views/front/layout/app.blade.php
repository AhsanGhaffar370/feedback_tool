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
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Place favicon.png in the root directory -->
  <link rel="shortcut icon" href="{{ asset('front/img/favicon.png') }}" type="image/x-icon" />
  <title>
    Feedback @yield('page_title')
  </title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  @include('front.layout.style')





  {{-- Page Styles --}}
  @yield('css')
</head>

<body class="body-wrapper">

  @include('front.layout.nav')
  @yield('content')
  @include('front.layout.footer')

    
  <!-- preloader area start -->
  <div class="preloader d-none" id="preloader">
    <div class="preloader-inner">
        <div class="spinner">
            <div class="dot1"></div>
            <div class="dot2"></div>
        </div>
    </div>
</div>
<!-- preloader area end -->
  
  @include('front.layout.script')

  {{-- Page Scripts --}}
  @yield('js')

  <script>

    @if (Session::has('success'))
      successtoast('{{ Session::get('success') }}');
    @endif
    @if (Session::has('error'))
      errortoast('{{ Session::get('error') }}');
    @endif



        // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()




// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;


var pusher=new Pusher("{{env('PUSHER_APP_KEY')}}", {
 cluster: "{{env('PUSHER_APP_CLUSTER')}}",
 forceTLS: true
});
   
  @if(Auth()->check())
    var channel=pusher.subscribe("notification.send");
    channel.bind("App\\Events\\NewNotification", (data)=>{
        if(data.user_id == {{Auth()->user()->id }}){
            $('.head_notification_count').html(data.notification_count);
        }
    });

    var channel2=pusher.subscribe("message.send");
    channel2.bind("App\\Events\\NewMessage", (data)=>{
        if(data.to_user_id == {{Auth()->user()->id }}){
            $('.head_message_count').html(data.message_count);
        }
    });
  @endif


  </script>














</body>

</html>