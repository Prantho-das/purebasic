@extends('layouts.register')
@section('content')



    <div class="row container" id="questionContainer">
        <div class="col-3">&nbsp</div>
        <div class="col-6">
            <div class="centerText">{{$modelTest->name}}</div>
            <div class="centerText">Total Marks : {{$modelTest->exam_in_minutes}}</div>            
            <div class="centerText">Time : {{$modelTest->ex_time}} minutes</div>

            <form method="post" id="question_paper" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$modelTest->id}}" name="modeltest_id">
                <input type="hidden" value="{{$modelTest->exam_pattern}}" name="modeltest_exam_pattern">
                <input type="hidden" value="{{$modelTest->exam_in_minutes}}" name="modeltest_total_mark">                
                <div class="row">

                    @foreach($modelTest->questions as $key=> $data)
                        <div class="question">
                            <input type="text" hidden="" value="{{$data->id}}"
                                   name="questions[{{$key}}][questionId]">
                            <div id="{{$key}}">
                                @if($data->is_multi==1)
                                    <label><h3><b>MCQ</b></h3></label>
                                    <label><h3><b>{{$key+1}}. </b>{{$data->question}}
                                        </h3></label>
                                @else
                                    <label><h3><b>SBA</b></h3></label>
                                    <label><h3><b>{{$key+1}}. </b>{{$data->question}}
                                        </h3></label>
                                @endif
    
                                @php
                                    $options = App\Option::where('question_id',$data->id)->get();
                                @endphp
                                @foreach ($options as $keyOpt => $option)
                                    <div class="row">
                                        <div>
                                                <input type='{{$data->is_multi == 1 ? "checkbox" : "radio"}}'
                                                       name="questions[{{$key}}][option][{{$data->is_multi == 1 ? $keyOpt : $key }}]"
                                                       value="{{$option->id}}" id="option1" style="display: inline;">
                                                <label class="questionOption" style="display: inline;">{{$option->option}}</label>
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

                <button onclick="plusQuestion(1)" class="nextButton">
                    Next
                </button>
            </div>
                        
                
        </div>
    </div>



    <script>



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


    
    </script>
@endsection
