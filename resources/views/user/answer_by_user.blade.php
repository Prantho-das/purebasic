@extends('layouts.register')
@section('content')

    @php
        $userId = Session::get('id');
    @endphp
    
    <div style="margin-top: 3rem; margin-bottom: 5rem;">
            
        <div class="row">
            
            <div class="col-4">&nbsp</div>
    
            <div class="col-4" >
 

            @foreach($all as $question)
            
                <div style="margin: 1rem; padding: 0.5rem; border-radius: 0.3rem;" class="oldNotice">
                    <p><b>Question : {{$question->question}}</b></p>
                    <p><b>Answer: {{$question->answer}}</b></p>
                    
                @if ($profile_type == "mentor")
                    <a style="margin: 0.9rem 0.3rem;" class="loginButton" href="/mentor/{{$userId}}/question/{{$question->id}}/answer">Edit this answer</a>

                @endif
                <p></p>
                </div>
                    

            @endforeach
            
            </div>
        </div>
    </div>

@endsection