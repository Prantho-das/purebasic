<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pure Basic </title>
    <!-- Favicon and Touch Icons -->
    <link href="{{ asset('contents/website') }}/tak/images/favicon.png" rel="shortcut icon" type="image/png">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="stylesheet" href="{{ asset('contents/website') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('contents/website') }}/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="{{ asset('contents/website') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('contents/website') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('contents/website') }}plyr.css" />
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <!-- Load Faceb`ook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v7.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Your Chat Plugin code -->
    <div class="fb-customerchat" attribution=setup_tool page_id="101570048245910"
        logged_in_greeting="Hi! How can we help you?" logged_out_greeting="Hi! How can we help you?">
    </div>

    @stack('css')
</head>
<style>
    .video iframe {
        width: 189px !important;
        height: 54px !important;
    }

    .tab_hed {
        height: auto !important;
    }
</style>

<body>

    @if (session()->has('success'))
        <script>
            swal({
                title: "Good job!",
                text: "Yor Account Create Success Please Wait For Approve",
                icon: "success",
                button: "Aww yiss!",
            });
        </script>
    @endif


    <section id="menu_bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ asset('contents/website') }}/tak/images/re.png" style="width: 150px">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation" style="background: #fff;">
                            <span class="navbar-toggler-icon" style="color:#000"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto color_white">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ url('/') }}">Home <span
                                            class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/') }}">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/') }}">Courses</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('free_class') }}">Free Class</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/') }}">Gallery</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/') }}">Contact</a>
                                </li>
                                @php
                                    $id = Session::get('id');
                                    $profile = App\Student::where('id', $id)->first();
                                @endphp
                                @if ($id)
                                @else
                                    <div style="margin-left: 125px"></div>
                                @endif


                                @if ($id)
                                    <div class="profile text-right" style=" margin-left: 125px;">
                                        <li class="nav-item dropdown taaaaa">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                                role="button" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                {{ $profile->name }}
                                            </a>
                                            <div class="dropdown-menu menu_dp_color" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item"
                                                    href="{{ url('/student/profile/' . $profile->id) }}">Profile</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="{{ url('/student/logout') }}">Logout</a>
                                            </div>
                                        </li>
                                    </div>
                                @endif

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    @include('website.success_error')
    @yield('content')
    <section>
        <div class="container">
            <div class="footer">
                <div class="row">
                    <div class="col-md-4">
                        <div class="footer_right">
                            <h5>Follow Me</h5>
                            <ul>
                                <a href="#" style="color: #000"><i class="fab fa-facebook-square"></i></a>
                                <a href="#" style="color: #000"><i class="fab fa-twitter"></i></a>
                                <a href="#" style="color: #000"><i class="fab fa-google"></i></a>
                                <a href="#" style="color: #000"><i class="fab fa-skype"></i></a>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer_madle">
                            <h5>Contact us</h5>
                            <p><i class="fas fa-envelope"></i> Email: support@purebasic.com.bd</p>
                            <p><i class="fas fa-phone"></i> Mobile: 01638-885050</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer_madle">
                            <h5>Development</h5>
                            <a href="https://codeforsoft.com/"><img
                                    src="https://codeforsoft.com/wp-content/uploads/2020/04/logo-for-website.png"
                                    style="    width: 44%;"></a>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('contents/website') }}/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="{{ asset('contents/website') }}/js/vendor/jquery-3.2.1.min.js"></script>
    <script src="{{ asset('contents/website') }}/js/popper.min.js"></script>
    <script src="{{ asset('contents/website') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('contents/website') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('contents/website') }}/js/plugins.js"></script>
    <script src="{{ asset('contents/website') }}/js/main.js"></script>

    <script src="https://cdn.plyr.io/3.6.2/plyr.js"></script>
    <script src="{{ asset('contents/website') }}/plyr.js"></script>
    <script>
        const player = new Plyr('#player');
    </script>

    <script>
        $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
            startDate: '-3d'
        });
    </script>
    @yield('down_jquery')
    @stack('js')
</body>

</html>
