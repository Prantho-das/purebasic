@extends('layouts.admin')
@section('content')


    <div class="container">
    
            <div class="row" style="margin: 3rem 1rem;">
                

                <div>
                    
                    <form action="{{url('/admin/updateInformation/user/' . $studentId . '/batch/' . $batchId . '/batchSubscription/' . $enrollId)}}" method="post">
                        @csrf

                        <div>
                            <label>Pure Basic ID : {{$profile["id"]}}</label>
                        </div>
                        
                        <div>
                            <label>Name : {{$profile["name"] ? $profile["name"] : ''}}</label>
                        </div>
                        
                        <div>
                            <label>Mobile Number : {{$profile["mobile"] ? $profile["mobile"] : ''}}</label>
                        </div>
                        
                        <div>
                            <label>Email : {{$profile["email"] ? $profile["email"] : ''}}</label>
                        </div>
                    
                        <div>
                            <label>Address : {{$profile["address"] ? $profile["address"] : ''}}</label>
                        </div>
                        <div>
                            <label>Enrolled Batch : <b>{{$batchInfo ? $batchInfo : ''}}</b></label>
                        </div>                        
                        <div>
                            <label for="information">Current Information : {{$enrollInfo ? $enrollInfo : ''}}</label>
                        </div>
                        
                        <div>
                            <input name="information" type="text" value="{{$enrollInfo ? $enrollInfo : ''}}">
                        </div>
                        
                        <button type="submit" class="btn btn-danger" style="margin: 1rem 0rem;">
                            Update Information
                        </button>
                        
                    </form>
                    
                    
                    <div>
                        <a class="btn btn-info" href="{{'/admin/batch_student/' . $batchId . '/enrolled'}}" style="margin: 1rem 0rem;"> Go Back To Enrolled List</a>
                    </div>
                    
                </div>
                
                


            <div>


    </div>
    


</script>
                

@endsection

