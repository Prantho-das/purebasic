@extends('layouts.register')
@section('content')

    <div class="container">
    
            <div class="row" style="margin-top:3rem;">
                
                <div class="col-4">&nbsp</div>

                <div class="col-4">
                    
                    @if($profile["id"])
                        ID : {{$profile["id"]}}<br>
                    @endif
                    
                    @if($profile["name"])
                        Name : {{$profile["name"]}}<br>
                    @endif
                    
                    @if($profile["mobile"])
                        Mobile : {{$profile["mobile"]}}<br>
                    @endif
                    
                    @if($profile["email"])
                        Email : {{$profile["email"]}}<br>
                    @endif
                    
                    @if($profile["country"])
                        Country : {{$profile["country"]}}<br>
                    @endif
                    
                    @if($profile["address"])
                        Address : {{$profile["address"]}}<br>
                    @endif
                    
                    @if($profile["position"])
                        Title : {{$profile["position"]}}<br>
                    @endif
                    
                    @if($profile["qualification"])
                        Degree : {{$profile["qualification"]}}<br>
                    @endif
                    
                    @if($profile["BMDC"])
                        BMDC registration :  : {{$profile["BMDC"]}}<br>
                    @endif
                    
                    <div style="margin-top: 1rem;"><a class ="loginButton" href="/student/logout"><b>লগআউট</b></a></div>    

                </div>
                
                
                <div class="col-4">&nbsp</div>


            <div>


    </div>
    


</script>
                

@endsection

