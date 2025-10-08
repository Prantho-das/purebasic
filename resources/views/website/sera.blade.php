@extends('layouts.sera')
@section('content')

<!-- Post Section Start -->
<div class="post-section section mt-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 co-md-8 col-12 left-content border" style="height: 507px;">
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-12 mb-20">
                        @php $centerpost=App\Post:: where('status',1)->where('manage',1)->orderBy('id','desc')->limit(1)->get(); @endphp @foreach($centerpost as $data)
                        <div class="post fixed-post-height-xl pb-15" style="height: 332px;    margin-left: -14px;">
                            <div class="post-wrap" style="background: url({{asset('post/'.$data->image)}});height: 330px; background-position: center; background-repeat: no-repeat; background-size: cover;">
                                <a class="image" href="{{url('post/view/'.$data->id)}}" style="    margin-top: 285px;">
                                    <h4 class="title title-lg" style="color: #fff;">{{str_limit($data->title,90)}}</h4>
                                </a>

                            </div>
                        </div>
                        @endforeach @php $downtpost=App\Post:: where('status',1)->where('manage',2)->orderBy('id','desc')->limit(1)->get(); @endphp @foreach($downtpost as $data)
                        <div class="post post-small f-height-post post-list life-style-post mb-20" style="height: 155px; margin-top: 20px;margin-left: -14px;">
                            <div class="post-wrap">
                                <!-- Image -->
                                <a class="image" href="{{url('post/view/'.$data->id)}}"><img src="{{asset('post/'.$data->image)}}" alt="post" style="width: 215px; height: 155px;" /></a>

                                <!-- Content -->
                                <div class="content">
                                    <span class="cat_name p-1">{{str_limit($data->sub_title,50)}}</span>
                                    <h5 class="title title-md-1"><a href="{{url('post/view/'.$data->id)}}">{{str_limit($data->title,150)}}</a></h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="col-lg-5 col-md-5 col-12">
                        @php $mostView=App\Post::where('status',1)->where('is_apporve',1)->orderBy('id','DESC')->limit(4)->get()->sortByDesc('view_count'); @endphp @foreach($mostView as $data)
                        <div class="post post-small f-height-post post-list life-style-post mb-20" style="height: 155px; margin-top: 0px;margin-bottom: -30px;">
                            <div class="post-wrap">
                                <a class="image" href="{{url('post/view/'.$data->id)}}"><img src="{{asset('post/'.$data->image)}}" alt="post" style="width: 152px; height: 112px;" /></a>
                                <div class="content">
                                    <h5 class="title title-md-1"><a href="{{url('post/view/'.$data->id)}}">{{str_limit($data->title,150)}}</a></h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- col-lg-6 End -->
                </div>
            </div>

            <div class="col-lg-4 col-md-4 sidebar col-12">
                <div class="sidebar-news fixed-post-height-xl bg-white box-shadow-post cat-top-border mb-20" style="height: 508px;">
                    <div class="head sec-head last-news">
                        <h4 class="title">সর্বশেষ</h4>
                        <!-- <a href="{{url('/allpost')}}" class="more-cat-news no-line">আরো দেখুন <i class="fa fa-caret-right" aria-hidden="true"></i></a> -->
                    </div>
                    @php
                    $allpost=App\Spost:: where('status',1)->where('is_approve',1)->orderBy('id','desc')->limit(6)->get();
                    @endphp
                    @foreach($allpost as $data)
                    <div class="post post-small post-list fashion-post post-separator-border pl-2 pr-2">
                        <div class="post-wrap post-wrap-sm list-no-border">
                            <div class="content list-content">
                                <h5 class="title"><a href="{{url('/post/view/'.$data->id)}}">{{str_limit($data->title,50)}}</a></h5>
                                <div class="meta fix">
                                    <span class="meta-item date">{{$data->created_at}}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- Col-4 End -->
        </div>
        <!--Row post1 End-->

        <!--Row post2 End-->
    </div>
    <!--Container End-->
</div>
<!-- post-section section mt-30 end -->

