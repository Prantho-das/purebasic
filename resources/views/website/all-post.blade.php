@extends('layouts.website')
@section('content')
<!-- Post Section Start -->
    <div class="post-section section mt-30">
        <div class="container">
        	<!-- Row post1 Start -->
            <div class="row">
                <!-- Col-9 Start -->
                <div class="col-lg-12 co-md-12 col-12 left-content">
                    <div class="cat-left bg-grey">
                        <div class="category-head mb-10">
                            <h2>All Post</h2>
                        </div>
                    </div><!-- Cat-left End -->
                </div><!-- Col-9 End -->
            </div><!--Row post1 End-->
        </div><!-- Container End -->
    </div><!-- Post Section End -->

    <!-- Post Section Start -->
    <div class="post-section section mt-30">
        <div class="container">
            <div class="row">
                <!-- Col-lg-9 Start -->
                <div class="col-lg-12 co-md-12 col-12 left-content">
                    <!-- Cat Gen Start -->
                    <div class="cat-gen-post">
                        <div class="row">
                          @foreach($allpost as $data)
                            <div class="col-lg-4 col-md-4 col-12">
                              <div class="post fixed-post-height-md box-shadow-post bg-white pb-15 mb-20" style="height:320px">
                                  <div class="post-wrap">
                                      <a class="image" href="{{url('post/view'.$data->id)}}"><img src="{{asset('post/'.$data->image)}}" style="height:180px"></a>
                                      <div class="content">
                                          <a href="{{url('/post/view/'.$data->id)}}">
                                          <h5 class="sub-title">{{str_limit($data->title,40)}}</h5>
                                          <h4 class="title">{{str_limit($data->sub_title,60)}}</h4>
                                          </a>
                                      </div>
                                  </div>
                              </div><!-- Post End -->
                            </div><!-- Col 4 End -->
                            @endforeach
                        </div><!-- Row End -->
                    </div><!-- Cat Gen End -->
                </div><!-- Col-lg-9 End -->
                <!-- Col-lg-3 Start -->
            </div><!-- Row End -->
        </div><!-- Container End -->
    </div><!-- Post Section End -->

