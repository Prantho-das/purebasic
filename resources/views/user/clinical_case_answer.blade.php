@extends('layouts.register')
@section('content')



<div class="row container">
    
    <div class="col-3">&nbsp</div>
    
    <div class="col-6">

        <div class="centerText">
            <div>
                <h3>{{$modelTest->name}} </h3>
            </div>
            
        </div>
                @foreach($modelTest->questions as $key=> $data)
                
                        @php
                            $question_segment = explode('\n', $data->question);
                        @endphp
                        
                    <div class="answer">
                           <label><h3>{{$data->is_multi == 1 ? "MCQ" : "SBA"}}</h3></label> 
                            <label><b>{{$key+1}}. </b></label>
                           
                           <label style="display: inline;">
                                    @foreach ($question_segment as $label)
                                                @if(str_starts_with($label, 'src:'))
                                                    <p><img src="/{{str_replace('src:', '', $label)}}" width="50%"></p>
                                                
                                                @else
                                                    <span><b>{{$label}}</b></span><br>
                                                
                                                @endif
                                    @endforeach
                            </label>

                            @php
                            
                            
                            $options = App\Option::where('question_id',$data->id)->get();
                            
                            @endphp
                        
                            @foreach ($options as $keyOpt => $option)
                            
                                @php
                                    $option_segment = explode('\n', $option->option);
                                @endphp
                            
                            
                                @if ($data->is_multi == 1)
                                    <p>
                                        <span class="badge {{$option->correct_or_not == 1 ? 'greenBg' : 'whiteBg'}}">T</span>&nbsp&nbsp<span class="badge {{$option->correct_or_not == 1 ? 'whiteBg' : 'redBg'}}">F</span>
                                    
                                    
                                        <label style="display: inline;">        
                                        
                                            @foreach ($option_segment as $label)
                                                @if(str_starts_with($label, 'src:'))
                                                    <p><img src="/{{str_replace('src:', '', $label)}}" width="50%"></p>
                                                
                                                @else
                                                    <span class="questionOption">{{$label}}</span><br>
                                                
                                                @endif
                                            @endforeach
                                        </label>
                                    </p>
                                    
                                @else
                                    @php
                                        $split = explode(".", $option->option);
                                        $option_segment = explode('\n', $split[1]);
                                    @endphp
                                    <p>
                                        <span class="badge {{$option->correct_or_not == 1 ? 'greenBg' : ''}}">{{$split[0]}}.</span>
                                        <span>&nbsp</span>
                                        
                                        <label style="display: inline;">        
                                        
                                            @foreach ($option_segment as $label)
                                                @if(str_starts_with($label, 'src:'))
                                                    <p><img src="/{{str_replace('src:', '', $label) . '.jpeg'}}" width="50%"></p>
                                                
                                                @else
                                                    <span class="questionOption">{{$label}}</span><br>
                                                
                                                @endif
                                            @endforeach
                                        </label>
                                    </p>

                                @endif
                                
                                
                                
                            @endforeach
                            
                            <button class="detailsButton" onclick="toggleDetails({{$key}})">Details</button>
                            
                            @if($data->solve_link)
                                <a class="detailsButton" href="/solve_video/{{$modelTest->id}}/{{$data->id}}">Video</a>
                            @endif

                            <div class="answerDetails" id="{{$key}}">
                                @php
                                    $details = explode('\n', $data->detailss);
                                @endphp
                                
                                @foreach ($details as $label)
                                    @if(str_starts_with($label, 'src:'))
                                        <p><img src="/{{str_replace('src:', '', $label)}}" width="50%"></p>
                                    
                                    @else
                                        <label>{{$label}}</label><br>
                                    
                                    @endif
                                @endforeach
                            </div>
                            
                    </div>
                @endforeach
                
    
        
        </div>
        
    </div>
    
    <div class="col-3">&nbsp</div>

</div>

<script>

    
 function toggleDetails(detailsId) {
     var detailsElem = document.getElementById(detailsId)

     if (detailsElem.style.display === "block") {
         detailsElem.style.display = "none";
     } else {
         detailsElem.style.display = "block";
     }
 }
</script>

@endsection
