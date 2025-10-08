@extends('layouts.website')
@section('content')
    <div class="post-section section mt-30">
        <div class="container">
            <div class="row">
                @foreach($allphotos as $data)
                <div class="col-md-3">
                    <div class="photo_story">
                        <img src="{{asset('uploads/gallery/'.$data->photo)}}" width="100%">
                        <span>{{$data->sourse}}</span>
                        <p>{{$data->caption}}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div><!-- Container End -->
    </div><!-- Post Section End -->


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