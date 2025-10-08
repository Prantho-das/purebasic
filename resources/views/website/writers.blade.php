@extends('layouts.website') @section('content')
<!-- Post Section Start -->
<div class="post-section section mt-30">
    <div class="container">
        <!-- Row post1 Start -->
        <div class="row">
            <!-- Col-8 Start -->
            <div class="col-lg-8 co-md-8 col-12 left-content">
                <div class="writers-wrap">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 mb-30 col-border">
                            <div class="media writers-box bg-white box-shadow-post p-2">
                                <div class="writer-img">
                                    <a href="#">
                                        <img class="mr-3" src="http://telecoaching.biz/assets/assets3/img/121.jpg" alt="Writer image">
                                    </a>
                                </div>
                                <div class="media-body writer-info pt-10">
                                    <h2 class="mt-0"><a href="#">বাকের ভাই</a></h2>
                                    <h4 class="desg-auth">রিপোর্টার, বার্তা বিভাগ</h4>
                                    <p class="text-justify">নাটকটিতে বাকের ভাইয়ের নায়িকা সুবর্ণা মুস্তাফা। নাটকটিতে বাকের ভাইয়ের নায়িকা সুবর্ণা মুস্তাফা।</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="load-more-btn text-center">
                        <button id="load_more" class="btn btn-default box-shadow-post">আরো দেখুন</button>
                    </div>
                </div>
            </div>
            <!-- Col-9 End -->


            <!-- Col-4 Start -->
            <div class="col-lg-4 col-md-4 sidebar col-12">
                <div class="post-block-wrapper right-bar-tab bg-white">
                    <div class="head sports-head">
                        <h5 class="title pl-2">জনপ্রিয় পোস্ট</h5>
                        <ul class="post-block-tab-list sports-post-tab-list nav d-md-block">
                            <li><a class="active" data-toggle="tab" href="#week">দিন</a></li>
                            <li><a data-toggle="tab" href="#month">সপ্তাহ</a></li>
                            <li><a data-toggle="tab" href="#year">মাস</a></li>
                        </ul>
                    </div>
                    <!-- Post Block Head End -->

                    <!-- Post Block Body Start -->
                    <div class="body pb-10 mt-10">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="week">
                                <div class="tab-post">
                                    <div class="right-bar-post-list">
                                        @php 
                                        $mostViewB=App\Post:: where('status',1)->where('manage',2)->orderBy('id','DESC')->limit(1)->get()->sortByDesc('view_count'); 
                                        @endphp 
                                        @foreach($mostViewB as $data)
                                        <div class="post post-separator-border bg-white post-b-bottom">
                                            <div class="post-wrap pb-15 mb-10">
                                                <a class="image" href="{{url('post/view/'.$data->id)}}"><img src="{{asset('post/'.$data->image)}}" alt="post"></a>
                                                <div class="content">
                                                    <h4 class="title"><a href="{{url('post/view/'.$data->id)}}">এ {{str_limit($data->title,60)}}</a></h4>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @foreach($mostView as $data)
                                        <div class="post v-post post-small post-mr-sm post-list feature-post post-separator-border">
                                            <div class="post-wrap pr-2 bg-white">
                                                <div class="content">
                                                    <h5 class="title"><a href="{{url('post/view/'.$data->id)}}">{{str_limit($data->title,60)}}</a></h5>
                                                </div>
                                                <a class="image videos-post" href="{{url('post/view/'.$data->id)}}"><img src="{{asset('post/'.$data->image)}}" alt="post">
                                                </a>
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
        </div>
    </div>
</div>
<!-- Post Section End -->


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
