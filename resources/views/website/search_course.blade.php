@extends('layouts.register')
@section('content')
<div class="post-section section mt-50 ">
    <div class="container">
        <div class="row">
            <!-- Col-lg-9 Start -->
            <div class="col-lg-8 co-md-8 col-12" style="    margin-top: -71px;">
                <!-- Cat Gen Start -->
                <div class="cat-gen-post">
                    <div class="row">

                        @if($batchpackages->count() > 0 )
                        @foreach($batchpackages as $data)
                        <div class="col-lg-4 col-md-4 col-12">
                            <!-- Post Start -->
                            <div class="post fixed-post-height-md box-shadow-post bg-white pb-15 mb-20"
                                style="height:320px">
                                <div class="post-wrap">

                                    <!-- Image -->
                                    <a class="image" href="{{url('post/view'.$data->id)}}"><img
                                            src="{{asset('post/'.$data->image)}}" style="height:180px"></a>

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
                                                <p>আপনি সম্ভবত ভুলভাবে অনুসন্ধান করছেন অথবা আপনার কাঙ্খিত বিষয়টি আমাদের
                                                    সাথে সংশ্লিষ্ট নয়। সুনির্দিষ্ট অনুসন্ধানের জন্য সার্চবার ব্যবহার
                                                    করুন অথবা হোমপেজ ভিজিট করুন।</p>
                                                <a href="{{url('/')}}" class="btn btn-info bg-custom">হোমপেজ ভিজিট
                                                    করুন</a>
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
        </div>
    </div><!-- Row End -->
</div><!-- Container End -->
</div><!-- Post Section End -->

@endsection