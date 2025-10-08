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
    <link rel="stylesheet" href="{{asset('contents/website')}}/css/owl.carousel.min.css">

    <script src="{{asset('contents/website')}}/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="{{asset('contents/admin')}}/js/sweetalert.min.js"></script>
    
</head>
<body>
<div id="main-wrapper">
   <div class="header-top header-top-2 section">
        <div class="container">
            <div class="row">
                <div class="header-top-links col-md-7 col-7">
                    <ul class="header-links header-links-2">
                        <li><a href="#"><i class="fa fa-location-arrow"></i> ঢাকা</a></li>
                        <li><a href="#"><i class="fa fa-calendar"></i> রবিবার</a></li>
                        <li><a href="#"> ১২ মে ২০২০</a></li>
                        <li><a href="#"> ২৯ বৈশাখ ১৪২৭</a></li>
                        
                        <li><a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> আপডেট: ২ মিনিট আগে  </a></li>
                    </ul> 

                </div>


                <div class="col-md-5 col">
                    <div class="header-social header-social-2">
                        <div class="header-top-nav">
                          <div class="follow-dropdown">
                            <button class="dropbtn">
                              <a href="">Follow us</a>
                              <i class="fa fa-caret-down" style="color: #fff; margin-top: -10px;"></i>
                            </button>
                            @php
                              $social=App\Social:: where('status',1)->where('id',1)->first();
                            @endphp
                            <div class="dropdown-content">
                              <a href="{{$social->facebook}}">Facebook</a>
                              <a href="{{$social->twitter}}">Twitter</a>
                              <a href="{{$social->youtube}}">Youtube</a>
                              <a href="{{$social->google}}">Google</a>
                            </div>
                          </div>
                          @php
                            $id = Session:: get('id');
                            $visitor = App\Visitor:: where('id',$id)->first();
                          @endphp
                          @if($visitor)
                              <div class="follow-dropdown">
                                <button class="dropbtn">
                                  <a href="{{url('user/dashboard/'.$visitor->id)}}"><img src="{{asset('contents/website')}}/img/download.png" style="border-radius: 50%; height: 26px; width: 30px;"></a>
                                  <i class="fa fa-caret-down" style="margin-top: 12px;"></i>
                                </button>
                                <div class="dropdown-content">
                                  <a href="{{url('user/dashboard/'.$visitor->id)}}"><i class="fa fa-dashboard"></i> Dashboard</a>
                                  <a href="{{url('/user/logout')}}"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
                                </div>
                              </div>
                            @else
                              <a href="{{url('user/login')}}"><img src="{{asset('contents/website')}}/img/download.png" style="border-radius: 50%; height: 26px; width: 30px;"></a>

                            @endif
                            <a href="#"> ভাষা</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-section section bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="header-logo col-md-2 d-none d-md-block">
                    <a href="{{url('/')}}" class="logo"><img src="{{asset('uploads/setting/'.$setting->site_logo)}}" alt="Logo"></a>
                </div>
                <div class="header-banner col-md-10 col-12">
                    <div class="scroll-menu">
                    	<nav id="pnProductNav" class="pn-ProductNav">
      						    <div id="pnProductNavContents" class="pn-ProductNav_Contents">

                         <a href="{{url('/job/post')}}" class="pn-ProductNav_Link">চাকরির খবর</a>
                         @php

                            $allcat = App\Seba:: where('status',1)->get();
                        
                        @endphp
                    

                      @foreach($allcat as $data)
                       <a href="{{url('amader/sera/category/'.$data->id)}}" class="pn-ProductNav_Link">{{$data->name}}</a>
                      @endforeach
                       
      						        
      						    </div>
                    </nav>  
                     <div class="header-search float-right">

                            <!--Search Toggle-->
                            <button class="header-search-toggle"><i class="fa fa-search"></i></button>

                            <!--Header Search Form-->
                            <div class="header-search-form">
                                <form action="{{url('search')}}" method="GET">
                                    <input type="text" name="search" placeholder="কী খুঁজতে চান?">
                                </form>
                            </div>

                        </div>
                        <div class="all-sec-icon header-search float-right">
                            <div class="menu-btn">
                                <a class="btn-open" href="javascript:void(0)"></a>
                            </div>
                            <span class="all-section">আরো</span>

                            <div class="overlay">
                                <section class="top-menu-overlay">
                                    <div class="overlay-inside">
                                        <div class="container">
                                            <div class="overlay-logo pb-10">
                                                <a href="{{url('/')}}"><img src="{{asset('contents/website')}}/img/CCTV-NEWS.png" alt="Logo"></a>
                                            </div>
                                            <div class="overlay-menu-area">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                      <div class="row">
                                                      @php
                                                          $allcat=App\Category:: where('status',1)->limit(12)->get();
                                                      @endphp
                                                        @foreach($allcat as $data)
                                                        <div class="col-md-2">
                                                            <ul class="menu-list">
                                                                <li><a href="{{url('category/'.$data->slug)}}">{{$data->name}}</a></li>
                                                            </ul>
                                                        </div>
                                                        @endforeach
                                                      </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                      <ul class="menu-list">
                                                        <li><a href="{{url('gallery')}}"><i class="fa fa-camera" aria-hidden="true"></i> ছবি</a></li>
                                                        <li><a href="{{url('videos')}}"><i class="fa fa-video-camera" aria-hidden="true"></i> ভিডিও</a></li>
                                                      </ul>
                                                      </div>
                                                    </div>
                                                    <div class="row">
                                                      <div class="col-md-12">
                                                        <div class="overlay-bottm-1 p-2">
                                                            <ul class="bottom-1-list pt-10 pb-10">
                                                                <li><a href="{{url('create/ads')}}">বিজ্ঞাপন দিন</a></li>
                                                                <li><a href="{{url('job/post')}}">চাকরির খবর</a></li>
                                                                <li><a href="{{url('amader/sera')}}">আমাদের সেরা</a></li>
                                                            </ul>
                                                            <div class="overlay-info-line pt-10 pb-10">
                                                                <ul class="info-list">
                                                                  
                                                                   <!--  <li><a href="#"><span class="info-icon"><img src="{{asset('contents/website')}}/img/icons/2221_icon.png" alt=""></span>2222</a></li>
                                                                    <li><a href="#"><span class="info-icon"><img src="{{asset('contents/website')}}/img/icons/trust_icon.png" alt=""></span>ট্রাস্ট</a></li> -->

                                                                    <li><a href="#"><span class="info-icon"><img src="{{asset('contents/website')}}/img/icons/pchinta_icon.png" alt=""></span>প্রতিচিন্তা</a></li>
                                                                    <li><a href="#"><span class="info-icon"><img src="{{asset('contents/website')}}/img/icons/kiaa.png" alt=""></span>কিশোর আলো</a></li>
                                                                    <li><a href="#"><span class="info-icon"><img src="{{asset('contents/website')}}/img/icons/bandhu.png" alt=""></span></a></li>
                                                                    <li><a href="#"><span class="info-icon"><img src="{{asset('contents/website')}}/img/icons/pAlo.png" alt=""></span></a></li>
                                                                </ul>
                                                            </div>
                                                        </div><!-- End overlay bottom 1 -->
                                                      </div>
                                                    </div>
                                                  </div>
                                              </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
        						</nav>
                </div>
                </div>
            </div>
        </div>
    </div>


