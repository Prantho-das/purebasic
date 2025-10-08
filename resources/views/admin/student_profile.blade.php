@extends('layouts.register')
@section('content')


    <div class="container">
    
            <div class="row" style="margin-top:3rem;">
                
                <div class="col-4">&nbsp</div>

                <div class="col-4">
                    
                    <form action="{{url('/admin/updateProfile/user/' . $profile["id"])}}" method="post">
                        @csrf
                    
                        <div>
                            <label for="id" >ID : {{$profile["id"]}}</label>
                        </div>
                        
                        <div>
                            <label for="name">Name : </label>
                            <input name="name" type="text" value="{{$profile["name"] ? $profile["name"] : ''}}">
                        </div>
                        
                        <div>
                            <label for="mobile">Mobile : </label>
                            <input name="mobile" type="text" value="{{$profile["mobile"] ? $profile["mobile"] : ''}}">                   
                        </div>
                        
                        <div>
                            <label for="email">Email : </label>
                            <input name="email" type="text" value="{{$profile["email"] ? $profile["email"] : ''}}">  
                        </div>
                    
                        <div>
                            <label for="address">Address : </label>
                            <input name="address" type="text" value="{{$profile["address"] ? $profile["address"] : ''}}">
                        </div>
                        
                        <div>
                            <label for="password">password : </label>
                            <input name="password" type="text" placeholder="Change Password"">                    
                        </div>
                        
                        <button type="submit" class="submitButton">
                            <h3>Update</h3>
                        </button>
                        
                    </form>
                    

                </div>
                
                
                <div class="col-4">&nbsp</div>


            <div>


    </div>
    


</script>
                

@endsection

