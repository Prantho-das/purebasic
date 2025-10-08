@extends('layouts.register')
@section('content')
    <div class="profileContainer">
    
        <div class="row">
            
            <div class="col-4">&nbsp</div>
    
            <div class="col-4">
                
                @foreach($enrolledBatches as $sub_category)
            
                    
                    @foreach($sub_category as $batch)
                    
                        @if (!empty($batch->course))
                        
                            <div class="enrolledProgram">
                  
                                <h2 class="batchTitle">{{$batch->course->plan}}</h2>
            
                            
                                <h5>For {{$batch->course->graduation}}</h5>
                                
                                <div class="marginBelow">
                                    
                                    @if ($batch->enroll_status == 0)
                                        <h5>Approval Status : <span class="red">Pending</span></h5>
                                        <a class="verifyLink centerText" href="{{url('/updateInfo/' . $id . '/batch/' .$batch->batch_id)}}">Update Payment Info</a>

                                            
                                    @elseif ($batch->enroll_status == 1)
                                        <h5>Approval Status : <span class = "green">Activated</span></h5>
                                    
                                        
                                        
                                    @else
                                        <h5>Approval Status : <span class="red">Deactivated/Rejected </span></h5>
                                    @endif
      
    
                                    
                                </div>
                                
                                <div>Fees : {{$batch->fees}}<span style="float:right">Paid : {{$batch->paid}}</span></div>

    
                                @if($batch->enroll_status==1)
                                
                                    @php
                                        $endStr = substr($batch->subscription_end,0,10);
                                        

                                        $end = new DateTime($endStr);
    
                                        $current = new DateTime(date("Y-m-d"));
    
    
                                        $remaining = $end->diff($current)->format('%a');;
                                    
                                    @endphp
                                    
                                    @if ($current <= $end)
                                    
                                        <div>Subscription End : {{$endStr}}</div>
    
                                        
                                        <div>
                                            Subscription remaining : <span class= {{(int)$remaining <= 15 ? "red" : "green"}}>{{$remaining}} Days</span> 
                                        </div>
                                        
                                    @else
                                        <div class="red">Subscription Over</div>                                    
                                    
                                    @endif
                                    
                                    
                                    
                                    
                                @elseif ($batch->enroll_status == 0)
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
