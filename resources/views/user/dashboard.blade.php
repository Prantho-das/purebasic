@extends('layouts.register')
@section('content')
    <div class="profileContainer">
        <div class="row batchCategories">
            
            <div class="col-3">&nbsp</div>
                
            <div class="col-6">
            
                    
                <a href="/batches/category/1" class="batchCategory"><h3>Medicine</h3></a>
                
                <a href="/batches/category/2" class="batchCategory" style="margin-right:2%; margin-left:2%;"><h3>Dentistry</h3></a>
                
                <a href="/batches/category/3" class="batchCategory"><h3>BCS</h3></a>
                
            </div>
            
            <div class="col-3">&nbsp</div>
            
        </div>


        @if (empty($courses))
    
            <div class="row">
            
                <div class="col-4">&nbsp</div>
                
                    <div class="col-4 alert">
                        
                        <div class="centerText">
                            <h3>No Enrollment</h3>
                            <p>You have not enrolled in any program. Meanwhile you can enjoy free lectures and free exams</p>
                        </div>
    
                        <div class="row">
                            
                            <div class="col-4 centerText contentLink">
                                <a href="/student/free_lecture"><h3>Free Lectures</h3></a>
    
                            </div>
                            
                            <div class="col-4">&nbsp</div>
                            
                            <div class="col-4 centerText contentLink">
                                <a href="/student/free_exam"><h3>Free Exams</h3></a>
                            </div>
                            
                        </div>
                    
                    </div>
                        
                <div class="col-4">&nbsp</div>
            </div>
    
        @endif
    
            
    
        <div class="row">
            
            <div class="col-4">&nbsp</div>
    
            <div class="col-4">
                
                @foreach($courses as $sub_course)
            
                    
                    @foreach($sub_course as $course)
                    
                        @if (!empty($course->course))
                        
                            <div class="enrolledProgram">
                  
                                <h2 class="batchTitle">{{$course->course->plan}}</h2>
            
                            
                                <h5>For {{$course->course->graduation}}</h5>
                                
                                <div class="marginBelow">
                                    
                                    @if ($course->enroll_status == 0)
                                        <h5>Approval Status : <span class="red">Pending</span></h5>
                                        <a class="verifyLink centerText" href="{{url('/payment/'.$course->batch_id)}}">Update Payment Info</a>

                                            
                                    @elseif ($course->enroll_status == 1)
                                        <h5>Approval Status : <span class = "green">Activated</span></h5>
                                    
                                        
                                        
                                    @else
                                        <h5>Approval Status : <span class="red">Deactivated/Rejected </span></h5>
                                    @endif
      
    
                                    
                                </div>
                                
                                <div>Fees : {{$course->fees}}<span style="float:right">Paid : {{$course->paid}}</span></div>

    
                                @if($course->enroll_status==1)
                                
                                    @php
                                        $endStr = substr($course->subscription_end,0,10);
                                        
                                        $endNum = (int) $endStr;
                                        
                                        $end = new DateTime($endStr);
    
                                        $current = new DateTime(date("Y-m-d"));
    
    
                                        $remaining = $end->diff($current)->format('%a');;
                                    
                                    @endphp
                                
                                    <div>Subscription End : {{$endStr}}</div>

                                    
                                    <div>
                                        Subscription remaining : <span class= {{(int)$remaining <= 15 ? "red" : "green"}}>{{$remaining}} Days</span> 
                                    </div>

                                    @if ($endNum > 0)
                                        <div style="padding-top: 2rem; padding-bottom: 2rem;">
                                            <a class="centerText lectureLink linkCategory" href="{{url('batch/'.$course->batch_id.'/subjects')}}">Lecture</a>

                                            <a class="centerText examLink linkCategory" href="{{url('exam_by_batch',$course->batch_id)}}">Exam</a>
                                    
                                            <a class="centerText scheduleLink linkCategory" href="{{url('schedule/batch/'.$course->batch_id)}}">Schedule</a>
                                            
                                        </div>

                                        <div style="padding-top: 2rem; padding-bottom: 2rem;">
                                                                                   <a class="centerText discussionLink linkCategory" href="{{url('discussion/batch/'.$course->batch_id)}}">Discussion</a>
                                        
                                        </div>
                                        
                                        <div style="padding-top: 2rem; padding-bottom: 2rem;">
                                                                                   <a class="centerText liveLink linkCategory" href="{{url('live/'.$course->batch_id)}}">Live Class</a>
                                        
                                        </div>

                                    @endif
                                    
                                    
                                    
                                    
                                @elseif ($course->enroll_status == 0)
                                    <h5 class="red">Please wait 24 hours for approval</h5>                                
                                @else
                                    <h5 class="red">Please whatsapp us</h5>
                                @endif
                                
                            </div>
                		  
                        @endif
              
        		    @endforeach
        		    
                @endforeach
    
            </div>
            
            <div class="col-4">&nbsp</div>
            
          </div>
    </div>

@endsection
