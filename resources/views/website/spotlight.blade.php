@extends('layouts.website') @section('content')
    <div class="post-section section mt-30">
        <div class="container">
        	<!-- Row post1 Start -->
            <div class="row">
                <!-- Col-8 Start -->
                <div class="col-lg-8 co-md-8 col-12 left-content">
                    <div class="ehow-top">
                     <div class="related-btn-post">
                    </div>
                        <div class="row ehow-top-3col">
                          @foreach($spotlight as $video)
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="post fixed-post-height-md box-shadow-post bg-white videos-single-post mb-20">
                                    <div class="post-wrap">
                                        <div class="cat-tag-news">
                                            <a class="image videos-post" href="{{url('/view-video/'.$video->id)}}"><img src="{{asset('uploads/video/'.$video->image)}}" alt="post" style="height:190px">
                                                <span class="video-btn video-post-icon v-sm-post">
                                                    <i class="fa fa-play"></i>
                                                    <span class="v_lenth leth-sm">2.02</span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="content text-off-white">
                                            <a href="{{url('/view-video/'.$video->id)}}">
                                                 <h5 class="sub-title">{{str_limit($video->subtitle,25)}}</h5>
                                                <h4 class="title">{{str_limit($video->title,40)}}</h4>
                                            </a>
                                        </div>
                                    </div><!-- Post wrap End -->
                                </div>
                            </div><!-- Col 4 End -->
                            @endforeach

                        </div><!-- Row End -->
                    </div><!-- eHow End -->
                </div><!-- Col-8 End -->

                <div class="col-lg-4 col-md-4 sidebar col-12">
                    <div class="post-block-wrapper right-bar-tab bg-white">
                        <div class="head sports-head">
                            <h5 class="title pl-2">টপ ভিডিও</h5>
                            <ul class="post-block-tab-list sports-post-tab-list nav d-md-block">
                                <li><a class="active" data-toggle="tab" href="#week">দিন</a></li>
                                <li><a data-toggle="tab" href="#month">সপ্তাহ</a></li>
                                <li><a data-toggle="tab" href="#year">মাস</a></li>
                            </ul>
                        </div>
                        <div class="body pb-10 mt-10">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="week">
                                   <div class="tab-post">
                                       <div class="right-bar-post-list">
                                         @foreach($mostView as $data)
                                            <div class="post v-post post-small post-mr-sm post-list feature-post post-separator-border">
                                               <div class="post-wrap pr-2 bg-white">
                                                    <div class="content">
                                                        <h5 class="title"><a href="{{url('/view-video/'.$data->id)}}">{{$data->title}}</a></h5>
                                                    </div>
                                                    <a class="image videos-post" href="{{url('/view-video/'.$data->id)}}"><img src="{{asset('uploads/video/'.$data->image)}}" alt="post" style="height:80px">
                                                        <span class="video-btn video-post-icon v-sm-post">
                                                            <i class="fa fa-play"></i>
                                                            <span class="v_lenth leth-sm">2.02</span>
                                                        </span>
                                                    </a>
                                              </div>
                                            </div>
                                          @endforeach
                                        </div>
                                   </div>
                                </div>

                            </div>
                        </div>
                    </div><!-- Post Block Wrapper End -->
                </div><!-- Col-3 End -->
            </div><!--Row post1 End-->
        </div><!-- Container End -->
    </div><!-- Post Section End -->
    </div>

    <!-- Post Section Start -->
    <div class="post-section section mt-30">
        <div class="container">
            <div class="row">
                <!-- Col-lg-8 Start -->
                <div class="col-lg-8 co-md-8 col-12 left-content">

                    <div class="row">
                        <div class="col-12">
                            <div class="post-block-wrapper inline-post-carousel cat-sec sec-5-1-left cat-top-border mt-0">
                                <div class="head sec-head column-head">
                                    <h4 class="title">ক্যাটাগরি ক্যাটাগরি {{$sevencategorys->name}}</h4>
                                    <a href="{{url('category/'.$sevencategorys->slug)}}" class="more-cat-news no-line">আরো পড়ুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                </div>
                                <div class="body">
                                    <div class="video-post-slider post-block-carousel v-slide-post row space-sm">
                                      @foreach($sevencategorys->posts->take(4) as $sevencategory)
                                      <div class="col-lg-6 col-md-6 col-12">
                                          <div class="post fixed-post-height-md box-shadow-post bg-white mb-10">
                                              <div class="post-wrap">
                                                  <a class="image" href="{{url('post/view/'.$sevencategory->id)}}"><img src="{{asset('post/'.$sevencategory->image)}}" style="height:160px"></a>
                                                  <div class="content">
                                                      <h4 class="title"><a href="{{url('post/view/'.$sevencategory->id)}}">{{str_limit($sevencategory->title,110)}}</a></h4>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      @endforeach
                                    </div><!-- Sidebar Post Slider End -->

                                </div><!-- Post Block Body End -->

                            </div><!-- Post Block Wrapper End -->
                        </div><!-- Col-12 End -->
                    </div><!-- Row End -->


