<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>VarenyaEX Studio</title>
    <link rel="stylesheet" href="{{ asset('assets/application/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/application/vendors/flag-icon-css/css/flag-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/application/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/application/vendors/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('assets/application/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/application/vendors/jvectormap/jquery-jvectormap.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/application/vendors/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/application/vendors/chartist/chartist.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/application/css/vertical-light-layout/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/application/images/favicon.png') }}" />
  </head>
  <body>
    <div class="container-scroller">
      @include('Front.partials.app-partials.app_header')
      <div class="container-fluid page-body-wrapper">
        @include('Front.partials.app-partials.app_sidebar')
        <div class="main-panel">
          @yield('content')
          @include('Front.partials.app-partials.app_footer')
        </div>
      </div>
    </div>
    <script src="{{ asset('assets/application/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/application/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/application/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/application/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/application/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/application/vendors/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/application/vendors/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/application/vendors/chartist/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/application/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('assets/application/js/jquery.cookie.js') }}"></script>
    <script src="{{ asset('assets/application/js/off-canvas.js')}}"></script>
    <script src="{{ asset('assets/application/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/application/js/misc.js') }}"></script>
    <script src="{{ asset('assets/application/js/settings.js') }}"></script>
    <script src="{{ asset('assets/application/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/application/js/dashboard.js') }}"></script>
  </body>
</html>