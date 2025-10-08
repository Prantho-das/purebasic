@extends('layouts.register')
@section('content')

      <!-- Section:about-->

    <div class="row helpContainer">
    
        <div class="col-4">&nbsp</div>
        
        <div class="col-4">
            
            <div class="centerText frequentQuestions"><a><b>Frequently asked questions</a></b></div>
            
            @foreach($tutorials as $tutorial)
         
                <div class="tutorial">
                 
                    <h2 class="centerText tutorialTitle">{{$tutorial->title}}</h2>
                    
                    <div class="plyr__video-embed">
                        
                        <iframe width="560" height="315"
                    src="{{$tutorial->details}}" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
                    
                    </div> 
                    
                
                   
                  
                  </div>  
          
        	@endforeach
        	
        </div>

                
        <div class="col-4">&nbsp</div>
    
    </div>

@endsection


@section('js')
    <script src="https://cdn.plyr.io/3.6.2/plyr.js"></script>
    <script>
        const players = Plyr.setup('.plyr__video-embed');
    </script>


@endsection