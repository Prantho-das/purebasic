@extends('layouts.register')
@section('content')

    <div class="container">
        
        @php $key=($exams_raw->perPage() * ($exams_raw->currentPage()-1))+1; @endphp
        @foreach($exams_raw as $exam)
        
            <div class="row caseContainer marginBelow">
                
                <div class="col-4">&nbsp</div>

                <div class="col-4 marginAbove round case">
                    <p><b>{{$exam->name}}</b></p>
                    <a href="{{url('/clinical_case/question/'.$exam->id)}}" class="detailsButton">Details</a>
                    
                </div>
            </div>
        @endforeach
                    
    </div>

@endsection
