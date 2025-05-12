<!DOCTYPE html>
<html lang="en">
    <head>
        <title>VarneyaEx Studio</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{ URL('assets/user-dashboard/vendors/mdi/css/materialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ URL('assets/user-dashboard/vendors/css/vendor.bundle.base.css') }}">
        <link rel="stylesheet" href="{{ URL('assets/user-dashboard/css/style.css') }}">
        <!-- <link rel="shortcut icon" href="{{ URL('assets/user-dashboard/images/favicon.ico') }}" /> -->
    </head>
    <body syle="overflow:hidden;">
        <div class="container-scroller">
            @include('Front.Partials.user_header')
            @yield('content')
        </div>

        <script src="{{ URL('assets/user-dashboard/vendors/js/vendor.bundle.base.js') }}"></script>
        <script src="{{ URL('assets/user-dashboard/vendors/chart.js/Chart.min.js') }}"></script>
        <script src="{{ URL('assets/user-dashboard/js/jquery.cookie.js') }}" type="text/javascript"></script>
        <script src="{{ URL('assets/user-dashboard/js/off-canvas.js') }}"></script>
        <script src="{{ URL('assets/user-dashboard/js/hoverable-collapse.js') }}"></script>
        <script src="{{ URL('assets/user-dashboard/js/misc.js') }}"></script>
        <script src="{{ URL('assets/user-dashboard/js/dashboard.js') }}"></script>
        <script src="{{ URL('assets/user-dashboard/js/todolist.js') }}"></script>
    </body>
</html>