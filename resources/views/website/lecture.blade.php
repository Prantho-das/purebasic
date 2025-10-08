@extends('layouts.website')
@section('content')

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="lecture">
                      <h6>{{$view->title}}</h6>
                      <h1>{{$view->lecture_name}}</h1>
                      <p>{!! $view->details !!}</p>
                    </div>
                </div>

                <div class="col-md-4">
                  <div class="lecture_section">
                      <div class="notic_header" style="margin-top: 37px;">
                        <h5>Other Lecture Sheet</h5>
                    </div>
                    @foreach($allsheet as $data)
                    <div class="lecture_sub" style="margin-top: 0px;">
                        <a href="{{url('lecture-view/'.$data->id)}}"><h4>{{$data->lecture_name}}</h4></a>
                    </div>
                    @endforeach

                  </div>
                </div>
            </div>
        </div>

@endsection
