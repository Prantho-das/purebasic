@extends('layouts.register')
@section('content')



    <div class="row container" id="questionContainer">
        <div class="col-3">&nbsp</div>
        <div class="col-6">
            <div class="centerText">{{$modelTest->name}}</div>
            <div class="centerText">Total Marks : {{$modelTest->exam_in_minutes}}</div>            
            <div class="centerText">Time : {{$modelTest->ex_time}} minutes</div>
            <div class="centerText"><h3 id="counter" class="red"></h3></div>            
            
            <form method="post" id="question_paper" action="{{url('/answerQuestionModeltest')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$modelTest->id}}" name="modeltest_id">
                <input type="hidden" value="{{$modelTest->exam_pattern}}" name="modeltest_exam_pattern">
                <input type="hidden" value="{{$modelTest->exam_in_minutes}}" name="modeltest_total_mark">                
                <div class="row">

                    @foreach($modelTest->questions as $key=> $data)
                    
                    
                        @php
                            $question_segment = explode('\n', $data->question);
                        @endphp
                        
                        <div class="question">
                            <input type="text" hidden="" value="{{$data->id}}"
                                   name="questions[{{$key}}][questionId]">
                            <div id="{{$key}}">
                                
                                @if($data->is_multi==1)
                                    <label><h3><b>MCQ</b></h3></label>
                                
                                @else
                                    <label><h3><b>SBA</b></h3></label>
                                @endif

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
                                    

                                    
                                    <div class="row">
                                        <div>
                                                <input type='{{$data->is_multi == 1 ? "checkbox" : "radio"}}'
                                                       name="questions[{{$key}}][option][{{$data->is_multi == 1 ? $keyOpt : $key }}]"
                                                       value="{{$option->id}}" id="option1" style="display: inline;">
                                                       
                                            <label style="display: inline;">                                       @foreach ($option_segment as $label)
                                                @if(str_starts_with($label, 'src:'))
                                                    <p><img src="/{{str_replace('src:', '', $label)}}" width="50%"></p>
                                                
                                                @else
                                                    <span class="questionOption">{{$label}}</span><br>
                                                
                                                @endif
                                            @endforeach
                                            </label>

                                        </div>
                                    </div>
                                @endforeach
    
                            </div>
                        </div>
                    @endforeach
                    
                    @if($modelTest->exam_pattern == "Regular exam")
                        <div class="question">
                            <label>
                                <h3>
                                    <b>
                                        Select Candidate Type:
                                    </b>
                                </h3>
                            </label>
                            <div class="row">
                                        <input type="radio"
                                               name="candidate"
                                               value="Government" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Government</label>
                            </div>
                            
                            <div class="row">
                                <div>
                                        <input type="radio"
                                               name="candidate"
                                               value="Private" style="display: inline;">
                                        <label class="questionOption" style="display: inline;">Private</label>
                                </div>
                            </div>
                            
                        </div>
                        <div class="question">
                            <label>
                                <h3>
                                    <b>
                                        Select Discipline:
                                    </b>
                                </h3>
                            </label>
                            <div class="row">
                                        <input type="radio"
                                               name="discipline"
                                               value="Oral & Maxillofacial Surgery" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Oral & Maxillofacial Surgery</label>
                            </div>
                            <div class="row">
                                        <input type="radio"
                                               name="discipline"
                                               value="Orthodontics" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Orthodontics</label>
                            </div>
                            <div class="row">
                                        <input type="radio"
                                               name="discipline"
                                               value="Prosthodontics" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Prosthodontics</label>
                            </div>
                            <div class="row">
                                        <input type="radio"
                                               name="discipline"
                                               value="Conservative Dentistry & Endodontics" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Conservative Dentistry & Endodontics</label>
                            </div>

                            <div class="row">
                                        <input type="radio"
                                               name="discipline"
                                               value="Pedodontics" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Pedodontics</label>
                            </div>
                            <div class="row">
                                        <input type="radio"
                                               name="discipline"
                                               value="Oral & Maxillofacial Pathology" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Oral & Maxillofacial Pathology</label>
                            </div>
                            <div class="row">
                                        <input type="radio"
                                               name="discipline"
                                               value="Periodontology" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Periodontology</label>
                            </div>
                            <div class="row">
                                        <input type="radio"
                                               name="discipline"
                                               value="Oral Anatomy" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Oral Anatomy</label>
                            </div>
                            <div class="row">
                                        <input type="radio"
                                               name="discipline"
                                               value="Dental Pharmacology" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Dental Pharmacology</label>
                            </div>
                            <div class="row">
                                        <input type="radio"
                                               name="discipline"
                                               value="Dental Materials" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Dental Materials</label>
                            </div>
                        </div>
                    @endif

                </div>
            </form>
            
            <div>
                <button onclick="plusQuestion(-1)" class="previousButton">
                    Previous
                </button>

                <button class="finishButton" onclick="confirmSubmit()">
                    Finish
                </button>
                
                <button onclick="plusQuestion(1)" class="nextButton">
                    Next
                </button>
            </div>
                        
                
        </div>
    </div>

    <div class="row container">
        <div class="col-3">&nbsp</div>
        <div id="submitModal" class="modal col-6">
        
          <div class="modal-content">
            <p>Do you want to finish the exam ?</p>
            <button class="finishButton" onclick="submit()">
                Yes
            </button>
            <button class="finishButton" onclick="cancel()">
                No
            </button>
          </div>
        
        </div> 
    </div>


    <script>

        let exam_length = {{$modelTest->ex_time}};
        let exam_length_in_micro = exam_length * 60 * 1000;
        
        setTimeout(function () {

            document.getElementById("question_paper").submit();
        }, exam_length_in_micro);
        
        let timer2 = "{{$modelTest->ex_time}}:00";
        let interval = setInterval(function () {
            let timer = timer2.split(':');
            console.log(timer);
            if (timer[0] == '0' && timer[1] == '01') {
                clearInterval(interval);
            }

            let minutes = parseInt(timer[0], 10);
            let seconds = parseInt(timer[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            if (minutes < 0) clearInterval(interval);
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;

            document.getElementById("counter").innerText = "Time Left - " + minutes + ':' + seconds;
            timer2 = minutes + ':' + seconds;
        }, 1000);


        let questionIndex = 1;
        showQuestions(questionIndex);
        
        
        function plusQuestion(n) {
          showQuestions(questionIndex += n);
        }
        
        function showQuestions(n) {
          let i;
          let questions = document.getElementsByClassName("question");
        
          if (n > questions.length) {questionIndex = 1}
          if (n < 1) {questionIndex = questions.length}
          for (i = 0; i < questions.length; i++) {
            questions[i].style.display = "none";
          }
        
          questions[questionIndex-1].style.display = "block";
        }


        function confirmSubmit() {
            document.getElementById("questionContainer").style.display = "none";
            document.getElementById("submitModal").style.display = "block";
        }
        

        function cancel() {
            document.getElementById("questionContainer").style.display = "block";
            document.getElementById("submitModal").style.display = "none";
        }
        
        function submit() {
            document.getElementById("question_paper").submit();
        }        

    
    </script>
@endsection
