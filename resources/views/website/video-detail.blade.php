@extends('layouts.website')
@section('content')

    <div class="post-section section mt-30">
        <div class="container">
        	<!-- Row post1 Start -->
            <div class="row">
                <!-- Col-9 Start -->
                <div class="col-lg-8 co-md-8 col-12 left-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Post Block Wrapper Start -->
                            <div class="post-block-wrapper post-detail-wrap mb-30">
                                <div class="body bg-white">
                                    <div class="videowrapper ytvideo v-box">
                                        <a href="javascript:void(0);" class="close-button"></a>
                                        <div class="gradient-overlay"></div>
                                        <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                                        {{!! $video->video !!}}

                                    </div>
                                    <div class="post-head">
                                        <div class="content mt-5 mb-5">
                                            <!-- Title -->
                                            <h4 class="title title-xl">{{$video->title}}</h4>
                                            <!-- <p><i class="fa fa-clock-o"></i> ২৪ জানু ২০১৯</p> -->
                                            <h5 class="sub-title">{{$video->subtitle}}</h5>
                                        </div>
                                    </div>
                                    <div class="news-info mt-15 mb-20">
                                        <div class="d-flex d-flex bd-highlight mb-3 news-info-col">
                                            <div class="mt-10 mr-auto bd-highlight author-m-view">
                                                <span class="news-logo">
                                                    <img src="{{asset('uploads/user/'.$video->user->photo)}}">
                                                </span>
                                                <span class="n_writer_info">
                                                    <p><a href="#">{{$video->user->name}}</a> <br>
                                                    ব্লগ স্টাফ</p>

                                                </span>
                                            </div><!-- Info col End -->
                                            <div class="mt-10 bd-highlight info-col-sm d-none d-sm-block">
                                                <span class="s-share">

                                                    <div class="social-follow social-share-item">
                                                        <div class="footer-social post-share">
                                                            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                                                            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                                                            <!-- <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                                                            <a href="#" class="pinterest"><i class="fa fa-code" aria-hidden="true"></i></a>  -->
                                                        </div>
                                                    </div>
                                                </span>
                                            </div>
                                            <div class="mt-10 bd-highlight info-col d-none d-sm-block">

                                                <div class="st-ico">
                                                    <img src="img/download.png" alt="">
                                               </div>
                                               <div class="statis-info">
                                                   <span class="st_name">সর্বমোট শেয়ার</span>
                                                   <span class="st_num">০০</span>
                                               </div>
                                            </div><!-- Info col End -->
                                            <div class="mt-10 bd-highlight info-col d-none d-sm-block">
                                                <div class="st-ico">
                                                    <img src="img/trending icon.png" alt="">
                                               </div>
                                               <div class="statis-info">
                                                   <span class="st_name">সর্বমোট পাঠক</span>
                                                   <span class="st_num">{{$video->view_count}}</span>
                                               </div>

                                            </div><!-- Info col End -->
                                        </div><!-- d-flex News info col End -->
                                    </div><!-- News info End -->

                                    <!-- Content -->
                                    <div class="content the-content">
                                        <!-- Description -->
                                        <p>{!! $video->details !!}</p>
                                        <div class="load-more-btn text-center mt-10">
                                            <button id="load_more" class="btn btn-default box-shadow-post">আরো দেখুন</button>
                                        </div>
                                    </div><!-- end content -->
                                </div><!-- end body -->
                            </div><!-- Post Block Wrapper end -->
                        </div><!-- end col-12 -->
                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="post-comment cat-top-border mb-25">
                                <div class="comment-block bg-white pt-10">
                                    <div class="row-fluid ml-15">
                                         <div class="d-flex justify-content-between">
                                             <div class="p-1">
                                                 <span class="t-comment">{{$video->vcomment->count()}}</span><span class="open">মন্তব্য দেখুন</span>
                                             </div>
                                             <div class="post-react">
                                                 <span class="post-like post-dislike"><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 0</a></span>
                                             </div>
                                         </div>
                                    </div>

                                    <div class="row-fluid comment-area mt-20">
                                        <ul class="nav nav-tabs comment-tabs" id="myTab" role="tablist">
                                          <li class="nav-item">
                                            <a class="nav-link active" id="u_comment-tab" data-toggle="tab" href="#u_comment" role="tab" aria-controls="u_comment" aria-selected="true">User Comment</a>
                                          </li>
                                          <li class="nav-item">
                                            <a class="nav-link" id="d_comment-tab" data-toggle="tab" href="#d_comment" role="tab" aria-controls="d_comment" aria-selected="false">Disqus Comment</a>
                                          </li>
                                          <li class="nav-item">
                                            <a class="nav-link" id="f_comment-tab" data-toggle="tab" href="#f_comment" role="tab" aria-controls="f_comment" aria-selected="false">Facebook Comment</a>
                                          </li>
                                        </ul>
                                        <div class="">
                                            <div class="body pb-10 mt-10">
                                                <div class="tab-content">
                                                    <div class="tab-pane fade show active" id="u_comment">
                                                       <div class="tab-post">
                                                           <div class="comment-wrap">
                                                                <div class="post-block-wrapper bg-white p-2">
                                                                    <div class="head">
                                                                        <h4 class="title">User Comment</h4>
                                                                    </div>
                                                                    <div class="body">
                                                                        @php
                                                                        $id=Session:: get('id');
                                                                        $visitor=App\Visitor:: where('id',$id)->first();
                                                                        @endphp

                                                                        @if($visitor)
                                                                        <div class="post-comment-form">
                                                                            <form action="{{url('video/comment/' .$video->id)}}" method="post" class="row">
                                                                                @csrf
                                                                                <div class="col-12 mb-20">
                                                                                    <label for="message">Message <sup>*</sup></label>
                                                                                    <textarea id="message" name="comment" required></textarea>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <input type="submit" value="Submit">
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        @else
                                                                        <a href="{{url('visitor/login')}}" class="btn btn-primary">Need login</a>
                                                                        @endif
                                                                    </div>
                                                                </div><!-- Post Block Wrapper End -->

                                                            </div><!-- End comment wrap -->

                                                       </div><!-- Tab post End -->

                                                    </div><!-- Tab Pane End-->
                                                    <div class="tab-pane fade show" id="d_comment">
                                                       <div class="tab-post">
                                                           <div class="comment-wrap">
                                                                <div class="post-block-wrapper bg-white p-2">
                                                                    <div class="head">
                                                                        <h4 class="title">Disqus Comment</h4>
                                                                    </div>
                                                                    <div class="body">
                                                                        @php
                                                                        $id=Session:: get('id');
                                                                        $visitor=App\Visitor:: where('id',$id)->first();
                                                                        @endphp

                                                                        @if($visitor)
                                                                        <div class="post-comment-form">
                                                                            <form action="{{url('post/comment/' .$video->id)}}" method="post" class="row">
                                                                                @csrf
                                                                                <div class="col-12 mb-20">
                                                                                    <label for="message">Message <sup>*</sup></label>
                                                                                    <textarea id="message" name="comment" required></textarea>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <input type="submit" value="Submit">
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        @else
                                                                        <a href="{{url('visitor/login')}}" class="btn btn-primary">Need login</a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                       </div>
                                                    </div>
                                                    <div class="tab-pane fade show" id="f_comment">
                                                       <div class="tab-post">
                                                           <div class="comment-wrap">
                                                                <div class="post-block-wrapper bg-white p-2">
                                                                    <div class="head">
                                                                        <h4 class="title">Facebook Comment</h4>
                                                                    </div>
                                                                    <div class="body">
                                                                        @php
                                                                        $id=Session:: get('id');
                                                                        $visitor=App\Visitor:: where('id',$id)->first();
                                                                        @endphp

                                                                        @if($visitor)
                                                                        <div class="post-comment-form">
                                                                            <form action="{{url('post/comment/' .$video->id)}}" method="post" class="row">
                                                                                @csrf
                                                                                <div class="col-12 mb-20">
                                                                                    <label for="message">Message <sup>*</sup></label>
                                                                                    <textarea id="message" name="comment" required></textarea>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <input type="submit" value="Submit">
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                        @else
                                                                        <a href="{{url('visitor/login')}}" class="btn btn-primary">Need login</a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                       </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                             @foreach($video->vcomment as $data)
                                                            <div class="post-author fix bg-white cat-top-border">
                                                                <div class="image float-left author-thumb"><a href="#"><img src="http://telecoaching.biz/assets/assets3/img/121.jpg" alt="post-author"></a></div>
                                                                <div class="content fix pt-15">
                                                                    <h5><a href="#" class="post-author-name">{{$data->visitor->name}}</a></h5>
                                                                    <p>{{$data->comments}}</p>
                                                                </div>
                                                            </div>
                                                             @endforeach
                                                        </div><!-- end col-12 -->
                                                    </div><!-- end row -->
                                                </div>
                                            </div><!-- Post Block Body End -->
                                        </div>
                                    </div>
                                </div>
                            </div><!--end comment-->
                        </div><!-- end col-12 -->
                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cat-sec cat-top-border mb-20">

                                <div class="head sec-head column-head">
                                    <!-- Title -->
                                    <h4 class="title">ক্যাটাগরি {{$categorys->name}}</h4>
                                    <a href="{{url('category/'.$categorys->slug)}}" class="more-cat-news no-line">আরো পড়ুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                </div>

                                <div class="row mt-10">
                                  @foreach($categorys->posts as $category)
                                  <div class="col-lg-4 col-md-4 col-12">
                                      <div class="post fixed-post-height-md box-shadow-post bg-white mb-10">
                                          <div class="post-wrap">
                                              <a class="image" href="{{url('post/view/'.$category->id)}}"><img src="{{asset('post/'.$category->image)}}" style="height: 180px;"></a>
                                              <div class="content">
                                                  <h4 class="title"><a href="{{url('post/view/'.$category->id)}}">{{str_limit($category->title,80)}}</a></h4>
                                              </div>

                                          </div>
                                      </div>
                                  </div><!-- Col-lg-4 End -->
                                  @endforeach
                                </div><!-- Row End -->
                            </div><!-- Cat-sec End -->
                        </div><!-- end cpl-12 -->
                    </div><!-- end row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cat-sec cat-top-border mb-20">

                                <div class="head sec-head column-head">
                                    <!-- Title -->
                                    <h4 class="title">ক্যাটাগরি {{$sixcategorys->name}}</h4>
                                    <a href="{{url('category/'.$sixcategorys->slug)}}" class="more-cat-news no-line">আরো পড়ুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                </div>

                                <div class="row mt-10">
                                  @foreach($sixcategorys->posts as $sixcategory)
                                  <div class="col-lg-4 col-md-4 col-12">
                                      <div class="post fixed-post-height-md box-shadow-post bg-white mb-10">
                                          <div class="post-wrap">
                                              <a class="image" href="{{url('post/view/'.$sixcategory->id)}}"><img src="{{asset('post/'.$sixcategory->image)}}" style="height: 180px;"></a>
                                              <div class="content">
                                                  <h4 class="title"><a href="{{url('post/view/'.$sixcategory->id)}}">{{str_limit($sixcategory->title,80)}}</a></h4>
                                              </div>
                                          </div>
                                      </div>
                                  </div><!-- Col-lg-4 End -->
                                  @endforeach
                                </div><!-- Row End -->
                            </div><!-- Cat-sec End -->
                        </div><!-- end cpl-12 -->
                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cat-sec cat-top-border mb-20">

                                <div class="head sec-head column-head">
                                    <!-- Title -->
                                    <h4 class="title">ক্যাটাগরি {{$fivecategorys->name}}</h4>
                                    <a href="{{url('category/'.$fivecategorys->slug)}}" class="more-cat-news no-line">আরো পড়ুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                                </div>

                                <div class="row mt-10">
                                  @foreach($fivecategorys->posts->take(3) as $fivecategory)
                                  <div class="col-lg-4 col-md-4 col-12">
                                      <div class="post fixed-post-height-md box-shadow-post bg-white mb-10">
                                          <div class="post-wrap">
                                              <a class="image" href="{{url('post/view/'.$fivecategory->id)}}"><img src="{{asset('post/'.$fivecategory->image)}}" style="height: 180px;"></a>
                                              <div class="content">
                                                  <h4 class="title"><a href="{{url('post/view/'.$fivecategory->id)}}">{{str_limit($fivecategory->title,80)}}</a></h4>
                                              </div>
                                          </div>
                                      </div>
                                  </div><!-- Col-lg-4 End -->
                                  @endforeach
                                </div><!-- Row End -->
                            </div><!-- Cat-sec End -->
                        </div><!-- end cpl-12 -->
                    </div><!-- end row -->
                </div><!-- Col-8 End -->

                <!-- Col-3 Start -->
                <div class="col-lg-4 col-md-4 sidebar col-12">
                   <div class="sec-5-1-left m-top-0 bg-white">
                        <div class="head sec-head column-head">
                            <h4 class="title pl-2">সর্বশেষ</h4>
                        </div>
                        <div class="right-bar-post-list mt-10">
                            @foreach($allvideo as $data)
                            <div class="post v-post post-small post-mr-sm post-list feature-post post-separator-border">
                               <div class="post-wrap pr-2 bg-white">
                                <div class="content">
                                    <h5 class="title"><a href="{{url('/view-video/'.$data->id)}}">{{str_limit($data->title,50)}}</a></h5>
                                </div>
                                <a class="image videos-post" href="{{url('/view-video/'.$data->id)}}"><img src="{{asset('uploads/video/'.$data->image)}}" alt="post" style="height:87px">
                                    <span class="video-btn video-post-icon v-sm-post">
                                        <i class="fa fa-play"></i>
                                        <span class="v_lenth leth-sm">{{$data->duration}}</span>
                                    </span>
                                </a>
                              </div>
                            </div>
                            @endforeach
                        </div>
                   </div>
                    <div class="subscrive-form text-center bg-s-dark mt-15">
                        <h3 class="text-white">সাবসক্রাইব করুন</h3>
                       <form action="" class="subs_form">
                           <fieldset>
                              <input placeholder="Your Email Address" type="email" tabindex="2" required>
                            </fieldset>
                            <fieldset class="text-center">
                                <span>
                                <input type="radio" id="test1" name="radio-group" checked>
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
                    </div>
                    <!-- Subscribe End -->

                    <!-- Post Block Wrapper Start -->
                        <div class="post-block-wrapper right-bar-tab bg-white mt-30 mb-20">
                            <div class="head sports-head">
                                <h5 class="title pl-2">জনপ্রিয় পোস্ট</h5>
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
                                                     <h5 class="title"><a href="{{url('/view-video/'.$data->id)}}">{{str_limit($data->title,50)}}</a></h5>
                                                 </div>
                                                 <a class="image videos-post" href="{{url('/view-video/'.$data->id)}}"><img src="{{asset('uploads/video/'.$data->image)}}" alt="post" style="height:87px">
                                                     <span class="video-btn video-post-icon v-sm-post">
                                                         <i class="fa fa-play"></i>
                                                         <span class="v_lenth leth-sm">{{$data->duration}}</span>
                                                     </span>
                                                 </a>
                                               </div>
                                             </div>
                                             @endforeach
                                            </div><!-- Right-bar-post-list End -->
                                       </div><!-- Tab post End -->
                                    </div><!-- Tab Pane End-->
                                    <div class="tab-pane fade show" id="month">
                                       <div class="tab-post">
                                           <div class="right-bar-post-list">
                                             @foreach($mostView as $data)
                                             <div class="post v-post post-small post-mr-sm post-list feature-post post-separator-border">
                                                <div class="post-wrap pr-2 bg-white">
                                                 <div class="content">
                                                     <h5 class="title"><a href="{{url('/view-video/'.$data->id)}}">{{str_limit($data->title,50)}}</a></h5>
                                                 </div>
                                                 <a class="image videos-post" href="{{url('/view-video/'.$data->id)}}"><img src="{{asset('uploads/video/'.$data->image)}}" alt="post" style="height:87px">
                                                     <span class="video-btn video-post-icon v-sm-post">
                                                         <i class="fa fa-play"></i>
                                                         <span class="v_lenth leth-sm">{{$data->duration}}</span>
                                                     </span>
                                                 </a>
                                               </div>
                                             </div>
                                             @endforeach
                                            </div><!-- Right-bar-post-list End -->
                                       </div><!-- Tab post End -->
                                    </div><!-- Tab Pane End-->
                                    <div class="tab-pane fade show" id="year">
                                       <div class="tab-post">
                                           <div class="right-bar-post-list">
                                             @foreach($mostView as $data)
                                             <div class="post v-post post-small post-mr-sm post-list feature-post post-separator-border">
                                                <div class="post-wrap pr-2 bg-white">
                                                 <div class="content">
                                                     <h5 class="title"><a href="{{url('/view-video/'.$data->id)}}">{{str_limit($data->title,50)}}</a></h5>
                                                 </div>
                                                 <a class="image videos-post" href="{{url('/view-video/'.$data->id)}}"><img src="{{asset('uploads/video/'.$data->image)}}" alt="post" style="height:87px">
                                                     <span class="video-btn video-post-icon v-sm-post">
                                                         <i class="fa fa-play"></i>
                                                         <span class="v_lenth leth-sm">{{$data->duration}}</span>
                                                     </span>
                                                 </a>
                                               </div>
                                             </div>
                                             @endforeach
                                            </div><!-- Right-bar-post-list End -->
                                       </div><!-- Tab post End -->
                                    </div><!-- Tab Pane End-->
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>


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