<!-- Trending Section Start -->
    <div class="recent-section section mt-20 pb-50">
        <div class="container-fluid">

            <!-- Feature Post Row Start -->
            <div class="row">

                <div class="col-12">

                    <!-- Post Block Wrapper Start -->
                    <div class="post-block-wrapper trending-walker">

                        <!-- Post Block Head Start -->
                        <div class="head trending">

                            <!-- Title -->
                            <h4 class="title">ট্রেন্ডিং টপিক্স</h4>

                        </div><!-- Post Block Head End -->

                        <!-- Post Block Body Start -->
                        <div class="body trending-body mt-10">

                            <div class="three-column-post-carousel column-post-carousel post-block-carousel dark life-style-post-carousel row space-sm">

                                <!-- Post Start -->
                                <div class="post trending-post col pd-5">
                                    <div class="post-wrap min-post-height-sm box-shadow-post bg-white ">

                                        <!-- Image -->
                                        <a class="image" href="post-details.html"><img src="img/post/post-31.jpg" alt="post"></a>

                                        <!-- Content -->
                                        <div class="content p-1 mt-5">

                                            <!-- Title -->
                                            <h5 class="title"><a href="post-details.html">বিশ্বকাপ</a></h5>

                                        </div>
                                        <div class="d-flex justify-content-between trending-btm">
                                            <div class="p-2 so_thumbs">
                                                <img src="https://relayfm.s3.amazonaws.com/uploads/user/avatar/66/user_avatar_katiefloyd_artwork.png" alt="">
                                                <img src="https://theproductivewoman.com/wp-content/uploads/2015/10/Katie-Floyd-photo-300x300.jpg" alt="">
                                                <img src="https://www.pyramidanalytics.com/images/default-source/homepage/casual-user---no-circle.jpg?sfvrsn=5a48f3c9_6" alt="">
                                                <img src="https://relayfm.s3.amazonaws.com/uploads/user/avatar/66/user_avatar_katiefloyd_artwork.png" alt="">
                                            </div>
                                            <div class="p-2 view-btn">
                                                <a href="#" class="btn btn-primary custom-btn btn-sm btn-xs">পড়ুন <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                </div><!-- Post End -->

                                <!-- Post Start -->
                                <div class="post trending-post col pd-5">
                                    <div class="post-wrap min-post-height-sm box-shadow-post bg-white ">

                                        <!-- Image -->
                                        <a class="image" href="post-details.html"><img src="img/post/post-31.jpg" alt="post"></a>

                                        <!-- Content -->
                                        <div class="content p-1 mt-5">

                                            <!-- Title -->
                                            <h5 class="title"><a href="post-details.html">মধ্যপ্রাচ্য</a></h5>

                                        </div>
                                         <div class="d-flex justify-content-between trending-btm">
                                            <div class="p-2 so_thumbs">
                                                <img src="https://relayfm.s3.amazonaws.com/uploads/user/avatar/66/user_avatar_katiefloyd_artwork.png" alt="">
                                                <img src="https://theproductivewoman.com/wp-content/uploads/2015/10/Katie-Floyd-photo-300x300.jpg" alt="">
                                                <img src="https://www.pyramidanalytics.com/images/default-source/homepage/casual-user---no-circle.jpg?sfvrsn=5a48f3c9_6" alt="">
                                                <img src="https://relayfm.s3.amazonaws.com/uploads/user/avatar/66/user_avatar_katiefloyd_artwork.png" alt="">
                                            </div>
                                            <div class="p-2 view-btn">
                                                <a href="#" class="btn btn-primary custom-btn btn-sm btn-xs">পড়ুন <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                            </div>
                                        </div>


                                    </div>
                                </div><!-- Post End -->

                                <!-- Post Start -->
                                <div class="post trending-post col pd-5">
                                    <div class="post-wrap min-post-height-sm box-shadow-post bg-white ">

                                        <!-- Image -->
                                        <a class="image" href="post-details.html"><img src="img/post/post-31.jpg" alt="post"></a>

                                        <!-- Content -->
                                        <div class="content p-1 mt-5">

                                            <!-- Title -->
                                            <h5 class="title"><a href="post-details.html">আমেরিকা</a></h5>
                                        </div>
                                         <div class="d-flex justify-content-between trending-btm">
                                            <div class="p-2 so_thumbs">
                                                <img src="https://relayfm.s3.amazonaws.com/uploads/user/avatar/66/user_avatar_katiefloyd_artwork.png" alt="">
                                                <img src="https://theproductivewoman.com/wp-content/uploads/2015/10/Katie-Floyd-photo-300x300.jpg" alt="">
                                                <img src="https://www.pyramidanalytics.com/images/default-source/homepage/casual-user---no-circle.jpg?sfvrsn=5a48f3c9_6" alt="">
                                                <img src="https://relayfm.s3.amazonaws.com/uploads/user/avatar/66/user_avatar_katiefloyd_artwork.png" alt="">
                                            </div>
                                            <div class="p-2 view-btn">
                                                <a href="#" class="btn btn-primary custom-btn btn-sm btn-xs">পড়ুন <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                </div><!-- Post End -->

                                <!-- Post Start -->
                                <div class="post trending-post col pd-5">
                                    <div class="post-wrap min-post-height-sm box-shadow-post bg-white ">

                                        <!-- Image -->
                                        <a class="image" href="post-details.html"><img src="img/post/post-31.jpg" alt="post"></a>

                                        <!-- Content -->
                                        <div class="content p-1 mt-5">

                                            <!-- Title -->
                                            <h5 class="title"><a href="post-details.html">আমেরিকা</a></h5>

                                        </div>
                                         <div class="d-flex justify-content-between trending-btm">
                                            <div class="p-2 so_thumbs">
                                                <img src="https://relayfm.s3.amazonaws.com/uploads/user/avatar/66/user_avatar_katiefloyd_artwork.png" alt="">
                                                <img src="https://theproductivewoman.com/wp-content/uploads/2015/10/Katie-Floyd-photo-300x300.jpg" alt="">
                                                <img src="https://www.pyramidanalytics.com/images/default-source/homepage/casual-user---no-circle.jpg?sfvrsn=5a48f3c9_6" alt="">
                                                <img src="https://relayfm.s3.amazonaws.com/uploads/user/avatar/66/user_avatar_katiefloyd_artwork.png" alt="">
                                            </div>
                                            <div class="p-2 view-btn">
                                                <a href="#" class="btn btn-primary custom-btn btn-sm btn-xs">পড়ুন <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                </div><!-- Post End -->

                                <!-- Post Start -->
                                <div class="post trending-post col pd-5">
                                    <div class="post-wrap min-post-height-sm box-shadow-post bg-white ">

                                        <!-- Image -->
                                        <a class="image" href="post-details.html"><img src="img/post/post-31.jpg" alt="post"></a>

                                        <!-- Content -->
                                        <div class="content p-1 mt-5">

                                            <!-- Title -->
                                            <h5 class="title"><a href="post-details.html">ইউরোপ</a></h5>

                                        </div>
                                         <div class="d-flex justify-content-between trending-btm">
                                            <div class="p-2 so_thumbs">
                                                <img src="https://relayfm.s3.amazonaws.com/uploads/user/avatar/66/user_avatar_katiefloyd_artwork.png" alt="">
                                                <img src="https://theproductivewoman.com/wp-content/uploads/2015/10/Katie-Floyd-photo-300x300.jpg" alt="">
                                                <img src="https://www.pyramidanalytics.com/images/default-source/homepage/casual-user---no-circle.jpg?sfvrsn=5a48f3c9_6" alt="">
                                                <img src="https://relayfm.s3.amazonaws.com/uploads/user/avatar/66/user_avatar_katiefloyd_artwork.png" alt="">
                                            </div>
                                            <div class="p-2 view-btn">
                                                <a href="#" class="btn btn-primary custom-btn btn-sm btn-xs">পড়ুন <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                </div><!-- Post End -->

                                <!-- Post Start -->
                                <div class="post trending-post col pd-5">
                                    <div class="post-wrap min-post-height-sm box-shadow-post bg-white">

                                        <!-- Image -->
                                        <a class="image" href="post-details.html"><img src="img/post/post-31.jpg" alt="post"></a>

                                        <!-- Content -->
                                        <div class="content p-1 mt-5">

                                            <!-- Title -->
                                            <h5 class="title"><a href="post-details.html">ইউরোপ</a></h5>

                                        </div>
                                         <div class="d-flex justify-content-between trending-btm">
                                            <div class="p-2 so_thumbs">
                                                <img src="https://relayfm.s3.amazonaws.com/uploads/user/avatar/66/user_avatar_katiefloyd_artwork.png" alt="">
                                                <img src="https://theproductivewoman.com/wp-content/uploads/2015/10/Katie-Floyd-photo-300x300.jpg" alt="">
                                                <img src="https://www.pyramidanalytics.com/images/default-source/homepage/casual-user---no-circle.jpg?sfvrsn=5a48f3c9_6" alt="">
                                                <img src="https://relayfm.s3.amazonaws.com/uploads/user/avatar/66/user_avatar_katiefloyd_artwork.png" alt="">
                                            </div>
                                            <div class="p-2 view-btn">
                                                <a href="#" class="btn btn-primary custom-btn btn-sm btn-xs">পড়ুন <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                </div><!-- Post End -->

                                 <!-- Post Start -->
                                <div class="post trending-post col pd-5">
                                    <div class="post-wrap min-post-height-sm box-shadow-post bg-white ">

                                        <!-- Image -->
                                        <a class="image" href="post-details.html"><img src="img/post/post-31.jpg" alt="post"></a>

                                        <!-- Content -->
                                        <div class="content p-1 mt-5">

                                            <!-- Title -->
                                            <h5 class="title"><a href="post-details.html">আমেরিকা</a></h5>
                                        </div>
                                         <div class="d-flex justify-content-between trending-btm">
                                            <div class="p-2 so_thumbs">
                                                <img src="https://relayfm.s3.amazonaws.com/uploads/user/avatar/66/user_avatar_katiefloyd_artwork.png" alt="">
                                                <img src="https://theproductivewoman.com/wp-content/uploads/2015/10/Katie-Floyd-photo-300x300.jpg" alt="">
                                                <img src="https://www.pyramidanalytics.com/images/default-source/homepage/casual-user---no-circle.jpg?sfvrsn=5a48f3c9_6" alt="">
                                                <img src="https://relayfm.s3.amazonaws.com/uploads/user/avatar/66/user_avatar_katiefloyd_artwork.png" alt="">
                                            </div>
                                            <div class="p-2 view-btn">
                                                <a href="#" class="btn btn-primary custom-btn btn-sm btn-xs">পড়ুন <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                            </div>
                                        </div>

                                    </div>
                                </div><!-- Post End -->

                            </div>

                        </div><!-- Post Block Body End -->

                    </div><!-- Post Block Wrapper End -->

                </div>

            </div><!-- Feature Post Row End -->

        </div>
    </div><!-- Trending Section End -->

@endsection
