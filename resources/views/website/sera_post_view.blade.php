@extends('layouts.website')
@section('content')


<section style="margin-top: 20px">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="view_post">

					<div class="view_body">
						<span style="font-size: 14px;">Pulished: {{$data->created_at}}</span>
						<h3 style="font-size: 24px; color: #3f9f3f; font-weight: 700;margin-top: 19px;text-transform: capitalize;">
						{{$data->title}}
						</h3>
					</div>

					<div class="view_main">
						 <img src="{{asset('post/'.$data->image)}}" width="100%" class="img_padding">
						<p>
							{!! $data->description !!}
						</p>
					</div>

				</div>
			</div>
			<div class="col-md-4">
				
				<div class="view_right">

					<div class="post-block-wrapper right-bar-tab bg-white mt-30 mb-20 sticky-top">
                            <div class="head sports-head" style=" border-bottom: 2px solid #d0cfcf;  border-top: none">
                                <h5 class="title pl-2">সকল পোস্ট</h5>
                            </div>
                            <div class="body pb-10 mt-10">
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="week">
                                       <div class="tab-post">
                                           <div class="right-bar-post-list">
                                                @foreach($sera as $data)
                                                <div class="post v-post post-small post-mr-sm post-list feature-post post-separator-border">
                                                   <div class="post-wrap pr-2 bg-white">
                                                    <div class="content">
                                                        <h5 class="title"><a href="{{url('/amader/sera/category-post/'.$data->id)}}">{{str_limit($data->title,50)}}</a></h5>
                                                    </div>
                                                    <a class="image videos-post" href="#"><img src="{{asset('post/'.$data->image)}}" alt="post">
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
                        
					<img src="{{asset('contents/website')}}/img/adss.jpg">
	            </div>
			</div>
		</div>
	</div>
</section>



@endsection