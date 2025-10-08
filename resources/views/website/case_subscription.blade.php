@extends('layouts.register')
@section('content')

    
    <div class="row container">
        <div class="col-4">&nbsp</div>
        <div class="col-4">
    
            <form action="{{url('bkash-create')}}" method="post" enctype="multipart/form-data" class="submitForm">
                @csrf
                

                <div class="marginAbove marginBelow">
                    <h3>Please Pay {{$clinical_case->price}} Taka To Watch This Case</h3>


                        <input type="hidden" name="payerReference" value="{{$userId . '_caseId_' . $clinical_case->id . '_' . $clinical_case->price}}" required>

                            
                            

                </div>
                

    

    
                <button type="submit" class="submitButton">
                    <h3>Pay Now</h3>
                </button>
            </form>
    
        </div>
    </div>

@endsection