<div class="row">
    <div class="col-12">
        <!-- Post Block Wrapper Start -->
        <div class="post-block-wrapper inline-post-carousel cat-sec sec-5-1-left cat-top-border mt-0">

            <!-- Post Block Head Start -->
            <div class="head sec-head column-head">

                <!-- Title -->
                <h4 class="title">ক্যাটাগরি {{$twocategorys->name}}</h4>
                <a href="{{url('category/'.$twocategorys->slug)}}" class="more-cat-news no-line">আরো পড়ুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>

            </div>
            <!-- Post Block Head End -->

            <!-- Post Block Body Start -->
            <div class="body">

                <!-- Sidebar Post Slider Start -->
                <div class="video-post-slider post-block-carousel v-slide-post row space-sm slick-initialized slick-slider">
                    <button type="button" class="slick-prev slick-arrow" style="display: block;"><i class="fa fa-chevron-left"></i></button>

                    <!-- Post Start -->
                    <div aria-live="polite" class="slick-list draggable">
                        <div class="slick-track" role="listbox" style="opacity: 1; width: 2795px; transform: translate3d(-860px, 0px, 0px);">
                            <div class="post sm-grid sm-post mb-20 col slick-slide slick-cloned" data-slick-index="-4" aria-hidden="true" tabindex="-1" style="width: 215px;">
                                <div class="car-post fixed-post-height-xs box-shadow-post bg-white">
                                    <div class="post-wrap img-wrap">

                                        <!-- Image -->
                                        <a class="image videos-post" href="#" tabindex="-1"><img src="img/post/post-51.jpg" alt="post">
                                            <span class="video-btn video-post-icon v-sm-post">
                                                        <i class="fa fa-play"></i>
                                                        <span class="v_lenth leth-sm">2.02</span>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="post-wrap content-wrap">
                                        <!-- Content -->
                                        <div class="content">

                                            <!-- Title -->
                                            <h4 class="title"><a href="post-details.html" tabindex="-1">এ বছর ঘোষণা করা হবে দু’টি নোবেল সাহিত্য পুরস্কার</a></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="post sm-grid sm-post mb-20 col slick-slide slick-cloned" data-slick-index="-3" aria-hidden="true" tabindex="-1" style="width: 215px;">
                                <div class="car-post fixed-post-height-xs box-shadow-post bg-white">
                                    <div class="post-wrap img-wrap">

                                        <!-- Image -->
                                        <a class="image videos-post" href="#" tabindex="-1"><img src="img/post/post-51.jpg" alt="post">
                                            <span class="video-btn video-post-icon v-sm-post">
                                                        <i class="fa fa-play"></i>
                                                        <span class="v_lenth leth-sm">2.02</span>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="post-wrap content-wrap">
                                        <!-- Content -->
                                        <div class="content">

                                            <!-- Title -->
                                            <h4 class="title"><a href="post-details.html" tabindex="-1">এ বছর ঘোষণা করা হবে দু’টি নোবেল সাহিত্য পুরস্কার</a></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="post sm-grid sm-post mb-20 col slick-slide slick-cloned" data-slick-index="-2" aria-hidden="true" tabindex="-1" style="width: 215px;">
                                <div class="car-post fixed-post-height-xs box-shadow-post bg-white">
                                    <div class="post-wrap img-wrap">

                                        <!-- Image -->
                                        <a class="image videos-post" href="#" tabindex="-1"><img src="img/post/post-51.jpg" alt="post">
                                            <span class="video-btn video-post-icon v-sm-post">
                                                        <i class="fa fa-play"></i>
                                                        <span class="v_lenth leth-sm">2.02</span>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="post-wrap content-wrap">
                                        <!-- Content -->
                                        <div class="content">

                                            <!-- Title -->
                                            <h4 class="title"><a href="post-details.html" tabindex="-1">এ বছর ঘোষণা করা হবে দু’টি নোবেল সাহিত্য পুরস্কার</a></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="post sm-grid sm-post mb-20 col slick-slide slick-cloned" data-slick-index="-1" aria-hidden="true" tabindex="-1" style="width: 215px;">
                                <div class="car-post fixed-post-height-xs box-shadow-post bg-white">
                                    <div class="post-wrap img-wrap">

                                        <!-- Image -->
                                        <a class="image videos-post" href="#" tabindex="-1"><img src="img/post/post-51.jpg" alt="post">
                                            <span class="video-btn video-post-icon v-sm-post">
                                                        <i class="fa fa-play"></i>
                                                        <span class="v_lenth leth-sm">2.02</span>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="post-wrap content-wrap">
                                        <!-- Content -->
                                        <div class="content">

                                            <!-- Title -->
                                            <h4 class="title"><a href="post-details.html" tabindex="-1">এ বছর ঘোষণা করা হবে দু’টি নোবেল সাহিত্য পুরস্কার</a></h4>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            @foreach($twocategorys->posts->take(4) as $twocategory)
                            <div class="post sm-grid sm-post mb-20 col slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide20" style="width: 215px;">
                                <div class="car-post fixed-post-height-xs box-shadow-post bg-white">
                                    <div class="post-wrap img-wrap">
                                      <a class="image" href="{{url('post/view/'.$twocategory->id)}}"><img src="{{asset('post/'.$twocategory->image)}}" style="height:160px;"></a>
                                    </div>
                                    <div class="post-wrap content-wrap">
                                        <div class="content">
                                        <h4 class="title"><a href="{{url('post/view/'.$twocategory->id)}}">{{str_limit($twocategory->title,66)}}</a></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <button type="button" class="slick-next slick-arrow" style="display: block;"><i class="fa fa-chevron-right"></i></button>
                </div>
                <!-- Sidebar Post Slider End -->

            </div>
            <!-- Post Block Body End -->

        </div>
        <!-- Post Block Wrapper End -->
    </div>
    <!-- Col-12 End -->