@yield('content')


    <div class="footer-top-section section bg-dark-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                  <div class="row">
                  @php
                      $allcat=App\Category:: where('status',1)->limit(12)->get();
                  @endphp
                    @foreach($allcat as $data)
                    <div class="col-md-2">
                        <ul class="menu-list">
                            <li><a href="{{url('category/'.$data->slug)}}" style="color: #fff;    margin-bottom: 18px;">{{$data->name}}</a></li>
                        </ul>
                    </div>
                    @endforeach
                  </div>
                </div>

                <div class="col-md-2">
                  <ul class="menu-list">
                    <li><a href="{{url('gallery')}}" style="color: #fff"><i class="fa fa-camera" aria-hidden="true"></i> ছবি</a></li>
                    <li><a href="{{url('videos')}}" style="color: #fff"><i class="fa fa-video-camera" aria-hidden="true"></i> ভিডিও</a></li>
                  </ul>
                  </div>
            </div>  
            <div class="row">
              <div class="col-md-12">
                <div class="overlay-bottm-1 p-2">
                    <ul class="bottom-1-list pt-10 pb-10">
                        <li><a href="{{url('create/ads')}}" style="color: #fff">বিজ্ঞাপন</a></li>
                    </ul>
                    <div class="overlay-info-line pt-10 pb-10">
                        <ul class="info-list">
                          
                           <!--  <li><a href="#"><span class="info-icon"><img src="{{asset('contents/website')}}/img/icons/2221_icon.png" alt=""></span>2222</a></li>
                            <li><a href="#"><span class="info-icon"><img src="{{asset('contents/website')}}/img/icons/trust_icon.png" alt=""></span>ট্রাস্ট</a></li> -->

                            <li><a href="#"  style="color:#fff"><span class="info-icon"><img src="{{asset('contents/website')}}/img/icons/pchinta_icon.png" alt=""></span>প্রতিচিন্তা</a></li>
                            <li><a href="#"  style="color:#fff"><span class="info-icon"><img src="{{asset('contents/website')}}/img/icons/kiaa.png" alt=""></span>কিশোর আলো</a></li>
                            <li><a href="#"  style="color:#fff"><span class="info-icon"><img src="{{asset('contents/website')}}/img/icons/bandhu.png" alt=""></span></a></li>
                            <li><a href="#"  style="color:#fff"><span class="info-icon"><img src="{{asset('contents/website')}}/img/icons/pAlo.png" alt=""></span></a></li>
                        </ul>
                    </div>
                </div><!-- End overlay bottom 1 -->
              </div>
            </div>          
          </div>
        </div>
    </div>
    <div class="footer-bottom-section section bg-dark">
        <div class="container">
            <div class="row">
                <div class="copyright text-center col">
                    <p>Copyright © <?php echo date('Y');?> Devs Takbir All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="{{asset('contents/website')}}/js/player/simplePlayer.js"></script>
