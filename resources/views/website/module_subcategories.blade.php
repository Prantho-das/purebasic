@extends('layouts.register')
@section('content')

    <div class="container" id="chaptersContainer">

    @php $i=0; @endphp
        @foreach($chapters as $sub_chapters)

            @foreach($sub_chapters as $key=>$chapter)
            
           
                <div class="row chapterContainer" id="{{$key + 1}}">

                    <div class="col-4">&nbsp</div>
                    
                    <div class="col-4 marginAbove round chapter">

                        
                        
                        <div class="centerText">
                        

                        
                            <p>{{$subject_info->name}}</p>
                            <p><b>{{$chapter->name}}</b></p>

                            
                            <p><a href="{{url('/student/batch/' . $batch_id . '/module/' . $module_id . '/subcategory/' . $chapter->id . '/enroll')}}" class="buyLink">Buy Now</a></p>
                        
                        </div>
                    </div>
                    <div class="col-4">&nbsp</div>
                
                </div>
    
            @php $i++; @endphp
            @endforeach
    
            @endforeach

    <script>

        var chaptersContainer = document.getElementById( 'chaptersContainer' );
        
        [].map.call( chaptersContainer.children, Object ).sort( function ( a, b ) {
            return +a.id.match( /\d+/ ) - +b.id.match( /\d+/ );
        }).forEach( function ( elem ) { 
            chaptersContainer.appendChild( elem );
        });
    
    </script>

@endsection