</div>


                    <div class="row">
                        <div class="col-12">
                            <!-- Post Block Wrapper Start -->
                            <div class="post-block-wrapper inline-post-carousel cat-sec sec-5-1-left cat-top-border mt-0">

                                <!-- Post Block Head Start -->
                                <div class="head sec-head column-head">

                                  <h4 class="title">ক্যাটাগরি {{$threecategorys->name}}</h4>
                                  <a href="{{url('category/'.$threecategorys->slug)}}" class="more-cat-news no-line">আরো পড়ুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>

                                </div>
                                <div class="body">
                                    <div class="video-post-slider post-block-carousel v-slide-post row space-sm">
                                      @foreach($threecategorys->posts->take(4) as $threecategory)
                                      <div class="col-lg-4 col-md-4 col-12">
                                          <div class="post fixed-post-height-md box-shadow-post bg-white mb-10">
                                              <div class="post-wrap">
                                                  <a class="image" href="{{url('post/view/'.$threecategory->id)}}"><img src="{{asset('post/'.$threecategory->image)}}" style="height:160px;"></a>
                                                  <div class="content">
                                                      <h4 class="title"><a href="{{url('post/view/'.$threecategory->id)}}">{{str_limit($threecategory->title,60)}}</a></h4>
                                                  </div>
                                              </div>
                                          </div>
                                      </div><!-- Col-lg-4 End -->
                                      @endforeach
                                    </div><!-- Sidebar Post Slider End -->
                                </div><!-- Post Block Body End -->

                            </div><!-- Post Block Wrapper End -->
                        </div><!-- Col-12 End -->
                    </div><!-- Row End -->
                    <div class="row">
                        <div class="col-12">
                            <!-- Post Block Wrapper Start -->
                            <div class="post-block-wrapper inline-post-carousel cat-sec sec-5-1-left cat-top-border mt-0">

                                <!-- Post Block Head Start -->
                                <div class="head sec-head column-head">
                                  <h4 class="title">ক্যাটাগরি {{$fivecategorys->name}}</h4>
                                  <a href="{{url('category/'.$fivecategorys->slug)}}" class="more-cat-news no-line">আরো পড়ুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>

                                </div>
                                <div class="body">
                                    <div class="video-post-slider post-block-carousel v-slide-post row space-sm">
                                      @foreach($fivecategorys->posts->take(4) as $fivecategory)
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <div class="post fixed-post-height-md box-shadow-post bg-white mb-10">
                                                <div class="post-wrap">
                                                    <a class="image" href="{{url('post/view/'.$fivecategory->id)}}"><img src="{{asset('post/'.$fivecategory->image)}}"></a>
                                                    <div class="content">
                                                        <h4 class="title"><a href="{{url('post/view/'.$fivecategory->id)}}">{{str_limit($fivecategory->title,100)}}</a></h4>
                                                    </div>

                                                </div>
                                            </div>
                                        </div><!-- Col-lg-4 End -->
                                        @endforeach
                                    </div>
                                </div><!-- Post Block Body End -->

                            </div><!-- Post Block Wrapper End -->
                        </div><!-- Col-12 End -->
                    </div><!-- Row End -->
                </div><!-- Col-lg-8 End -->
                <!-- Col-lg-3 Start -->
                <div class="col-lg-4 col-md-4 sidebar col-12">
                    <div class="sec-5-1-left b-color-2 bg-white right-bar-post mt-0">
                        <div class="head sec-head column-head pl-2 pr-2">
                            <!-- Title -->
                            <h4 class="title">কলাম</h4>
                            <a href="#" class="more-cat-news no-line">আরো পড়ুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                        </div>
                        <!-- Post Start -->
                        <div class="post post-separator-border bg-white post-b-bottom">
                          <div class="post-wrap pb-15 mt-15 mb-0">

                            <!-- Image -->
                            <a class="image" href="post-details.html"><img src="{{asset('contents/website')}}/img/post/post-31.jpg" alt="post"></a>

                            <!-- Content -->
                            <div class="content">

                                <!-- Title -->
                                <h4 class="title"><a href="post-details.html">এ বছর ঘোষণা করা হবে দু’টি নোবেল সাহিত্য পুরস্কার</a></h4>

                            </div>

                           </div>
                        </div><!-- Post End -->

                        <!-- Right bar post list Start -->
                        <div class="right-bar-post-list">
                            <!-- Post Post small Start -->
                            <div class="post post-small post-mr-sm post-list feature-post post-separator-border">
                               <div class="post-wrap pr-2 pl-2 pt-2 bg-white mb-0">

                                <!-- Image -->
                                <a class="image img-sm" href="post-details.html"><img src="{{asset('contents/website')}}/img/post/post-13.jpg" alt="post"></a>

                                <!-- Content -->
                                <div class="content">

                                    <!-- Title -->
                                    <h5 class="title"><a href="post-details.html">নাটকটিতে বাকের ভাইয়ের নায়িকা সুবর্ণা মুস্তাফা।</a></h5>

                                    <!-- Meta -->
                                    <!-- <div class="meta fix">
                                        <span class="meta-item date"><i class="fa fa-clock-o"></i>10 March 2017</span>
                                    </div> -->

                                </div>

                              </div>
                            </div><!-- Post Post small End -->

                            <!-- Post Post small Start -->
                            <div class="post post-small post-mr-sm post-list feature-post post-separator-border">
                               <div class="post-wrap pr-2 pl-2 pt-2 bg-white mb-0">

                                <!-- Image -->
                                <a class="image img-sm" href="post-details.html"><img src="{{asset('contents/website')}}/img/post/post-13.jpg" alt="post"></a>

                                <!-- Content -->
                                <div class="content">

                                    <!-- Title -->
                                    <h5 class="title"><a href="post-details.html">নাটকটিতে বাকের ভাইয়ের নায়িকা সুবর্ণা মুস্তাফা।</a></h5>

                                    <!-- Meta -->
                                    <!-- <div class="meta fix">
                                        <span class="meta-item date"><i class="fa fa-clock-o"></i>10 March 2017</span>
                                    </div> -->

                                </div>

                              </div>
                            </div><!-- Post Post small End -->

                            <!-- Post Post small Start -->
                            <div class="post post-small post-mr-sm post-list feature-post post-separator-border">
                               <div class="post-wrap pr-2 pl-2 pt-2 bg-white mb-0">

                                <!-- Image -->
                                <a class="image img-sm" href="post-details.html"><img src="{{asset('contents/website')}}/img/post/post-13.jpg" alt="post"></a>

                                <!-- Content -->
                                <div class="content">

                                    <!-- Title -->
                                    <h5 class="title"><a href="post-details.html">নাটকটিতে বাকের ভাইয়ের নায়িকা সুবর্ণা মুস্তাফা।</a></h5>

                                    <!-- Meta -->
                                    <!-- <div class="meta fix">
                                        <span class="meta-item date"><i class="fa fa-clock-o"></i>10 March 2017</span>
                                    </div> -->

                                </div>

                              </div>
                            </div><!-- Post Post small End -->

                            <!-- Post Post small Start -->
                            <div class="post post-small post-mr-sm post-list feature-post post-separator-border">
                               <div class="post-wrap pr-2 pl-2 pt-2 bg-white mb-0">

                                <!-- Image -->
                                <a class="image img-sm" href="post-details.html"><img src="{{asset('contents/website')}}/img/post/post-13.jpg" alt="post"></a>

                                <!-- Content -->
                                <div class="content">

                                    <!-- Title -->
                                    <h5 class="title"><a href="post-details.html">নাটকটিতে বাকের ভাইয়ের নায়িকা সুবর্ণা মুস্তাফা।</a></h5>

                                    <!-- Meta -->
                                    <!-- <div class="meta fix">
                                        <span class="meta-item date"><i class="fa fa-clock-o"></i>10 March 2017</span>
                                    </div> -->

                                </div>

                              </div>
                            </div><!-- Post Post small End -->

                            <!-- Post Post small Start -->
                            <div class="post post-small post-mr-sm post-list feature-post post-separator-border">
                               <div class="post-wrap pr-2 pl-2 pt-2 bg-white mb-0">

                                <!-- Image -->
                                <a class="image img-sm" href="post-details.html"><img src="{{asset('contents/website')}}/img/post/post-13.jpg" alt="post"></a>

                                <!-- Content -->
                                <div class="content">

                                    <!-- Title -->
                                    <h5 class="title"><a href="post-details.html">নাটকটিতে বাকের ভাইয়ের নায়িকা সুবর্ণা মুস্তাফা।</a></h5>

                                    <!-- Meta -->
                                    <!-- <div class="meta fix">
                                        <span class="meta-item date"><i class="fa fa-clock-o"></i>10 March 2017</span>
                                    </div> -->

                                </div>

                              </div>
                            </div><!-- Post Post small End -->

                            <!-- Post Post small Start -->
                            <div class="post post-small post-mr-sm post-list feature-post post-separator-border">
                               <div class="post-wrap pr-2 pl-2 pt-2 bg-white mb-0">

                                <!-- Image -->
                                <a class="image img-sm" href="post-details.html"><img src="{{asset('contents/website')}}/img/post/post-13.jpg" alt="post"></a>

                                <!-- Content -->
                                <div class="content">

                                    <!-- Title -->
                                    <h5 class="title"><a href="post-details.html">নাটকটিতে বাকের ভাইয়ের নায়িকা সুবর্ণা মুস্তাফা।</a></h5>

                                    <!-- Meta -->
                                    <!-- <div class="meta fix">
                                        <span class="meta-item date"><i class="fa fa-clock-o"></i>10 March 2017</span>
                                    </div> -->

                                </div>

                              </div>
                            </div>
                        </div>
                        <!-- Right bar post list End -->

                    </div>
                    <div class="review-card mt-30">
                        <div class="single-overlay-post">
                          @php
                            $bigvideo=App\Video:: where('manage',1)->orderBy('id','desc')->limit(1)->get();
                          @endphp
                          @foreach($bigvideo as $big)
                            <div class="card top-review mt-10">
                            <div class="head sec-head column-head review-head">
                                <!-- Title -->
                                <h4 class="title">ভিডিও</h4>
                                <a href="{{url('videos')}}" class="more-cat-news no-line">আরো দেখুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>
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
                        </div><!-- sec-5-1 End -->
                    </div><!-- Review card End -->
                </div> <!-- Col-lg-3 End -->
            </div><!-- Row End -->
        </div><!-- Container End -->
    </div><!-- Post Section End -->


   <!-- Trending Section Start -->
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