<section style="margin-bottom: 30px;">
    <div class="container">
       <div class="row">
        @foreach($sera as $data)
           <div class="col-md-3">
             <div class="k_main">
                 <div class="k_header">
                     <h3>{{$data->name}}</h3>
                 </div>
                 <div class="k_body">
                   <a href="{{url('/amader/sera/category/'.$data->id)}}">
                     <img src="{{asset('uploads/sera/'.$data->image)}}" style=" height: 200px;">
                   </a>

                     <h6><a href="{{url('/amader/sera/category/'.$data->id)}}"> আরও</a></h6>
                 </div>
             </div>
           </div>
            @endforeach

       </div>
    </div>
</section>




<div class="post-section section sec-5 mt-30">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 co-md-8 col-12 left-content">
                <div class="">
                    <div class="head sec-head column-head">
                    <h4 class="title">ক্যাটাগরি কবিতা</h4>
                </div>
                <div class="row mt-10">
                    @php
                        $ascatone=App\Spost:: where('status',1)->where('is_approve',1)->where('cat_id',1)->limit(6)->get();
                    @endphp
                    @foreach($ascatone as $category)
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="post fixed-post-height-md 3-col-post mb-10" style="height: 251px">
                            <div class="post-wrap pb-15">
                                <a class="image" href="{{url('amader/sera/category-post/'.$category->id)}}"><img src="{{asset('post/'.$category->image)}}" /></a>
                                <div class="content">
                                    <a href="{{url('amader/sera/category-post/2'.$category->id)}}">
                                        <h4 class="title">{{str_limit($category->title,50)}}</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 sidebar col-12">
               <div class="serach">
                <h3>আপনি কিছু খুঁছেন </h3>
                   <form>
                      <div class="row">
                          <div class="col-md-11">
                              <div class="form-group">
                                <input type="text" class="form-control" name="search" placeholder="Search">
                              </div>
                          </div>
                          <div class="col-md-1">
                              <button type="submit" class="btn btn-primary" style="margin-left: -34px; border-left: 2px solid #000;"><i class="fa fa-search"></i></button>
                          </div>
                      </div>
                    </form>
               </div>
                <div style="margin-top: 34px;">
                @php
                $ads=App\Ads:: where('status',1)->where('is_approve',1)->where('manage',4)->limit(1)->get();
                @endphp
                @foreach($ads as $data)
                <div class="bN300 border">
                    <img src="{{asset('uploads/gallery/'.$data->image)}}" class="border" />
                </div>
                @endforeach
                </div>
            </div>

            <!-- Col-3 End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- Post Section End -->





