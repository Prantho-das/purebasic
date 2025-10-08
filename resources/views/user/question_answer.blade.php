@extends('layouts.register')
@section('content')



<div class="row container">
    
    <div class="col-3">&nbsp</div>
    
    <div class="col-6">

        <div class="centerText">
            <div>
                <h3>{{$modelTest->name}} </h3>
            </div>
            <div>
                <h3 id="totalQuestions">Total Questions {{$modelTestAnswer->total_mcq + $modelTestAnswer->total_sba}} {{$modelTestAnswer->total_mcq > 0 ? "- " . $modelTestAnswer->total_mcq . " mcq" : ""}} {{$modelTestAnswer->total_sba > 0 ? "- " . $modelTestAnswer->total_sba . " sba" : ""}}</h3>
            </div>
            
            @if ($modelTestAnswer->total_mcq > 0)
                <div>
                    <h3 id="correctMcq">Correct MCQ : {{$modelTestAnswer->right_mcq}} of {{$modelTestAnswer->total_mcq * 5}} options</h3>
                </div>
            @endif
            
            @if ($modelTestAnswer->total_sba > 0)
                <div>
                    <h3 id="correctSba">Correct SBA : {{$modelTestAnswer->right_sba}} of {{$modelTestAnswer->total_sba}}</h3>
                </div>
            @endif
            
            @if ($modelTest->exam_pattern == "Regular exam")
                <div>
                    <h3>Obtained marks :-</h3>
                    <h3>FCPS Standard : {{$modelTestAnswer->point . " out of " . $modelTest->exam_in_minutes}} ({{$modelTestAnswer->percentage}}%) <span style="color:{{$modelTestAnswer->percentage < 70 ? 'red' : 'green'}}">{{$modelTestAnswer->pass_status}} </span> </h3>
                    
                    <h3>MS/MD/DDS Standard : {{$modelTestAnswer->point_1 . " out of " . $modelTest->exam_in_minutes / 2}}</h3>
                </div>
            @endif
            
            @if ($modelTest->exam_pattern != "Regular exam" && $modelTest->exam_pattern !== "Lecture")
                <div>
                    <h3> Obtained marks : {{$modelTestAnswer->point}} </h3>
                </div>
            @endif
           
            <div>
                <h3><span class="green">&#x2713</span> indicates your submitted answer is right while <span class="red">&#x274c</span> indicates your submitted answer is wrong</h3>
            </div>
        </div>
                @foreach($modelTest->questions as $key=> $data)
                    <div class="answer">
                           <label><b>{{$data->is_multi == 1 ? "MCQ" : "SBA"}}</b></label> 
                           <label><h3>{{$key+1}}. </b>{{$data->question}}</h3></label>

                            @php
                            
                            
                            $options = App\Option::where('question_id',$data->id)->get();
                            
                            @endphp
                        
                            @foreach ($options as $keyOpt => $option)
                            
                                @php
                                    $mark = "";
                                    $markBg = "";
                                    $answerBg = "";
                                
                                    if (in_array($option->id, $answeredOptions)) {
                                        if ($option->correct_or_not == 1) {
                                            $mark = "\u{2713}";
                                            $markBg = "correctAnswer";
                                            $answerBg = "correctBg";
                                            
                                        } else {
                                            $mark = "\u{274c}";
                                            $markBg = "wrongAnswer";
                                            $answerBg = "wrongBg";
                                        }
                                        
                                    } elseif ($data->is_multi == 1) {
                                    
                                        if ($option->correct_or_not == 1) {
                                            $mark = "\u{274c}";
                                            $markBg = "wrongAnswer";
                                            $answerBg = "wrongBg";
                                            
                                            
                                        } else {
                                            $mark = "\u{2713}";
                                            $markBg = "correctAnswer";
                                            $answerBg = "correctBg";
                                            
                                        }                                 
                                        
                                    }
                            
                                    
                                @endphp
                            
                                @if ($data->is_multi == 1)
                                    <p><span class="badge {{$option->correct_or_not == 1 ? 'greenBg' : 'whiteBg'}}">T</span>&nbsp&nbsp<span class="badge {{$option->correct_or_not == 1 ? 'whiteBg' : 'redBg'}}">F</span><span class="{{$answerBg}}">{{$option->option}}</span><span class={{$markBg}}>&nbsp{{$mark}}</span></p>
                                    
                                @else
                                    @php
                                        $split = explode(".", $option->option);
                                    @endphp
                                    <p><span class="badge {{$option->correct_or_not == 1 ? 'greenBg' : ''}}">{{$split[0]}}.</span>
                                    <span class="{{$answerBg}}">&nbsp{{$split[1]}}</span><span class={{$markBg}}>&nbsp{{$mark}}</span>
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
