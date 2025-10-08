@extends('layouts.register')
@section('content')


      <!-- Section:about-->
      <section id="about">
        <div class="container pb-60">
          <div class="section-content">
                <h2 class="text-uppercase font-28 line-bottom mt-0 line-height-1">Our <span class="text-theme-color-2 font-weight-400" style="font-size: 32px">On Going Batch</span></h2>
            <div class="row">
				{{-- @php
					$batchh=App\Membership:: where('status',1)->where('show',1)->get();
				@endphp --}}
				@foreach($batchpackages as $batchpackage)
              <div class="col-md-3">
                  <div class="tab_con text-center">
        			<div class=tab_hed>
        			    <h1>{{$batchpackage->title}}</h1>
        			</div>
        			<div class="ser">
        				<ul>
                			<li>{{$batchpackage->fild_1}}</li>
                			<li>{{$batchpackage->fild_2}}</li>
                			<li>{{$batchpackage->fild_3}}</li>
                			<li>{{$batchpackage->fild_4}} </li>
                			<li>{{$batchpackage->fild_5}} </li>
                			<li>{{$batchpackage->fild_6}}</li>
                			<li>{{$batchpackage->fild_7}}</li>
                			<li>{{$batchpackage->fild_8}} </li>
                			<li>{{$batchpackage->fild_9}}</li>
                      <li>{{$batchpackage->fild_10}}</li>
        				</ul>
        			</div>
					  <a href="{{$batchpackage->link}}" style="margin-top: 14px;    background: linear-gradient(90deg, rgb(213 88 0) 0%, rgb(183 215 7) 100%);">View More</a>
					  <br>
        		      <a href="{{url('/student/batch/'.$batchpackage->batch_id.'/enroll')}}">Enroll Now</a>

        			<div style="margin-bottom:30px"></div>
        		</div>
              </div>
				@endforeach
            </div>
          </div>
        </div>
      </section>

    </div>

    @endsection
