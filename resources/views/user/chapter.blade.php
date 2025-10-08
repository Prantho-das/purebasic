@extends('layouts.register')
@section('content')

    <div class="container" id="chaptersContainer">

    @php $i=0; @endphp
        @foreach($chapters as $sub_chapters)

            @foreach($sub_chapters as $key=>$chapter)
            
                @php
                    $chapterName = $chapter->name;
                    $serial = $key;
                    
                    if (substr($chapterName,0,4) == "Week" && $startsFrom != "null") {
                    
                        $from = (int) $startsFrom;
                        
                        $weekNumber = (int) substr($chapterName,5);
                        
                        if ($weekNumber >= $from) {
                            $weekNumber  = ($weekNumber + 1 - $from);
                        
                        } else {
                        
                            $weekNumber = (21 + $weekNumber - $from);                                    
                        }
                        
                        $chapterName = "Week " . $weekNumber;
                        $serial = $weekNumber;

                    }
                @endphp
           
                <div class="row chapterContainer" id="{{$startsFrom != 'null' ? $serial : $key + 1}}">

                    <div class="col-4">&nbsp</div>
                    
                    <div class="col-4 marginAbove round chapter">

                        @if ($chapter->literature)
                            <div style="float:right; margin-top: 0.5rem;"><a href="{{$chapter->literature}}" class="literatureLink">Literature</a></div>
                            <div>&nbsp</div>
                        @endif   
                        
                        
                        <div class="centerText">
                        

                        
                            <p>Subject : </span><a href="/batch/{{$batch_id . '/' . 'subjects'}}">{{$subject_info->name}}</a></p>
                            
                            <p><a href="{{route('chapter_classes',['batch_id'=>$batch_id,'subject_id'=>$subject_id,'chapter_id'=>$chapter->id])}}" class="linkButton">{{$chapterName}}</a></p>
                        
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
