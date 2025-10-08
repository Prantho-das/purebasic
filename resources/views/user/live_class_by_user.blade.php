@extends('layouts.register')
@section('content')
    <div class="profileContainer">
            
    
        <div class="row">
            
            <div class="col-4">&nbsp</div>
    
            <div class="col-4">
                
                @foreach($enrolledBatches as $batch)
            
 
                    @if ($batch->fild_9)
                    
                    
                        @php
                            $endStr = substr($batch->subscription_end,0,10);
                            
        
                            $end = new DateTime($endStr);
        
                            $current = new DateTime(date("Y-m-d"));
        
        
                            $remaining = $end->diff($current)->format('%a');
                        
                        @endphp
                        
                        <div class="enrolledProgram">
      
                            <h2 class="batchTitle">{{$batch->title}}</h2>


                            <div>
                                Subscription remaining : <span class= {{(int)$remaining <= 15 ? "red" : "green"}}>{{$remaining}} Days</span> 
                            </div>

                        
                            
                            <div style="padding-top: 2rem; padding-bottom: 2rem;">
                                                                       <a class="centerText liveLink linkCategory" href="{{$batch->fild_9}}">Join Live Class</a>
                            
                            </div>
                        
                        </div>

                    @endif

        		    
                @endforeach
    
            </div>
            
            <div class="col-4">&nbsp</div>
            
          </div>
    </div>

@endsection