<div class="post-section section sec-5 mt-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 co-md-8 col-12 left-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="head sec-head column-head">
                            <h4 class="title">ক্যাটাগরি গল্প</h4>
                        </div>
                        <div class="row mt-10">
                            @php
                                $twocategorys=App\Spost:: where('status',1)->where('is_approve',1)->where('cat_id',2)->limit(4)->get();
                            @endphp
                            @foreach($twocategorys as $category)
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="post 3-col-post mb-10">
                                    <div class="post-wrap pb-15">
                                        <a class="image" href="{{url('post/view/'.$category->id)}}"><img src="{{asset('post/'.$category->image)}}" /></a>
                                        <div class="content">
                                            <a href="{{url('post/view/'.$category->id)}}">
                                                <h4 class="title">{{str_limit($category->title,50)}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="head sec-head column-head">
                            <h4 class="title">ক্যাটাগরি কৌতুক</h4>
                        </div>
                        <div class="row mt-10">
                            @php
                                $threecategorys=App\Spost:: where('status',1)->where('is_approve',1)->where('cat_id',3)->limit(4)->get();
                            @endphp
                            @foreach($threecategorys as $category)
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="post 3-col-post mb-10">
                                    <div class="post-wrap pb-15">
                                        <a class="image" href="{{url('post/view/'.$category->id)}}"><img src="{{asset('post/'.$category->image)}}" /></a>
                                        <div class="content">
                                            <a href="{{url('post/view/'.$category->id)}}">
                                                <h4 class="title">{{str_limit($category->title,50)}}</h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 sidebar col-12">
                <div style="margin-top: 34px;">
                @php
                $ads=App\Ads:: where('status',1)->where('is_approve',1)->where('manage',5)->limit(1)->get();
                @endphp
                @foreach($ads as $data)
                <div class="bN300 border">
                    <img src="{{asset('uploads/gallery/'.$data->image)}}" class="border" />
                </div>
                @endforeach
                </div>
            </div>

            <!-- Col-3 End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>




<div class="post-section section sec-8 mt-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 co-md-8 col-12 left-content">
                <div class="row">
                    <div class="col-lg-7 col-md-7 col-12 mb-20">
                        @php $bigvideo=App\Video:: where('manage',1)->orderBy('id','desc')->limit(1)->get(); @endphp @foreach($bigvideo as $big)
                        <div class="post">
                            <div class="post-wrap video-news">
                                <div class="videowrapper ytvideo">
                                    <a href="javascript:void(0);" class="close-button"></a>
                                    <div class="gradient-overlay"></div>
                                    <i class="fa fa-arrows-alt" aria-hidden="true"></i> {!! $big->video !!}
                                </div>
                            </div>
                        </div>
                        @endforeach @foreach($lastvideo as $Lead)
                        <div class="post post-large v-gal-post post-overlay gadgets-post">
                            <div class="post-wrap ehow-content" style="float: left; width: 40%;">
                                <a href="{{url('view-video/'.$Lead->id)}}" class="image">
                                    <img src="{{asset('uploads/video/'.$Lead->image)}}" alt="post" />
                                    <span class="video-btn"><i class="fa fa-play"></i></span>
                                </a>
                            </div>
                            <div class="content full" style="float: left; width: 60%;">
                                <h2 class="title"><a href="{{url('view-video/'.$Lead->id)}}" style="font-weight: 700;font-size: 20px">{{str_limit($Lead->title,35)}}</a></h2>
                            </div>
                        </div>
                        <!-- Overlay Post End -->
                        @endforeach
                    </div>

                    <div class="col-lg-5 col-md-5 col-12" style="margin-top: 0px;">
                        @foreach($allvideo as $Lead)
                        <div class="post v-gal-post post-overlay gadgets-post" style="margin-bottom: 20px;">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="post-wrap ehow-content">
                                        <a href="{{url('view-video/'.$Lead->id)}}" class="image">
                                            <img src="{{asset('uploads/video/'.$Lead->image)}}" alt="post" style="height: 75px;" />
                                            <span class="video-btn"><i class="fa fa-play"></i></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="content full">
                                        <h2 class="title"><a href="{{url('view-video/'.$Lead->id)}}" style="font-size: 18px; font-weight: 700;">{{str_limit($Lead->title,50)}}</a></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Overlay Post End -->
                        @endforeach
                    </div>
                    <!-- col-lg-6 End -->
                </div>
            </div>
            <div class="col-lg-4 col-md-4 sidebar col-12">
                <div class="slider-area">
                    <div class="slider-active owl-carousel">
                        <div class="slider-wrapper text-center">
                            <img src="https://www.imagesjunction.com/images/img/beautiful_girls_dp_images.jpg">
                        </div>

                        <div class="slider-wrapper text-center">
                            <img src="https://www.imagesjunction.com/images/img/beautiful_girls_dp_images.jpg">
                        </div>
                        <div class="slider-wrapper text-center">
                            <img src="https://www.imagesjunction.com/images/img/beautiful_girls_dp_images.jpg">
                        </div>
                    </div>
                    <div class="title_ text-center">
                        <h3>আমাদের সেরা</h3>
                    </div>
                </div>
                <div class="fb-page" data-href="https://www.facebook.com/facebook" data-width="380" data-hide-cover="false" data-show-facepile="false"></div>

            </div>
        </div>
    </div>
</div>


@endsection