@extends('layouts.website')
@section('content')

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="exam">
                      <h2>Today Exam Start</h2>
                      <h4>8.00pm-12pm Any one can attend this exam</h4>
                      <p>দয়া করে রাত ৮টা পর্যন্ত অপেক্ষা করুন। প্রতিদিন রাত ৮ টা থেকে রাত ১২ টা পর্যন্ত পরীক্ষা দেওয়া যাবে।</p>
                      <a href="{{url('result-sheet')}}" class="btn btn-danger">View Result</a>
                    </div>

                    <div class="exam_section">
                        <h2>=== সাপ্তাহিক পরিকল্পনা ===</h2>
                        <div class="row">
                          @foreach($allsheet as $data)
                          <div class="col-md-6">
                            <div class="exam_date">
                              <div class="exam_title">
                                <h4>Exam Date : {{$data->date_time}}</h4>
                              </div>
                              <ul>
                                <li style="font-size: 18px;">{{$data->title}}</li>
                                <li>{{$data->lecture_name}}@if($data->lecture_name !=NULL)<a href="{{url('/lecture-view/'.$data->id)}}" style="float: right;">Click to view</a>@else @endif</li>
                              </ul>
                            </div>
                          </div>
                          @endforeach
                          </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                    <div class="notic_header" style="margin-top: 37px;">
                        <h5>Last Week Best Student</h5>
                    </div>
                    @foreach($beststudent as $key=>$data)
                    <div class="user_result" style="margin-top: 0px;">
                        <img src="{{asset('uploads/user/'.$data->students->photo)}}">
                        <h4>{{$data->students->name}}</h4>
                         <p>Total Marks: {{$data->answered_questions}}</p>
                        <span>Last Week Best {{$key+1}}</span>
                    </div>
                    @endforeach
                </div>
                </div>

                
            </div>
        </div>

@endsection
