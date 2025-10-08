@extends('layouts.website')
@section('content')


    <div class="post-section section mt-30">
        <div class="container">
            <div class="row">
                <!-- Col-lg-9 Start -->
                <div class="col-lg-8 co-md-8 col-12 left-content" style="    height: 645px;">
                    <!-- Cat Gen Start -->
                    <div class="cat-gen-post">
                        <div class="row">

                           @foreach($subcat as $data)
                            <div class="col-lg-4 col-md-4 col-12">
                                <!-- Post Start -->
                                <div class="post fixed-post-height-md 3-col-post mb-10">
                                    <div class="post-wrap">

                                        <!-- Image -->
                                        <a class="image" href="{{url('post/view'.$data->id)}}"><img src="{{asset('post/'.$data->image)}}" style="height:180px"></a>

                                        <!-- Content -->
                                        <div class="content">

                                            <!-- Title -->
                                            <a href="{{url('/post/view/'.$data->id)}}">
                                            <h5 class="title">{{str_limit($data->title,60)}}</h5>
                                            <h4 class="sub-title">{{str_limit($data->sub_title,50)}}</h4>
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
                

                   <div class="col-lg-4 col-md-4 sidebar col-12">
                  <div class="sidebar-news bg-white box-shadow-post cat-top-border mb-20">
                      <div class="head sec-head last-news">
                          <h4 class="title">সর্বশেষ</h4>
                          <a href="{{url('/allpost')}}" class="more-cat-news no-line">আরো দেখুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                      </div>

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
            </div><!-- Row End -->
        </div><!-- Container End -->
    </div><!-- Post Section End -->


    <!-- Post Section Start -->
    <div class="post-section section sec-10 mt-30 mb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 co-md-8 col-12 left-content">
                  <div class="cat-sec sec-5-1-left  mb-20" style="margin-top: -1px;">
                      <div class="head sec-head column-head">
                          <h4 class="title">{{$fivecategorys->name}}</h4>
                          <a href="{{url('category/'.$fivecategorys->slug)}}" class="more-cat-news no-line">আরো পড়ুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                      </div>
                      <div class="row mt-10">
                        @foreach($fivecategorys->posts->take(6) as $fivecategory)
                          <div class="col-lg-4 col-md-4 col-12">
                              <div class="post fixed-post-height-md bg-white mb-10">
                                  <div class="post-wrap">
                                      <a class="image" href="{{url('post/view/'.$fivecategory->id)}}"><img src="{{asset('post/'.$fivecategory->image)}}"></a>
                                      <div class="content">
                                          <h4 class="title"><a href="{{url('post/view/'.$fivecategory->id)}}">{{str_limit($fivecategory->title,120)}}</a>
                                            <h4 class="sub-title">{{str_limit($fivecategory->sub_title,50)}}</h4>

                                          </h4>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          @endforeach

                      </div><!-- Row End -->
                  </div><!-- Cat-sec End -->
                </div><!-- Col-9 End -->

                <div class="col-lg-4 col-md-4 sidebar col-12 " style="margin-top: -29px;">
                  <div class="post-block-wrapper right-bar-tab bg-white mt-30 mb-20 sticky-top">
                      <div class="head sports-head">
                          <h5 class="title pl-2">জনপ্রিয়</h5>
                      </div>
                      <div class="body pb-10 mt-10 left-content">
                          <div class="tab-content">
                              <div class="tab-pane fade show active" id="week">
                                 <div class="tab-post">
                                     <div class="right-bar-post-list">
                                          @foreach($mostView as $data)
                                          <div class="post v-post post-small post-mr-sm post-list feature-post post-separator-border">
                                             <div class="post-wrap pr-2 bg-white">
                                              <div class="content">
                                                  <h5 class="title"><a href="{{url('post/view/'.$data->id)}}">{{str_limit($data->title,50)}}</a>
                                            <h4 class="sub-title">{{str_limit($data->sub_title,25)}}</h4>

                                                  </h5>
                                              </div>
                                              <a class="image videos-post" href="{{url('post/view/'.$data->id)}}"><img src="{{asset('post/' .$data->image)}}" alt="post">
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
                </div> <!-- Col-lg-3 End -->

            </div><!-- Row End -->
        </div><!-- Container End -->
    </div><!-- Post Section End -->
@endsection



