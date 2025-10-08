@extends('layouts.website') 
@section('content')
    <!-- Post Section Start -->
    <div class="post-section section mt-30">
        <div class="container">
        	<!-- Row post1 Start -->
            <div class="row">
                <!-- Col-8 Start -->
                <div class="col-lg-8 co-md-8 col-12 left-content">
                    <div class="ehow-top">
                        <div class="row mb-20">
                            @foreach($Leadnews as $data)
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="post post-large post-overlay">
                                    <div class="post-wrap ehow-content">
                                        <div class="image"><img src="{{asset('post/'.$data->image)}}" alt="post"></div>
                                        <div class="content full">
                                            <h2 class="title"><a href="{{url('/post/view/'.$data->id)}}" tabindex="0">{{str_limit($data->title,30)}}</a></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             @endforeach
                        </div>

                        <div class="row mt-30 mb-10">
                            @foreach($bodynews as $data)
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="post fixed-post-height-md box-shadow-post bg-white pb-15 mb-20">
                                    <div class="post-wrap">
                                        <a class="image" href="{{url('/post/view/'.$data->id)}}"><img src="{{asset('post/'.$data->image)}}" alt="post"></a>
                                        <div class="content">
                                            <a href="{{url('/post/view/'.$data->id)}}">
                                            <h5 class="sub-title">{{str_limit($data->sub_title,40)}}</h5>
                                            <h4 class="title">{{str_limit($data->title,30)}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                    </div>
                </div>

                <!-- Col-4 Start -->
                <div class="col-lg-4 col-md-4 sidebar col-12 mb-50">
                    <div class="sec-5-1-left m-top-0 bg-white">
                        <div class="head sec-head column-head">
                            <!-- Title -->
                            <h4 class="title pl-2">ভিডিও</h4>
                        </div>
                        <div class="right-bar-post-list mt-10">
                           @foreach($allvideo as $video)
                            <div class="post v-post post-small post-mr-sm post-list feature-post post-separator-border">
                               <div class="post-wrap pr-2 bg-white">
                                    <div class="content">
                                        <h5 class="title"><a href="{{url('/view-video/'.$video->id)}}">{{str_limit($video->title,30)}}</a></h5>
                                    </div>
                                    <!-- Image -->
                                    <a class="image videos-post" href="{{url('/view-video/'.$video->id)}}"><img src="{{asset('uploads/video/'.$video->image)}}" alt="post" style="height: 73px;">
                                        <span class="video-btn video-post-icon v-sm-post">
                                            <i class="fa fa-play"></i>
                                            <span class="v_lenth leth-sm">{{$video->duration}}</span>
                                        </span>
                                    </a>

                              </div>
                            </div>

                            @endforeach
                        </div><!-- Right-bar-post-list End -->

                    </div>
                </div><!-- Col-3 End -->
                
            </div><!--Row post1 End-->
        </div><!-- Container End -->
    </div><!-- Post Section End -->

    <!-- Post Section Start -->
    <div class="post-section section pb-10 mt-20">
        <div class="container">
            <div class="head sec-head border-btm cat-top-border">
                <div class="d-flex bd-highlight">
                  <div class="mr-auto p-0 bd-highlight custom-width">
                    <div class="head sec-head column-head cat-head">
                        <!-- Title -->
                        <h4 class="title">সম্পাদকের পছন্দ</h4>
                    </div>
                  </div>
                  <div class="p-1 bd-highlight">
                    <a href="{{url('/')}}" class="more-cat-news">আরো পড়ুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                  </div>
                </div>
            </div>


            <div class="row space-sm mt-10">
                @php 
                $centerpost=App\Post:: where('status',1)->where('manage',2)->orderBy('id','desc')->limit(1)->get(); @endphp 
                @foreach($centerpost as $centerpost)
                <div class="col-lg-2 col-md-2 col-12 pd-5">
                    <!-- Post Start -->
                    <div class="post sm-post mb-20">
                        <div class="post-wrap bg-white pb-15">
                            <a class="image" href="{{url('post-view/'.$centerpost->id)}}"><img src="{{asset('post/'.$centerpost->image)}}" alt="post"></a>
                            <div class="content p-2">
                                <h5 class="title title-md-1"><a href="{{url('post-view/'.$centerpost->id)}}">{{str_limit($centerpost->title,20)}}</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>

    <!-- Post Section Start -->
    <div class="post-section section mt-30">
        <div class="container">
            <div class="row">
                <!-- Col-lg-8 Start -->
                <div class="col-lg-8 co-md-8 col-12 left-content">
                    <!-- Cat Gen Start -->
                    <div class="cat-gen-post">
                        <div class="row">
                            @foreach($allpsot as $data)
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="post fixed-post-height-md box-shadow-post bg-white videos-single-post mb-20">
                                    <div class="post-wrap">
                                        <div class="cat-tag-news">
                                            <a class="image videos-post" href="{{url('post/view/'.$data->id)}}"><img src="{{asset('post/'.$data->image)}}" alt="post">

                                            </a>
                                        </div>
                                        <div class="content text-off-white">
                                            <a href="{{url('post/view/'.$data->id)}}">
                                                 <h5 class="sub-title">{{str_limit($data->sub_title,30)}}</h5>
                                                <h4 class="title">{{str_limit($data->title,30)}}</h4>
                                            </a>
                                        </div>
                                        
                                    </div><!-- Post wrap End -->
                                </div>
                            </div><!-- Col 4 End -->
                            @endforeach
                        </div><!-- Row End -->
                        <div class="load-more-btn text-center mt-10">
                            <button id="load_more" class="btn btn-default box-shadow-post">আরো দেখুন</button>
                        </div>
                    </div><!-- Cat Gen End -->
                </div><!-- Col-lg-8 End -->
                <!-- Col-lg-4 Start -->
                <div class="col-lg-4 col-md-4 sidebar col-12">

                    <div class="right-bar">
                        <div class="subscrive-form bg-dark p-3 mb-30">
                            <h3>সাবসক্রাইব</h3>
                           <form action="" class="subs_form">
                               <fieldset>
                                  <input placeholder="Your Email Address" type="email" tabindex="2" required="">
                                </fieldset>
                                <fieldset>
                                    <span>
                                    <input type="radio" id="test1" name="radio-group" checked="">
                                    <label for="test1">daily</label>
                                  </span>
                                  <span>
                                    <input type="radio" id="test2" name="radio-group">
                                    <label for="test2">Weekly</label>
                                  </span>
                                </fieldset>
                                <fieldset>
                                  <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Subscribe</button>
                                </fieldset>
                           </form>
                        </div><!-- Subscribe End -->

                        
                        <!-- Post Block Wrapper Start -->
                        <div class="post-block-wrapper right-bar-tab bg-white">

                            <!-- Post Block Head Start -->
                            <div class="head sports-head">

                                <!-- Title -->
                                <h5 class="title pl-2">জনপ্রিয় পোস্ট</h5>

                                <!-- Tab List Start -->
                                <ul class="post-block-tab-list sports-post-tab-list nav d-md-block">
                                    <li><a class="active" data-toggle="tab" href="#week">দিন</a></li>
                                    <li><a data-toggle="tab" href="#month">সপ্তাহ</a></li>
                                    <li><a data-toggle="tab" href="#year">মাস</a></li>

                                </ul><!-- Tab List End -->

                            </div><!-- Post Block Head End -->

                            <!-- Post Block Body Start -->
                            <div class="body pb-10 mt-10">
                                <div class="tab-content">

                                    <div class="tab-pane fade show active" id="week">
                                       <div class="tab-post">
                                           <div class="right-bar-post-list">
                                                @foreach($mostView as $data)
                                                <div class="post v-post post-small post-mr-sm post-list feature-post post-separator-border">
                                                   <div class="post-wrap pr-2 bg-white">
                                                    <div class="content">
                                                        <h5 class="title"><a href="{{url('post/view/'.$data->id)}}">{{str_limit($data->title,50)}}</a></h5>
                                                    </div>
                                                    <a class="image videos-post" href="{{url('post/view/'.$data->id)}}"><img src="{{asset('post/'.$data->image)}}" style="height: 80px;">
                                                    </a>
                                                  </div>
                                                </div><!-- Post Post small End -->
                                                @endforeach
                                            </div><!-- Right-bar-post-list End -->
                                       </div><!-- Tab post End -->
                                    </div><!-- Tab Pane End-->



                                </div><!-- Tab Content End-->

                            </div><!-- Post Block Body End -->

                        </div><!-- Post Block Wrapper End -->

                        
                    </div>
                </div> <!-- Col-lg-4 End -->
            </div><!-- Row End -->
        </div><!-- Container End -->
    </div><!-- Post Section End -->



    <!-- Post Section Start -->
    <div class="post-section section sec-10 mt-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 co-md-8 col-12 left-content">
                    <div class="single-col-cat-post">
                        <div class="row">
                
                            <div class="col-lg-4 col-md-6 col-12 mb-20">
                                
                                 <div class="sec-5-1-left b-color-2 bg-white right-bar-post mt-0">
                                    <div class="head sec-head column-head pl-2 pr-2">
                                        <!-- Title -->
                                        <h4 class="title">{{$onecategorys->name}}</h4>
                                        <a href="#" class="more-cat-news no-line">আরো পড়ুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                    </div>


                                  <!--   <div class="post post-separator-border bg-white post-b-bottom">
                                      <div class="post-wrap pb-15 mt-10 mb-0">
                                        <a class="image" href="post-details.html"><img src="img/post/post-31.jpg" alt="post"></a>

                                        <div class="content text-off-white">


                                            <a href="#">
                                                 <h5 class="sub-title">এ বছর ঘোষণা</h5>

                                                <h4 class="title">হুইসেল কুইন থেকে শিস প্রিয়া, অবন্তী সিঁথি</h4>
                                           
                                            </a>

                                        </div>
                                    
                                       </div>
                                    </div>
 -->
                                    
                                    <!-- Right bar post list Start -->
                                    <div class="right-bar-post-list">

                                        @foreach($onecategorys->posts as $onecategory)
                                        <div class="post post-small post-mr-sm post-list feature-post post-separator-border">
                                           <div class="post-wrap pr-2 pl-2 pt-2 bg-white mb-0">
                                            <div class="content">
                                                <h5 class="title"><a href="{{url('/post/view/'.$onecategory->id)}}">{{str_limit($onecategory->title,30)}}</a></h5>
                                            </div>
                                            
                                          </div>
                                        </div><!-- Post Post small End -->

                                        @endforeach
                                    </div><!-- Right bar post list End -->

                                </div><!-- Sec-5-1 Right-bar-post -->
                                
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-12 mb-20">
                                
                               <div class="sec-5-1-left b-color-2 bg-white right-bar-post mt-0">
                                    <div class="head sec-head column-head pl-2 pr-2">
                                        <!-- Title -->
                                        <h4 class="title">{{$twocategorys->name}}</h4>
                                        <a href="#" class="more-cat-news no-line">আরো পড়ুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                    </div>
                                    <!-- Post Start -->
                                    
                                    
                                    <!-- Right bar post list Start -->
                                    <div class="right-bar-post-list">

                                        @foreach($twocategorys->posts as $twocategory)
                                        <div class="post post-small post-mr-sm post-list feature-post post-separator-border">
                                           <div class="post-wrap pr-2 pl-2 pt-2 bg-white mb-0">
                                            <div class="content">
                                                <h5 class="title"><a href="{{url('/post/view/'.$twocategory->id)}}">{{str_limit($twocategory->title,30)}}</a></h5>
                                            </div>
                                            
                                          </div>
                                        </div><!-- Post Post small End -->

                                        @endforeach

                                    </div><!-- Right bar post list End -->

                                </div><!-- Sec-5-1 Right-bar-post -->
                                
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-12 mb-20">
                                
                                <div class="sec-5-1-left b-color-2 bg-white right-bar-post mt-0">
                                    <div class="head sec-head column-head pl-2 pr-2">
                                        <!-- Title -->
                                        <h4 class="title">{{$threecategorys->name}}</h4>
                                        <a href="#" class="more-cat-news no-line">আরো পড়ুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                    </div>
                                    <!-- Post Start -->
                                    
                                    
                                    <!-- Right bar post list Start -->
                                    <div class="right-bar-post-list">
                                        @foreach($threecategorys->posts as $threecategory)
                                        <div class="post post-small post-mr-sm post-list feature-post post-separator-border">
                                           <div class="post-wrap pr-2 pl-2 pt-2 bg-white mb-0">
                                            <div class="content">
                                                <h5 class="title"><a href="{{url('/post/view/'.$threecategory->id)}}">{{str_limit($threecategory->title,30)}}</a></h5>
                                            </div>
                                            
                                          </div>
                                        </div><!-- Post Post small End -->

                                        @endforeach
                                    </div><!-- Right bar post list End -->

                                </div><!-- Sec-5-1 Right-bar-post -->
                                
                            </div>
                        </div><!-- Row End -->
                    </div><!-- Single Col Cat Post End -->

                </div><!-- Col-8 End -->

                <div class="col-lg-4 col-md-4 sidebar col-12">
                    <div class="right-bar">
                        <!-- <div class="social-follow bg-grey p-3 bg-white box-shadow-post">
                            <p>Follow us on..</p>
                            <div class="footer-social mb-10">
                                <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                                <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                                <a href="#" class="dribbble"><i class="fa fa-dribbble"></i></a>
                                <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                                <a href="#" class="rss"><i class="fa fa-rss"></i></a>
                                <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                                <a href="#" class="pinterest"><i class="fa fa-pinterest-p"></i></a>                          
                            </div>
                            <div class="app_dload">
                                <a href="#" class="app-download"> <img src="img/android-app.png" alt=""></a>
                                <a href="#" class="app-download"><img src="img/app_store.png" alt=""></a>
                            </div>
                        </div> --><!-- Social Follow btn End -->
                       
                        <div class="review-card">
                           @php
                             $bigvideo=App\Video:: where('manage',7)->orderBy('id','desc')->limit(1)->get(); @endphp 
                             @foreach($bigvideo as $big)
                            <div class="card top-review mt-10">
                                <div class="head sec-head column-head review-head">
                                    <h4 class="title">স্পটলাইট</h4>
                                    <a href="{{url('/spotlight/videos')}}" class="more-cat-news no-line">আরো দেখুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                </div>
                                <a href="{{url('/view-video/'.$big->id)}}">
                                  <img class="card-img-top" src="{{asset('uploads/video/'.$big->image)}}" alt="Card image cap" style="height: 300px;">
                                  <div class="card-body top-review-body">
                                    <h2>{{str_limit($big->title,40)}}</h2>
                                    <p>{{str_limit($big->subtitle,50)}}</p>
                                  </div>
                                  </a>
                            </div>
                            @endforeach

                        </div><!-- Review card End -->
                    </div><!-- Right bar End -->
                </div><!-- Col-4 End -->
            </div><!-- Row End -->
        </div><!-- Container End -->
    </div><!-- Post Section End -->


    <!-- Section Start -->
    <div class="section pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 co-md-8 col-12 left-content">
                    <div class="cat-sec sec-5-1-left cat-top-border mb-20">

                        <div class="head sec-head column-head">
                            <!-- Title -->
                            <h4 class="title">{{$fourcategorys->name}}</h4>
                            <a href="#" class="more-cat-news no-line">আরো পড়ুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                        </div>
                        
                        <div class="row mt-10">
                            @foreach($fourcategorys->posts->take(4) as $fourcategory)
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="post fixed-post-height-md box-shadow-post bg-white mb-10">
                                    <div class="post-wrap">
                                        <a class="image" href="{{url('/post/view/'.$fourcategory->id)}}"><img src="{{asset('post/'.$fourcategory->image)}}" alt="post"></a>
                                        <div class="content">
                                            <h4 class="title"><a href="{{url('/post/view/'.$fourcategory->id)}}">{{str_limit($fourcategory->title,30)}}</a></h4>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- Col-lg-4 End -->
                            @endforeach
                        </div><!-- Row End -->
                    </div>
                    
                         <div class="single-col-cat-post">
                            <div class="row">
                    
                               <div class="col-lg-4 col-md-6 col-12 mb-20">
                                
                                 <div class="sec-5-1-left b-color-2 bg-white right-bar-post mt-0">
                                    <div class="head sec-head column-head pl-2 pr-2">
                                        <!-- Title -->
                                        <h4 class="title">{{$fivecategorys->name}}</h4>
                                        <a href="#" class="more-cat-news no-line">আরো পড়ুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                    </div>


                                  <!--   <div class="post post-separator-border bg-white post-b-bottom">
                                      <div class="post-wrap pb-15 mt-10 mb-0">
                                        <a class="image" href="post-details.html"><img src="img/post/post-31.jpg" alt="post"></a>

                                        <div class="content text-off-white">


                                            <a href="#">
                                                 <h5 class="sub-title">এ বছর ঘোষণা</h5>

                                                <h4 class="title">হুইসেল কুইন থেকে শিস প্রিয়া, অবন্তী সিঁথি</h4>
                                           
                                            </a>

                                        </div>
                                    
                                       </div>
                                    </div>
 -->
                                    
                                    <!-- Right bar post list Start -->
                                    <div class="right-bar-post-list">

                                        @foreach($fivecategorys->posts as $fivecategory)
                                        <div class="post post-small post-mr-sm post-list feature-post post-separator-border">
                                           <div class="post-wrap pr-2 pl-2 pt-2 bg-white mb-0">
                                            <div class="content">
                                                <h5 class="title"><a href="{{url('/post/view/'.$fivecategory->id)}}">{{str_limit($fivecategory->title,30)}}</a></h5>
                                            </div>
                                            
                                          </div>
                                        </div><!-- Post Post small End -->

                                        @endforeach
                                    </div><!-- Right bar post list End -->

                                </div><!-- Sec-5-1 Right-bar-post -->
                                
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-12 mb-20">
                                
                               <div class="sec-5-1-left b-color-2 bg-white right-bar-post mt-0">
                                    <div class="head sec-head column-head pl-2 pr-2">
                                        <!-- Title -->
                                        <h4 class="title">{{$sixcategorys->name}}</h4>
                                        <a href="#" class="more-cat-news no-line">আরো পড়ুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                    </div>
                                    <!-- Post Start -->
                                    
                                    
                                    <!-- Right bar post list Start -->
                                    <div class="right-bar-post-list">

                                        @foreach($sixcategorys->posts as $sixcategory)
                                        <div class="post post-small post-mr-sm post-list feature-post post-separator-border">
                                           <div class="post-wrap pr-2 pl-2 pt-2 bg-white mb-0">
                                            <div class="content">
                                                <h5 class="title"><a href="{{url('/post/view/'.$sixcategory->id)}}">{{str_limit($sixcategory->title,30)}}</a></h5>
                                            </div>
                                            
                                          </div>
                                        </div><!-- Post Post small End -->

                                        @endforeach

                                    </div><!-- Right bar post list End -->

                                </div><!-- Sec-5-1 Right-bar-post -->
                                
                            </div>
                            
                            <div class="col-lg-4 col-md-6 col-12 mb-20">
                                
                                <div class="sec-5-1-left b-color-2 bg-white right-bar-post mt-0">
                                    <div class="head sec-head column-head pl-2 pr-2">
                                        <!-- Title -->
                                        <h4 class="title">{{$sevencategorys->name}}</h4>
                                        <a href="#" class="more-cat-news no-line">আরো পড়ুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                    </div>
                                    <!-- Post Start -->
                                    
                                    
                                    <!-- Right bar post list Start -->
                                    <div class="right-bar-post-list">
                                        @foreach($sevencategorys->posts as $sevencategory)
                                        <div class="post post-small post-mr-sm post-list feature-post post-separator-border">
                                           <div class="post-wrap pr-2 pl-2 pt-2 bg-white mb-0">
                                            <div class="content">
                                                <h5 class="title"><a href="{{url('/post/view/'.$sevencategory->id)}}">{{str_limit($sevencategory->title,30)}}</a></h5>
                                            </div>
                                            
                                          </div>
                                        </div>

                                        @endforeach
                                    </div><!-- Right bar post list End -->

                                </div><!-- Sec-5-1 Right-bar-post -->
                            </div><!-- Row End -->
                        </div><!-- Single Col Cat Post End --> 
                    </div><!-- End left-content -->
                <div class="col-lg-4 col-md-4 sidebar col-12"></div><!-- End Sidebar -->
            </div><!-- End Row -->
        </div><!-- End Container -->
    </div><!-- Section End -->

<div class="recent-section section mt-20 pb-50">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="post-block-wrapper trending-walker">
                    <div class="head trending">
                        <h4 class="title">ট্রেন্ডিং টপিক্স</h4>
                    </div>
                    <div class="body trending-body mt-10">
                        <div class="three-column-post-carousel column-post-carousel post-block-carousel dark life-style-post-carousel row space-sm">
                            @foreach($taending as $taending)
                            <div class="post trending-post col pd-5">
                                <div class="post-wrap min-post-height-sm box-shadow-post bg-white ">
                                    <a class="image" href="#"><img src="{{asset('uploads/tag/'.$taending->image)}}" alt="post"></a>
                                    <div class="content p-1 mt-5">
                                        <h5 class="title"><a href="post-details.html">{{$taending->name}}</a></h5>
                                    </div>
                                    <div class="d-flex justify-content-between trending-btm">
                                        <div class="p-2 so_thumbs">
                                            <img src="https://relayfm.s3.amazonaws.com/uploads/user/avatar/66/user_avatar_katiefloyd_artwork.png" alt="">
                                        </div>
                                        <div class="p-2 view-btn">
                                            <a href="#" class="btn btn-primary custom-btn btn-sm btn-xs">পড়ুন <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection