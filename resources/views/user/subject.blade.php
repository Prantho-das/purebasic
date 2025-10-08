@extends('layouts.register')
@section('content')

    <div class="container">
        @php $i=0; @endphp
        @foreach($categories as $subjects)

           @foreach($subjects as $key=>$subject)
                <div class="row subjectsContainer">
                    <div class="col-4">&nbsp</div>
                    
                    <div class="col-4 marginAbove round centerText subjects">
                
                        <a href="{{route('subject_chapters',['batch_id'=>$batch_id,'subject_id'=>$subject->id])}}"class="linkButton">{{$subject->name}}</a>
                            </a>
                        
                    </div>
                    
                
                </div>


                @php $i++; @endphp
            @endforeach

        @endforeach
    </div>

@endsection
