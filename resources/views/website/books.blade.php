@extends('layouts.website')
@section('content')
    <div class="container">
		<div style="margin-top:150px"></div>
        <div class="row">
			@foreach($books as $data)
            <div class="col-md-3" style="margin-bottom: 2.5em">
                <div class="my_cl text-center" style="background: #fff; box-shadow: 0px 0px 5px 0px #ccc;    padding-bottom: 15px;">
                   <img src="{{asset('uploads/user/'.$data->image)}}" style="width:250px;height:20em">
					<h6 style="margin-top:10px">{{$data->name}}</h6>
					<a href="{{$data->url}}" style="background: #2B96CC; color: #fff; padding: 5px 11px; border-radius: 13px;">Downloads</a>
                </div>
            </div>
			@endforeach
        </div>
    </div>
@endsection
