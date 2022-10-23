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
<!-- Toastify css -->
<link  href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.css" rel="stylesheet" />
<!-- Jquery ui -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>

<body>
      @include('layouts.inc.frontnav')
      <div class="container-fluid">
       @yield('content')
      </div>
      <!--   whats app   -->
      <div class="whatsapp-chat">
        <a href="https://wa.me/+8801775088249?text=I'm%20interested%20in%20the%20buy%20something" target="_blank">
          <img src="{{asset('assets/images/whatsapp.png')}}" 
        height="60px"
        width="60px" alt="whatsapp-logo">
        </a>
      </div>
    
      @include('layouts.inc.frontfooter')
    
    <!--   Core JS Files   -->
    <script 
    src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"
    ></script>

  <!---Toastify----->
  <script src="{{asset('admin/js/toastify.js')}}"></script>
    
    <!---Jquery----->
    <script src="{{asset('frontend/js/jquery-3.6.0.min.js')}}"></script>
    <!---Jquery ui----->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <!--- Owl carousel ----->
    <script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
    <!---Sweet alert---->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!---Custom js----->
    <script src="{{asset('frontend/js/custom.js')}}"></script>
    <!---checkout js----->
    <script src="{{asset('frontend/js/checkout.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.6.1/toastify.js"></script>
   
    <!--Start of Tawk.to Script-->
<script type="text/javascript">
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/635549f5daff0e1306d38598/1gg2ihqt6';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin','*');
  s0.parentNode.insertBefore(s1,s0);
  })();
  </script>
  <!--End of Tawk.to Script-->
    @if (session('status'))
      <script>
        Toastify({text:'{{session('status')}}',duration:2000,
      style:{ background:"linear-gradient(to rigth,#00b09b,96c93d)" } 
      }).showToast();
      </script>
    @endif

    <!---jqury ui----->
    <script>
      $( function() {
        var availableTags = [];
        $.ajax({
          type: "GET",
          url: "/product-list",
         
          success: function (response) {
            startAutoComplate(response);
          }
        });
        function startAutoComplate(availableTags){
         $( "#searchproduct" ).autocomplete({
          source: availableTags
        });
        }
       
      } );
      </script>
    <!---extended script----->
    @yield('scripts')
  </body>
  
</html>

