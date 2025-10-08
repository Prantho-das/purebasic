@extends('layouts.register')
@section('content')

    <div class="row container" style="margin-top:1rem;">
            
        <div class="col-3">&nbsp</div>
        
        <div class="col-6 submitForm">


            <form action="{{'/mentor/' . Session::get('id'). '/question/' . $question_id . '/answer'}}" method="post">
                @csrf
                
            @foreach($questionDetails as $question)
            
                <h3><label>Question : {{$question->question}}</label></h3>
                
                <h3><label>Write your answer here and click the submit button</label></h3>
                <textarea name="answer" placeholder="Write your answer.." style="width: 100%; height: 10rem;" required>{{$question->answer}}</textarea>
           
                <p></p>
                <button type="submit" class="submitButton">
                    <h3>submit</h3>
                </button>

            @endforeach
                
                
            </form>
        </div>
        
    </div>


@endsection