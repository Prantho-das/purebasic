@extends('layouts.website')
@section('content')
<section style="margin-bottom: 30px">
	<div class="container">
		<div class="row">
			<div class="col-md-8" style="border: 1px solid #ccc; padding: 0; border-bottom: none; border-left: none;">
				<div class="job_headerr">
					<h3>সকল জব</h3>
				</div>
				@foreach($alljob as $data)
				<div class="ex_css">
					<div class="row">
					
					<div class="col-md-2">
						<div class="job_image">
							<img src="{{asset('post/'.$data->image)}}">
						</div>
					</div>
					<div class="col-md-10">
						<div class="post_section">
						
							

							<div class="postt">
								<h3>
									<a href="{{url('job/post/'.$data->id)}}" style="font-size: 17px; color: #3f9f3f; font-weight: 700;text-transform: capitalize;">
									{{$data->title}}
									</a>
							</h3>
								<ul>
									<li><i class="fa fa-location-arrow"></i> dhaka</li>
									<li><i class="fa fa-graduation-cap"></i> {{$data->company	}}</li>
									<li style="float: left;"><i class="fa fa-graduation-cap"></i> {{$data->experience}}</li>
									<li class="text-right"><i class="fa fa-calendar"></i> {{$data->created_at }}</li>
								</ul>
							</div>
						<div>
						</div>
						</div>
					</div>
					
				</div>
				</div>
				@endforeach
				<div style="margin-top: 10px; float: right;">
					{{ $alljob->links() }}
				</div>
				

			</div>
			<div class="col-md-4">
				<div class="job_grp mb-20" style="margin-top: 0px">
					<div class="dropdown">
					  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 11px 129px;">
					   বিভাগ ভিত্তিক চাকরি
					  </button>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 100%;">
					  	@foreach($distric as $data)
					    <a class="dropdown-item" href="{{url('/dictric/post/'.$data->id)}}">{{$data->name}}</a>
					    @endforeach
					  </div>
					</div>
				</div>
				 
                @php
                $ads=App\Ads:: where('status',1)->where('is_approve',1)->where('manage',6)->orderBy('id','desc')->limit(1)->get();
                @endphp
                @foreach($ads as $data)
                <div class="bN300 border">
                    <img src="{{asset('uploads/gallery/'.$data->image)}}" class="border" style="height: 452px" />
                </div>
                @endforeach
                </div>
			</div>
		</div>
	</div>
</section>
<section class="header-top header-top-2 section">

	<div class="banner_job" style="background: #FBF308">
		<div class="container">
			<div class="col-md-12">
				<div class="slider-logo owl-carousel">

		    <div class="slider-wrapper text-center ploooooo">
		        <img src="https://jobs.bdjobs.com/images/bdjobslogo.gif" />
		    </div>
		    <div class="slider-wrapper text-center ploooooo">
		        <img src="https://jobs.bdjobs.com/images/bdjobslogo.gif" />
		    </div>
		    <div class="slider-wrapper text-center ploooooo">
		        <img src="https://jobs.bdjobs.com/images/bdjobslogo.gif" />
		    </div>


		</div>
			</div>
		</div>
	</div>

</section>


<section>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div  style="margin-top: 35px; border: 1px solid #ccc; padding: 0;">
					<div class="row">
					@foreach($govjob as $data)
					<div class="col-md-4">
						<div class="gov_job">
							<img src="{{asset('post/'.$data->image)}}" width="100%">
							<div class="gov_footer">
								<h5><a href="{{url('job/post/'.$data->id)}}"> {{$data->title}}</a></h5>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				</div>
				<div style="float: right;margin-bottom: 15px">
					{{ $govjob->links() }}
				</div>
			</div>
			<div class="col-md-4">
				<div style="margin-top: 34px;">
                @php
                $ads=App\Ads:: where('status',1)->where('is_approve',1)->where('manage',7)->orderBy('id','desc')->limit(1)->get();
                @endphp
                @foreach($ads as $data)
                <div class="bN300 border">
                    <img src="{{asset('uploads/gallery/'.$data->image)}}" class="border" style="height:465px" />
                </div>
                @endforeach
                </div>
                <div class="fb-page" data-href="https://www.facebook.com/facebook" data-width="380" data-hide-cover="false" data-show-facepile="false" style="    margin-top: 0px;"></div>
				<div style="margin-top: 34px;">
			</div>
		</div>
	</div>
</section>
@endsection