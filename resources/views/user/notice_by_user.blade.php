@extends('layouts.register')
@section('content')
    <div style="margin-top: 3rem; margin-bottom: 5rem;">
            
    
        <div class="row">
            
            <div class="col-4">&nbsp</div>
    
            <div class="col-4" >
                
            @foreach($all as $notice)
            
                <div style="margin: 1rem; padding: 0.5rem; border-radius: 0.3rem;" class="{{in_array($notice->id, $read) ? 'oldNotice' : 'newNotice'}}">
                    <p>{{date('d F Y, h:i A', strtotime($notice->updated_at))}}</p>
                    <p><b>{{$notice->batch_name}}</b></p>
                    <b>{{$notice->notice}}</b>
                <div style="margin: 1rem;"><a class="loginButton" href="/notice/{{$notice->id}}">Check Now</a></div>
                </div>
                    

            @endforeach
            
            </div>
        </div>
    </div>

@endsection

