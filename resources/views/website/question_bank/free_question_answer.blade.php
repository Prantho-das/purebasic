@extends('layouts.question_bank')
@section('content')



<div class="row container">
    
    <div class="col-3">&nbsp</div>
    
    <div class="col-6">


        <div class="centerText">
            
            <div><h3>You are watching a free version of question bank. Buy it to view all questions..</h3></div>
            <a class="detailsButton" href="/student/batch/87/enroll">Buy Question Bank</a>
            <div>
                <h3>Subject : {{$modelTest->subject}}</h3>
                <h3>Chapter : {{$modelTest->chapter}}</h3>
                <h3>Topic : {{$modelTest->name}} </h3>
            </div>
            
        </div>
                @foreach($modelTest->questions as $key=> $data)
                
                    @if ($data->is_free == 1)
                        <div class="answer">
                               <label><b>Free Question - {{$data->is_multi == 1 ? "MCQ" : "SBA"}}</b></label> 
                               <label><h3>{{$key+1}}. </b>{{$data->question}}</h3></label>
    
                                @php
                                
                                
                                $options = App\QuestionBankOption::where('question_id',$data->id)->get();
                                
                                @endphp
                            
                                @foreach ($options as $keyOpt => $option)
                                
                                
                                    @if ($data->is_multi == 1)
                                        <p><span class="{{$data->id}}" style="display: none;"><span class="badge {{$option->correct_or_not == 1 ? 'greenBg' : 'whiteBg'}}">T</span>&nbsp&nbsp<span class="badge {{$option->correct_or_not == 1 ? 'whiteBg' : 'redBg'}}">F</span></span><span>{{$option->option}}</span></p>
                                        
                                    @else
    
                                        <p><span class="{{$data->id}}" style="display: none;"><span class="badge {{$option->correct_or_not == 1 ? 'greenBg' : ''}}">{{$option->correct_or_not == 1 ? 'T' : 'F'}}</span> </span>
                                        <span>&nbsp&nbsp{{$option->option}}</span>
                                        </p>
    
                                    @endif
                                    
                                    
                                    
                                @endforeach
                            
                                <button class="detailsButton" onclick="toggleAnswer({{$data->id}})">Answer</button>
                                
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
                        
                    @endif
                
                @endforeach
                
    
        
        </div>
        
    </div>
    
    <div class="col-3">&nbsp</div>

</div>

<script>


 function toggleAnswer(answerId) {
     
    var answerElems = document.getElementsByClassName(answerId);

    var len =  answerElems.length;
    
    for(var i=0 ; i<len; i++){
        
        if (answerElems[i].style.display === "inline") {
                 answerElems[i].style.display = "none";
             } else {
                 answerElems[i].style.display = "inline";
             }
    }


 }
 

    
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
