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
                    <div class="answer">
                           <label><b>{{$data->is_multi == 1 ? "MCQ" : "SBA"}}</b></label> 
                           <label><h3>{{$key+1}}. </b>{{$data->question}}</h3></label>

                            @php
                            
                            
                            $options = App\QuestionBankOption::where('question_id',$data->id)->get();
                            
                            @endphp
                        
                            @foreach ($options as $keyOpt => $option)
                            
                            
                                @if ($data->is_multi == 1)
                                    <p><span class="badge {{$option->correct_or_not == 1 ? 'greenBg' : 'whiteBg'}}">T</span>&nbsp&nbsp<span class="badge {{$option->correct_or_not == 1 ? 'whiteBg' : 'redBg'}}">F</span><span>{{$option->option}}</span></p>
                                    
                                @else
                                    @php
                                        $split = explode(".", $option->option);
                                    @endphp
                                    <p><span class="badge {{$option->correct_or_not == 1 ? 'greenBg' : ''}}">{{$split[0]}}.</span>
                                    <span>&nbsp{{$split[1]}}</span>
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
