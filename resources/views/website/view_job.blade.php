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
						<h5 style="font-size: 16px">{{$data->company}}</h5>
					</div>
					<div class="view_main">
						<h3>Job Responsibilities</h3>
						<p>
							{!! $data->description !!}
						</p>
					</div>


					<div class="summary">
						<div class="row">
							<div class="col-md-6">
								<div class="summary_sec">
									<div class="summary_header">
								<h3 style="font-size: 17px; color: #fff; font-weight: 700;">Job Summary</h3>
								</div>
								<ul>
									<li>Published on: <span> {{$data->created_at}}</span></li>
									<li>Vacancy:  <span>{{$data->vacancy}}</span></li>
									<li>Employment Status: <span>{{$data->e_status}}</span></li>
									<li>Experience: <span>{{$data->experience}}</span></li>
									<li>Gender: <span>{{$data->gender}}</span></li>
									<li>Age: <span>{{$data->age}}</span></li>
									<li>Job Location: <span>{{$data->location}}</span></li>
									<li>Salary: <span>Negotiable</span></li>
									<li>Application Deadline: <span>{{$data->deadline}}</span></li>
								</ul>
								</div>
							</div>
							<div class="col-md-6">
								<div class="view_ads">
									<img src="{{asset('contents/website')}}/img/adss.jpg">
					            </div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="apply">
								<a href="#" class="btn btn-info">Apply Now</a>
							</div>
						</div>
						<div class="col-md-6"></div>
					</div>

					<div class="shear_post">
						<h4 class="shear">শিয়ার পোস্ট</h4>

						<div class="s_icon text-right">
							<a href="#" style="background: #4267b2; color: #fff; padding: 10px 18px; word-spacing: 10px;"><i class="fa fa-facebook-f"></i> Facebook</a>
						<a href="#" style="background:rgb(26, 145, 218); color: #fff; padding: 10px 18px; word-spacing: 10px;"><i class="fa fa-twitter-square"></i> Twitter</a>
						<a href="#" style="background: #3f729b; color: #fff; padding: 10px 18px; word-spacing: 10px;"><i class="fa fa-instagram"></i> Instagram</a>

						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="job_grp">
					<div class="job_header">
						<h3>সর্বশেষ সংবাদ</h3>
					</div>

					@foreach($latestnews as $data)
					<div class="job_body">
						<a href="#">{{$data->title}}</a>
					</div>
					@endforeach
					
				</div>
				 @php
                $ads=App\Ads:: where('status',1)->where('is_approve',1)->where('manage',6)->orderBy('id','desc')->limit(1)->get();
                @endphp
                @foreach($ads as $data)
                <div class="bN300 border" style="margin-top: 30px;margin-bottom: 30px">
                    <img src="{{asset('uploads/gallery/'.$data->image)}}" class="border" style="height: 452px" />
                </div>
                @endforeach
			</div>
		</div>
	</div>
</section>



@endsection