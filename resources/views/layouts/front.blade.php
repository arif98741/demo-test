<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--Csrf---->
  <meta name="csrf-token" content="{{csrf_token()}}">
  <title>
    @yield('title')
  </title>
  <!-----Favicon------>
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  
  <!--Custom CSS -->
  <link href="{{asset('frontend/css/custom.css')}}" rel="stylesheet" />
  <!--Bootstrap -->
  <link href="{{asset('frontend/css/bootstrap.css')}}" rel="stylesheet" />
  <!--Owl carousel -->
  <link href="{{asset('frontend/css/owl.carousel.min.css')}}" rel="stylesheet" />
  <link href="{{asset('frontend/css/owl.theme.default.min.css')}}" rel="stylesheet" />
  <!--Google Font--->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

<!-- Font awesome--->
<script src="https://kit.fontawesome.com/49f07afdff.js" crossorigin="anonymous"></script>
<!---Toastify----->
<link href="{{asset('frontend/css/toastify.css')}}" rel="stylesheet" />
</head>

<body>
      @include('layouts.inc.frontnav')
      <div class="container-fluid">
       @yield('content')
      </div>
     
    <!--   Core JS Files   -->
    <script 
    src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"
    ></script>

  <!---Toastify----->
  <script src="{{asset('admin/js/toastify.js')}}"></script>
    
    <!---Jquery----->
    <script src="{{asset('frontend/js/jquery-3.6.0.min.js')}}"></script>
    <!--- Owl carousel ----->
    <script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
    <!---Sweet alert---->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!---Custom js----->
    <script src="{{asset('frontend/js/custom.js')}}"></script>
    <!---checkout js----->
    <script src="{{asset('frontend/js/checkout.js')}}"></script>
    @if (session('status'))
      <script>
        swal("{{session('status')}}","" ,"success");
      </script>        
    @endif
    @yield('scripts')
  </body>
  
</html>

