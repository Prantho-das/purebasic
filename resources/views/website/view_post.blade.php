@extends('layouts.website')
@section('content')

    <!-- Post Section Start -->
    <div class="post-section section mt-30">
        <div class="container">
        	<!-- Feature Post Row Start -->
            <div class="row">

                <div class="col-lg-8 co-md-8 col-12 left-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="post-block-wrapper post-detail-wrap mb-30">
                               <article class="post-content">
                                    <div class="d-flex justify-content-between post-breadcrump pr-3 pl-3">
                                        <div class="p-2 b-crumb">
                                            <nav aria-label="breadcrumb">
                                              <ol class="breadcrumb b-crumb-list">
                                                <li class="breadcrumb-item post-det-bread"><a href="{{url('/')}}"><i class="fa fa-home"></i></a></li>
                                                <li class="breadcrumb-item post-det-bread"><a href="{{url('category/'.$categorys->slug)}}">{{$categorys->name}}</a></li>
                                              </ol>
                                            </nav>
                                        </div>
                                        <div class="p-2 post-timing b-crumb">
                                            <p><i class="fa fa-clock-o"></i> প্রকাশিতঃ {{$data->created_at}}</p>
                                        </div>
                                    </div>
                                    <div class="body bg-white">
                                        <div class="post-container">
                                            <div class="post">
                                                <div class="single-post">
                                                    <div class="post-head">
                                                        <div class="content mt-5 mb-5">
                                                            <h4 class="title title-xl">{{$data->title}}</h4>
                                                            <!-- <h5 class="sub-title">{{$data->sub_title}}</h5> -->
                                                        </div>
                                                    </div>
                                                    <div class="news-info mt-15 mb-20">
                                        <div class="d-flex d-flex bd-highlight mb-3 news-info-col">
                                            <div class="mt-10 mr-auto bd-highlight author-m-view">
                                              @if($data->user_id)
                                                <span class="news-logo">
                                                    <img src="{{asset('uploads/user/'.$data->user->photo)}}">
                                                </span>
                                                <span class="n_writer_info">
                                                    <p>{{$data->user->name}}<br>
                                                    রিপোর্টার</p>
                                                </span>
                                                @endif

                                            </div><!-- Info col End -->
                                            <div class="p-2">
                                        <span class="news-icon news-share">
                                            <p class="sh-count">শেয়ার করুন</p>
                                        </span>
                                        <span class="n_writer_info s-share">

                                            <div class="social-follow social-share-item">
                                                <div class="footer-social">
                                                    <a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{Request::fullurl()}}', 'Share This Post', 'width=640,height=450');return false" class="facebook"><i class="fa fa-facebook"></i></a>
                                                    <a href="#" onclick="window.open('https://twitter.com/share?url={{Request::fullurl()}}', 'Share This Post', 'width=640,height=450');return false" class="twitter"><i class="fa fa-twitter"></i></a>
                                                    {{-- <a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=http://larakonews.test/details/nelson-giants-vs-twshane-spa-mzansi-super-league&media=http://larakonews.test/uploads/post/post1575358943guO2zCY4ooOWG2gG.png', 'Share This Post', 'width=640,height=450');return false" class="instagram"><i class="fa fa-instagram"></i></a> --}}

                                                </div>
                                            </div>
                                        </span>
                                    </div>
                                            <div class="mt-10 bd-highlight info-col d-none d-sm-block">

                                                <div class="st-ico">
                                                    <img src="{{asset('contents/website')}}/img/trending icon.png" alt="">
                                               </div>
                                               <div class="statis-info">
                                                   <span class="st_name">সর্বমোট পাঠক</span>
                                                   <span class="st_num">{{$data->view_count}}</span>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                                    <div class="post-wrap">
                                                        <div class="post-thumb">
                                                            <img src="{{asset('post/' .$data->image)}}">
                                                            <span class="post-det-caption">{{$data->source}}</span>
                                                            <span class="post-det-caption" style="color: #000;">{{$data->caption}}</span>
                                                        </div>
                                                        <div class="content the-content">
                                                            <p>{!! $data->description !!}</p>
                                                        </div>
                                                        <div class="tags-social">
                                                            <div class="cat-tag-area">
                                                                <div class="cat-tag-inside">
                                                                    <span class="rel-post">বিষয়ঃ</span>
                                                                    @foreach($data->tags as $tags)
                                                                    <a href="#" class="post-tag-btn btn btn-light btn-sm">{{$tags->name}}</a>
                                                                    @endforeach

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- Post wrap End -->
                                                </div><!-- Single Post End -->
                                            </div>
                                        </div><!-- End post container -->
                                    </div><!-- Post Block Body End -->
                                </article>
                            </div><!-- Post Block Wrapper End -->
                        </div><!-- end col-12 -->
                    </div><!-- end row -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="post-comment">
                            <div class="comment-top cat-top-border p-2 bg-white">
                                <div class="d-flex justify-content-between post-comment-count">
                                    @php
                                    $id=Session:: get('id');
                                    $visitor=App\Visitor:: where('id',$id)->first();
                                    @endphp
                                    @if($visitor)
                                    <div class="post-react">
                                        <span class="post-like">
                                            <a href="javascript:void(0);" onclick="document.getElementById('favorite-post-{{$data->id}}').submit();"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> {{$data->favorite_to_visitor->count() }}
                                            </a>

                                            <form id="favorite-post-{{$data->id}}" method="POST" action="{{url('favorite/'.$data->id)}}" style="display: none;">
                                                @csrf
                                            </form>
                                        </span>

                                       
                                        <!-- <span class="post-like post-dislike"><a href="#"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> 10</a></span> -->
                                    </div>
                                    @else
                                        <a href="{{url('/user/login')}}" style=" margin-top: 20px; color: red; ">If you would like to login, please login</a>
                                    @endif
                                    <div class="p-2">
                                        <span class="news-icon news-share">
                                            <p class="sh-count">শেয়ার করুন</p>
                                        </span>
                                        <span class="n_writer_info s-share">

                                            <div class="social-follow social-share-item">
                                                <div class="footer-social">
                                                    <a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{Request::fullurl()}}', 'Share This Post', 'width=640,height=450');return false" class="facebook"><i class="fa fa-facebook"></i></a>
                                                    <a href="#" onclick="window.open('https://twitter.com/share?url={{Request::fullurl()}}', 'Share This Post', 'width=640,height=450');return false" class="twitter"><i class="fa fa-twitter"></i></a>
                                                    {{-- <a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=http://larakonews.test/details/nelson-giants-vs-twshane-spa-mzansi-super-league&media=http://larakonews.test/uploads/post/post1575358943guO2zCY4ooOWG2gG.png', 'Share This Post', 'width=640,height=450');return false" class="instagram"><i class="fa fa-instagram"></i></a> --}}
                                                    
                                                </div>
                                            </div>
                                        </span>
                                    </div>
                                </div><!-- d-flex End -->
                            </div><!-- comment top End -->
                        </div><!-- post-comment End -->
                        </div><!-- end col-12 -->
                    </div><!-- end row -->


                </div><!-- end left-area-->


                <!-- Sidebar Start -->
 <div class="col-lg-4 col-md-4 sidebar col-12 ">
                 @php
                $ads=App\Ads:: where('status',1)->where('is_approve',1)->where('manage',2)->limit(1)->get();
                @endphp
                @foreach($ads as $data)
                <div class="bN300">
                    <img src="{{asset('uploads/gallery/'.$data->image)}}" width="100%" />
                </div>
                @endforeach            

            <div class="post-block-wrapper right-bar-tab bg-white mt-15 left-content mt-20" style="border: 1px solid #ccc">
                    <!-- Post Block Head Start -->
                    <div class="head sports-head" style="border-top: none">
                        <!-- Title -->
                        <h5 class="title pl-2">সর্বশেষ</h5>
                    </div>
                    <div class="body pb-10 mt-10">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="week">
                                <div class="tab-post">
                                    <div class="right-bar-post-list">
                                        @foreach($allpost as $data)
                                        <div class="post v-post post-small post-mr-sm post-list feature-post post-separator-border">
                                            <div class="post-wrap pr-2 bg-white">
                                                
                                                <a class="image videos-post" href="{{url('post/view/'.$data->id)}}"><img src="{{asset('post/'.$data->image)}}" alt="post" style="height: 60px; width: 100px;" /> </a>
                                                <div class="content" style="margin-left: -51px; margin-top: -16px;">
                                                    <h5 class="title"><a href="{{url('post/view/'.$data->id)}}">{{$data->title}}</a></h5>
                                                    <span class="sub-title">{{$data->created_at}}</span>
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
                <div class="fb-page" data-href="https://www.facebook.com/facebook" data-width="380" data-hide-cover="false" data-show-facepile="false"></div>
                </div>
        </div>

<div class="post-section section mt-30 mb-50">

     <div class="row">
                        <div class="col-lg-8 co-md-8 col-12 left-content">
                            <div class="post-comment cat-top-border mb-25" style="border-top: none">
                                <div class="comment-block bg-white pt-15">
                                    <div class="row-fluid ml-20">
                                        <!-- <div class="span1">
                                            <span class="t-comment">40</span><h4 class="btn-toggle" data-toggle="collapse" data-target="#intro">View Comment</h4>
                                        </div> -->
                                         <span class="t-comment">{{$data->comment->count()}}</span><span class="open">মন্তব্য করুন</span>
                                    </div>

    
                                        <div class="">
                                            <div class="body pb-10 mt-10">
                                                <div class="tab-content" >
                                                    <div class="tab-pane fade show active" id="u_comment">
                                                       <div class="tab-post">
                                                           <div class="comment-wrap">
                                                                <div class="post-block-wrapper bg-white p-2">
                                                                    <div class="head">
                                                                        <h4 class="title">Comment</h4>
                                                                    </div>
                                                                    <div class="body">
                                                                        @php
                                                                        $id=Session:: get('id');
                                                                        $visitor=App\Visitor:: where('id',$id)->first();
                                                                        @endphp

                                                                        @if($visitor)
                                                                        <div class="post-comment-form">
                                                                            <form action="{{url('post/comment/' .$data->id)}}" method="post" class="row">
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
                                                             @foreach($data->comment as $data)
                                                            <div class="post-author cat-top-border" style="    border-top: 1px solid #013359">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 sidebar col-12">
                <!-- Post Block Wrapper Start -->
                <div class="post-block-wrapper right-bar-tab bg-white mt-15 left-content" style="border: 1px solid #ccc; margin-top: 0;">
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
                                                
                                                <a class="image videos-post" href="{{url('post/view/'.$data->id)}}"><img src="{{asset('post/'.$data->image)}}" alt="post" style="height: 92.5px;" /> </a>
                                                <div class="content">
                                                    <h5 class="title"><a href="{{url('post/view/'.$data->id)}}">{{$data->title}}</a></h5>
                                                    <span class="cat_name p-1">{{str_limit($data->sub_title,25)}}</span>
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
                        </div>
                    </div>
                </div>
<div class="post-section section mt-30 mb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 co-md-8 col-12 left-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="head sec-head column-head">
                            <h4 class="title">ক্যাটাগরি {{$twocategorys->name}}</h4>
                            <a href="{{url('category/'.$categorys->slug)}}" class="more-cat-news no-line">আরো পড়ুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                        </div>
                        <div class="row mt-10">
                            @foreach($twocategorys->posts->take(4) as $category)
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="post 3-col-post mb-10">
                                    <div class="post-wrap pb-15">
                                        <a class="image" href="{{url('post/view/'.$category->id)}}"><img src="{{asset('post/'.$category->image)}}" style="height:125px" /></a>
                                        <div class="content">
                                            <a href="{{url('post/view/'.$category->id)}}">
                                                <h4 class="title">{{str_limit($category->title,50)}}</h4>
                                        <span class="cat_name p-1">{{str_limit($category->sub_title,25)}}</span>

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
                            <h4 class="title">ক্যাটাগরি {{$threecategorys->name}}</h4>
                            <a href="{{url('category/'.$categorys->slug)}}" class="more-cat-news no-line">আরো পড়ুন <i class="fa fa-caret-right" aria-hidden="true"></i></a>
                        </div>
                        <div class="row mt-10">
                            @foreach($threecategorys->posts->take(4) as $category)
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="post 3-col-post mb-10">
                                    <div class="post-wrap pb-15">
                                        <a class="image" href="{{url('post/view/'.$category->id)}}"><img src="{{asset('post/'.$category->image)}}" style="height:125px" /></a>
                                        <div class="content">
                                            <a href="{{url('post/view/'.$category->id)}}">
                                                <h4 class="title">{{str_limit($category->title,50)}}</h4>
                                        <span class="cat_name p-1">{{str_limit($category->sub_title,25)}}</span>

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
                
                @php
                $ads=App\Ads:: where('status',1)->where('is_approve',1)->where('manage',2)->limit(1)->get();
                @endphp
                @foreach($ads as $data)
                <div class="bN300">
                    <img src="{{asset('uploads/gallery/'.$data->image)}}" width="100%" />
                </div>
                @endforeach    
            </div>

            <!-- Col-3 End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>

    </div>
@endsection

