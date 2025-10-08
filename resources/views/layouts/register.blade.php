<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">


    <title>Pure Basic</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" href="{{ asset('assets/css') }}/fontawesome/fontawesome-pro.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css') }}/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css') }}/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('assets/css') }}/nice-select.css">
    <link rel="stylesheet" href="{{ asset('assets/css') }}/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/scss/') }}/style.css">
    <link rel="stylesheet" href="{{ asset('assets/css/scss/') }}/responsive.css">

</head>

<body>
    @include('layouts.header')


    @yield('content')


    @include('layouts.footer')

    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @yield('js')



</body>

</html>
