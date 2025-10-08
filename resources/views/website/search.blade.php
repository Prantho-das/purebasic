@extends('layouts.website')
@section('content')
    <!-- Post Section Start -->
<!--     <div class="post-section section mt-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 co-md-8 col-12 left-content">
                    <div class="cat-left bg-grey"  style="margin-bottom: -10px;">
                        <div class="category-head mb-10" style="padding:0px 0px">
                            <h3>Search for <span style="color: #03a9f4;">{{$search}}</span></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 -->
    <!-- Post Section Start -->
    <div class="post-section section mt-50 ">
        <div class="container">
            <div class="row">
                <!-- Col-lg-9 Start -->
                <div class="col-lg-8 co-md-8 col-12" style="    margin-top: -71px;">
                    <!-- Cat Gen Start -->
                    <div class="cat-gen-post">
                        <div class="row">

                            @if($allpost->count() > 0 )
                            @foreach($allpost as $data)
                            <div class="col-lg-4 col-md-4 col-12">
                                <!-- Post Start -->
                                <div class="post fixed-post-height-md box-shadow-post bg-white pb-15 mb-20" style="height:320px">
                                    <div class="post-wrap">

                                        <!-- Image -->
                                        <a class="image" href="{{url('post/view'.$data->id)}}"><img src="{{asset('post/'.$data->image)}}" style="height:180px"></a>

                                        <!-- Content -->
                                        <div class="content">

                                            <!-- Title -->
                                            <a href="{{url('/post/view/'.$data->id)}}">
                                            <h5 class="sub-title">{{str_limit($data->title,40)}}</h5>
                                            <h4 class="title">{{str_limit($data->sub_title,60)}}</h4>
                                            </a>

                                        </div>

                                    </div>
                                </div><!-- Post End -->
                            </div><!-- Col 4 End -->
                            @endforeach
                            @else
                            <div class="left-wrap box-404 bg-white p-3 box-shadow-post mb-20">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="img-404">
                                            <img src="{{asset('contents/website')}}/img/monkey.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-12">
                                        <div class="post pt-10">
                                            <div class="post-wrap">
                                                <div class="header-404">
                                                    <h1>দুঃখিত!</h1>
                                                </div>
                                                <div class="text-404">
                                                    <h5 class="text-red">আপনি যে পাতাটি খুঁজছেন সেটি পাওয়া যায়নি</h5>
                                                    <p>আপনি সম্ভবত ভুলভাবে অনুসন্ধান করছেন অথবা আপনার কাঙ্খিত বিষয়টি আমাদের সাথে সংশ্লিষ্ট নয়। সুনির্দিষ্ট অনুসন্ধানের জন্য সার্চবার ব্যবহার করুন অথবা হোমপেজ ভিজিট করুন।</p>
                                                    <a href="{{url('/')}}" class="btn btn-info bg-custom">হোমপেজ ভিজিট করুন</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            @endif
                        </div>
                    </div><!-- Cat Gen End -->
                </div><!-- Col-lg-9 End -->
                <!-- Col-lg-3 Start -->
 <div class="col-lg-4 col-md-4 sidebar col-12">
                
                <!-- Post Block Wrapper Start -->
                <div class="post-block-wrapper right-bar-tab bg-white mt-15 left-content" style="border:1px solid #ccc;margin-top: -74px;">

                    <!-- Post Block Head Start -->
                    <div class="head sports-head" style="border-top: none">

                        <!-- Title -->
                        <h5 class="title pl-2">জনপ্রিয়</h5>
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
                                                    <h5 class="title"><a href="{{url('post/view/'.$data->id)}}">{{$data->title}}</a></h5>
                                        <span class="cat_name p-1">{{str_limit($data->sub_title,25)}}</span>

                                                </div>
                                                <a class="image videos-post" href="{{url('post/view/'.$data->id)}}"><img src="{{asset('post/'.$data->image)}}" alt="post" style="height:92.5px">
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

            <!-- Col-3 End -->
        </div>
            </div><!-- Row End -->
        </div><!-- Container End -->
    </div><!-- Post Section End -->

@endsection
