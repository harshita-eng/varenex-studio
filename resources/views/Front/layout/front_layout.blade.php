<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>VarenyaEx Studio</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <!-- Favicons -->
    <!-- <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/front/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/front/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/custom.css') }}" rel="stylesheet">
    </head>
    <body class="index-page">
        
        @include('Front.partials.front_header')
        <main class="main">
            @yield('content')
        </main>
        @include('Front.partials.front_footer')

        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
        <script src="{{ asset('assets/front/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/front/vendor/php-email-form/validate.js') }}"></script>
        <script src="{{ asset('assets/front/vendor/aos/aos.js') }}"></script>
        <script src="{{ asset('assets/front/vendor/glightbox/js/glightbox.min.js') }}"></script>
        <script src="{{ asset('assets/front/vendor/purecounter/purecounter_vanilla.js') }}"></script>
        <script src="{{ asset('assets/front/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/front/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('assets/front/vendor/swiper/swiper-bundle.min.js') }}"></script>
        <script src="{{ asset('assets/front/js/main.js') }}"></script>
        <script src="{{ asset('assets/front/js/custom.js') }}"></script>
    </body>
</html>