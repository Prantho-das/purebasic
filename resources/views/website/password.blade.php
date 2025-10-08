@extends('layouts.register')
@section('content')

 
    <div class="row container" style="margin-top:1rem;">
        
        <div class="col-3">&nbsp</div>
        
        <div class="col-6 submitForm">
 
            <div class="progress">
                <span style='font-size:1.5rem; color: #0066ff;'>Step 1</span>
                <span  style='font-size:3rem; color: #0066ff;'>&#x2192</span>
                <span style='font-size:1.5rem; color: #0066ff;'>Step 2</span>
                <span  style='font-size:3rem; color: #39393a;'>&#x2192</span>
                <span style='font-size:1.5rem; color: #39393a;'>Step 3</span>
            </div>
    
            <form method="post" action="{{url('student/password/verify/'.$student->id.'/'.$method)}}">
              @csrf
  
                <h3><label>Please enter your password and click Next..
</label></h3>
              
                  <input name="password" type="password" placeholder="" required/>
    
             
                <button type="submit" class="submitButton"><h3>Next</h3></button>
                
                <h3><label>Have you forgotten your password ?<a href="/student/reset_password" style="color:#0066ff;"> Reset your password</a></label></h3>
                
            </form>
      </div>
    </div>

@endsection