@extends('layouts.register')
@section('content')

    @php
        $userId = Session::get('id');
    @endphp
    
    <div style="margin-top: 3rem; margin-bottom: 5rem;">
            
        <div class="row">
            
            <div class="col-4">&nbsp</div>
    
            <div class="col-4" >
 
         <div style="margin: 1rem;"><a class="loginButton" href="/ask/user/{{Session::get('id')}}">Ask a question</a></div>
         

            @foreach($user_asked as $question)
            
                <div style="margin: 1rem; padding: 0.5rem; border-radius: 0.3rem;" class="oldNotice">
                    <p>You Asked on {{date('d F Y, h:i A', strtotime($question->updated_at))}}</p>
                    <b>Question : {{$question->question}}</b>
                    <p></p>
                    
                @if ($question->answer)    
                    <a style="margin: 0.9rem 0.3rem;" class="loginButton" href="/user/{{$userId}}/question/{{$question->id}}/answer">See Answer</a>
                    
                @endif
                
                @if ($profile_type == "mentor")    
                    <a style="margin: 0.9rem 0.3rem;" class="loginButton" href="/mentor/{{$userId}}/question/{{$question->id}}/answer">Answer this question</a>
                    
                @endif
                    
                @if ($question->user_id == $userId)
                    <a style="margin: 0.9rem 0.3rem;" class="loginButton" href="/user/{{$userId}}/question/{{$question->id}}/edit">Edit</a>
                    <a style="margin: 0.9rem 0.3rem;" class="loginButton" href="/user/{{$userId}}/question/{{$question->id}}/delete">Delete</a>

                @endif
                <p></p>
                </div>
                    

            @endforeach
               
            @foreach($other_asked as $question)
            
                <div style="margin: 1rem; padding: 0.5rem; border-radius: 0.3rem;" class="oldNotice">
                    <p>Someone Asked on {{date('d F Y, h:i A', strtotime($question->updated_at))}}</p>
                    <b>Question : {{$question->question}}</b>
                    <p></p>
                    
                @if ($question->answer)    
                    <a style="margin: 0.9rem 0.3rem;" class="loginButton" href="/user/{{$userId}}/question/{{$question->id}}/answer">See Answer</a>
                    
                @endif
                
                @if ($profile_type == "mentor")    
                    <a style="margin: 0.9rem 0.3rem;" class="loginButton" href="/mentor/{{$userId}}/question/{{$question->id}}/answer">Answer this question</a>
                    
                @endif
                    
                <p></p>
                </div>
                    

            @endforeach
            
            </div>
        </div>
    </div>

@endsection

