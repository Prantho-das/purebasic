<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     @php
     $setting=App\SiteSetting:: where('status',1)->where('id',1)->first();
     @endphp
    <title>{{$setting->site_title}}</title>

    <meta name="description" content="{{$setting->description}}">
    <meta name="keywords" content="{{$setting->keyword}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="shortcut icon" type="image/x-icon" href="{{asset('uploads/setting/'.$setting->fav_icon)}}">
    <link rel="stylesheet" href="{{asset('contents/website')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('contents/website')}}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('contents/website')}}/js/video-player/plyr.css">
    <link rel="stylesheet" href="{{asset('contents/website')}}/js/custom-ytplayer/youCover.css">
    <link rel="stylesheet" href="{{asset('contents/website')}}/css/plugins.css">
    <link rel="stylesheet" href="{{asset('contents/website')}}/style.css">
    <link rel="stylesheet" href="{{asset('contents/website')}}/css/stylejob.css">
    </head>
    <body>

		
		<!-- header start -->
<header style="background: #b30f0f">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="logo">
                    <img src="{{asset('uploads/setting/'.$setting->site_logo)}}">
                </div>
                <div class="all_job">
                    
                    <h6>সকল জব</h6>
                </div>
            </div>
            <div class="col-md-8">
                <div class="header_right text-right">
                    <a href="#"><i class="fa fa-chevron-down"></i> ভাষা</a>
                    <a href="{{url('user/login')}}"><i class="fa fa-user"></i> লগইন</a>
                    <a href="#"><i class="fa fa-ad"></i> বিজ্ঞাপন দিন</a>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header end -->


@yield('content')

    <div class="footer-top-section section bg-dark-gray">
        <div class="container">
            <div class="row">
                <div class="footer-widget col-xl-4 col-md-6 col-12 mb-60">
                    <h4 class="widget-title">Visit & Contact</h4>
                    <div class="content fix">
                        <a href="#" class="fo-logo"><img src="img/white_logo_png.png" alt=""></a>
                        <ol class="footer-contact">
                            <li><i class="fa fa-home"></i>aaaa</li>
                            <li><i class="fa fa-envelope-open"></i>aaa</li>
                            <li><i class="fa fa-headphones"></i>aaa</li>
                        </ol>
                        @php
                          $social=App\Social:: where('status',1)->where('id',1)->first();
                        @endphp
                        <div class="footer-social">
                            <a href="{{$social->facebook}}" class="facebook"><i class="fa fa-facebook"></i></a>
                            <a href="{{$social->twitter}}" class="twitter"><i class="fa fa-twitter"></i></a>
                            <a href="{{$social->youtube}}" class="dribbble"><i class="fa fa-youtube"></i></a>
                            <a href="{{$social->google}}" class="google-plus"><i class="fa fa-google-plus"></i></a>
                        </div>
                    </div>
                </div>


                <!-- Footer Widget Start -->
                <div class="footer-widget col-xl-2 col-md-6 col-6">
                    <h4 class="widget-title">Explore</h4>
                    <ul class="sidebar-category fo_quick_link text-white">
                        <li><a href="{{url('/about')}}">About us</a></li>
                        <li><a href="{{url('/contact')}}">Contact</a></li>
                        <li><a href="{{url('/career')}}">Career</a></li>
                        <li><a href="{{url('/terms')}}">Terms</a></li>
                        <li><a href="{{url('/privacy_policy')}}">Privacy Policy</a></li>
                        <li><a href="{{url('/faq')}}">FAQ</a></li>
                    </ul>
                </div>
                <div class="footer-widget col-xl-2 col-md-6 col-6">
                    <h4 class="widget-title">products & Services</h4>
                     <ul class="sidebar-category fo_quick_link text-white">
                        <li><a href="#">Features</a></li>
                        <li><a href="#">Top list</a></li>
                        <li><a href="#">Review</a></li>
                        <li><a href="#">Video</a></li>
                        <li><a href="#">Photo Story</a></li>
                        <li><a href="#">Trendings</a></li>
                    </ul>
                </div>
                <div class="footer-widget col-xl-4 col-md-6 col-12">
                   <p class="text-white">
                       People search for this Lorem ipsum dummy copy text using all kinds of names, such as Lorem ipsum, lorem ipsum dolor sit amet, Lorem, dummy text, loren ipsum (yes, spelled wrong), Lorem ipsum sample textipsum loremlorem ipsum sample, Latin copy text, Lorem ipsum text, Latin dummy text, template text, sample text, dummy copy text, Latin sample text, HTML dummy text, Lorem ipsum dummy text, filler text or copy filling text, and many other names. Regardless of what you wish to call it, this text possibly originated in the 1500s as scrambled Latin.
                   </p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-section section bg-dark">
        <div class="container">
            <div class="row">
                <div class="copyright text-center col">
                    <p>Copyright © <?php echo date('Y');?>  takbir hasan All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('contents/website')}}/js/bootstrap.min.js"></script>
</body>

</html>
