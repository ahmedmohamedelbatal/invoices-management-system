<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Title -->
    <title>لوحة التحكم - @yield('title')</title>
    <!-- Favicon -->
    <link rel="icon" href="{{URL::asset('assets/img/brand/favicon.png')}}" type="image/x-icon" />
    <!-- Icons css -->
    <link href="{{URL::asset('assets/css-rtl/icons.css')}}" rel="stylesheet" />
    <!--  Custom Scroll bar-->
    <link href="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />
    <!--  Sidebar css -->
    <link href="{{URL::asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet" />
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{URL::asset('assets/css-rtl/sidemenu.css')}}" />
    @yield('css')
    <!--- Style css -->
    <link href="{{URL::asset('assets/css-rtl/style.css')}}" rel="stylesheet" />
    <!--- Dark-mode css -->
    <link href="{{URL::asset('assets/css-rtl/style-dark.css')}}" rel="stylesheet" />
    <!---Skinmodes css-->
    <link href="{{URL::asset('assets/css-rtl/skin-modes.css')}}" rel="stylesheet" />
  </head>
  <body class="main-body app sidebar-mini">
    <!-- Loader -->
    <div id="global-loader">
      <img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader" />
    </div>
    
    @include('layouts.sidebar')

    <!-- main-content -->
    <div class="main-content app-content">
      @include('layouts.header')
      <!-- container -->
      <div class="container-fluid">
        @yield('content')
      </div>
      <!-- Back-to-top -->
      <a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
    </div>

    <!-- JQuery min js -->
    <script src="{{URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap Bundle js -->
    <script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Ionicons js -->
    <script src="{{URL::asset('assets/plugins/ionicons/ionicons.js')}}"></script>
    <!-- Moment js -->
    <script src="{{URL::asset('assets/plugins/moment/moment.js')}}"></script>
    <!-- Rating js-->
    <script src="{{URL::asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/rating/jquery.barrating.js')}}"></script>
    <!--Internal  Perfect-scrollbar js -->
    <script src="{{URL::asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/perfect-scrollbar/p-scroll.js')}}"></script>
    <!--Internal Sparkline js -->
    <script src="{{URL::asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
    <!-- Custom Scroll bar Js-->
    <script src="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <!-- right-sidebar js -->
    <script src="{{URL::asset('assets/plugins/sidebar/sidebar.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/sidebar/sidebar-custom.js')}}"></script>
    <!-- Eva-icons js -->
    <script src="{{URL::asset('assets/js/eva-icons.min.js')}}"></script>
    @yield('js')
    <!-- Sticky js -->
    <script src="{{URL::asset('assets/js/sticky.js')}}"></script>
    <!-- custom js -->
    <script src="{{URL::asset('assets/js/custom.js')}}"></script>
    <!-- Left-menu js-->
    <script src="{{URL::asset('assets/plugins/side-menu/sidemenu.js')}}"></script>
  </body>
</html>