<script src="{{asset('contents/website')}}/js/popper.min.js"></script>
<script src="{{asset('contents/website')}}/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="{{asset('contents/website')}}/js/video-player/plyr.min.js"></script>
<script src="https://www.youtube.com/iframe_api"></script>
<script src="{{asset('contents/website')}}/js/video-player/plyr.polyfilled.min.js"></script>
<script src="{{asset('contents/website')}}/js/plugins.js"></script>
<script src="{{asset('contents/website')}}/js/ajax-mail.js"></script>
<script src="{{asset('contents/website')}}/js/custom-ytplayer/youCover.js"></script>
<script src="{{asset('contents/website')}}/js/scrollProgress.js"></script>
<script src="{{asset('contents/website')}}/js/main.js"></script>



        <script src="{{asset('contents/website')}}/takbir/js/vendor/modernizr-3.5.0.min.js"></script>
        <script src="{{asset('contents/website')}}/takbir/js/vendor/jquery-3.2.1.min.js"></script>
        <script src="{{asset('contents/website')}}/takbir/js/popper.min.js"></script>
        <script src="{{asset('contents/website')}}/takbir/js/owl.carousel.min.js"></script>
        <script src="{{asset('contents/website')}}/takbir/js/plugins.js"></script>
        <script src="{{asset('contents/website')}}/takbir/js/main.js"></script>




    <script>
        window.onscroll = function() {myFunction()};

        var navbar = document.getElementById("navbar");
        var sticky = navbar.offsetTop;

        function myFunction() {
          if (window.pageYOffset >= sticky) {
            navbar.classList.add("sticky")
          } else {
            navbar.classList.remove("sticky");
          }
        }


    </script>
<script>
   jQuery(function(e) {
    function s(e) {
        var s = 1 === e.data,
            a = 2 === e.data,
            o = 0 === e.data;
        s && (i.removeClass("is-paused"), i.toggleClass("is-playing")), a && (i.removeClass("is-playing"), i.toggleClass("is-paused")), o && i.removeClass("is-playing", "is-paused")
    }
    var a, o = e(window),
        t = e("#featured-media"),
        i = e("#featured-video"),
        n = t.offset().top,
        l = Math.floor(n + t.outerHeight() / 2);
    window.onYouTubeIframeAPIReady = function() {
        a = new YT.Player("featured-video", {
            events: {
                onStateChange: s
            }
        })
    }, o.on("resize", function() {
        n = t.offset().top, l = Math.floor(n + t.outerHeight() / 2)
    }).on("scroll", function() {
        i.toggleClass("is-sticky", o.scrollTop() > l && i.hasClass("is-playing"))
    });
    $('.btn-toggle').click(function(){
        $(this).text(function(i,old){
            return old=='View Comment' ?  'Hide Comment' : 'View Comment';
        });
    });

});
</script>


<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v7.0"></script>
</body>

</html>
