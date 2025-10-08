@extends('layouts.register')
@section('content')

    <div class="row container" style="margin-top:1rem;">
            
        <div class="col-3">&nbsp</div>
        
        <div class="col-6 submitForm">


            <form action="{{'/ask/user/' . Session::get('id')}}" method="post">
                @csrf
                
                 <h3><label>ONLY ASK A QUESTION IF YOU DO NOT UNDERSTAND A PARTICULAR CONCEPT. WE HIDE YOUR ID FOR BETTER PRIVACY.</label></h3>
                <h3><label>Write your question here and click the submit button</label></h3>
                <textarea name="question" placeholder="Write your question.." style="width: 100%; height: 10rem;" required></textarea>
           
                <p></p>
                <button type="submit" class="submitButton">
                    <h3>submit</h3>
                </button>

                
                
            </form>
        </div>
        
    </div>


@endsection



