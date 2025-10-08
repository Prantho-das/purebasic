@extends('layouts.register')
@section('content')

      <!-- Section:about-->

    <div class="row batchInfoContainer">
    
        <div class="col-4">&nbsp</div>
        
            <div class="col-4">
                
                @foreach($batchpackages as $batchpackage)
             
                    <div class="batchInfo">
                     
                        <h2 class="centerText batchTitle">{{$batchpackage->title}}</h2>
                        
                        <div class="marginAbove marginBelow">
                            
                            <div class="centerText"><b>{{$batchpackage->fild_1}}</b></div><br>
                            
                            @php
                                $packages = explode('\n', $batchpackage->fild_2);
                            @endphp
                            <div class="batchPackage centerText">{!! $batchpackage->fild_2 !!}</div>
                    
                            <!--div class="centerText"><b>{{count($packages) > 1 ? 'Packages' : 'Package' }}</b></div>
    
                            <div class="batchPackage centerText">
                                
                                @foreach ($packages as $package)
    
                                    <p><b>{{$package}}</b></p>
                                    
                                @endforeach
                                
                            </div-->
                            
                        </div>
                        
                    
                        <div class="row">
                
                            
                            <!--a class="col-4 centerText batchInfoButton" href="{{$batchpackage->fild_4}}">Content</a>
                            
                            <div class="col-4 hide-on-med">&nbsp</div>
                            
                            
                            <a class="col-4 centerText batchInfoButton" href="{{$batchpackage->fild_5}}">Schedule</a>
                            
                            <div class="col-12 hide-on-med">&nbsp</div-->
                            
                            <a class="col-12 centerText batchDetailsButton" href="{{url('/batch_details/'.$batchpackage->batch_id)}}">Batch Details</a>
                            
                            @if (!in_array($batchpackage->batch_id, $enrolledBatches))
                            
                                    <a class="col-12 centerText batchInfoButton" href="{{$batchpackage->module == 1 ? url('/batch/'.$batchpackage->batch_id.'/modules') : url('/student/batch/'.$batchpackage->batch_id.'/enroll')}}">Enroll Now</a>
                
                            @endif
                            
                        </div>
                      
                      </div>  
              
            	@endforeach
        	
        </div>

                
        <div class="col-4">&nbsp</div>
    
    </div>

    @endsection
