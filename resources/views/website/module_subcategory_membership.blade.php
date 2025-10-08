@extends('layouts.register')
@section('content')

    
    <div class="row container">
        <div class="col-4">&nbsp</div>
        <div class="col-4">
    
            <h3 class="centerText">If you have already paid, please provide your payment information and submit the form. Otherwise pay {{$batch_info->payable_amount}} taka via any of the following methods and submit this form</h3>
    
            <form action="{{url('/student/paidmember')}}" method="post" enctype="multipart/form-data" class="submitForm">
                @csrf
                
                <div class="marginAbove marginBelow">
                    <label>
                        <input type="radio" name="mar" value="bkash merchant"required/>Bkash Merchant 01673652555
                    </label> <br>
                    <label>
                        <input type="radio" name="mar" value="bkash personal"/>Bkash Personal  01638885050
                    </label> <br>
                    <label>
                        <input type="radio" name="mar" value="rocket"/>Rocket Personal 01673652555
                    </label> <br>
                    <label>
                        <input type="radio" name="mar" value="nagad"/>Nagad Personal 01673652555
                    </label> <br>
                    <label>
                        <input type="radio" name="mar" value="offline"/>Cash Payment (  at office )
                    </label> <br>
                </div>
                
    
                <div>
                    <label>Enter Amount</label>
                    
                        <input type="text" name="taka" placeholder="Taka" class="marginAbove marginBelow" required />
                    
                </div>
                <div>
                    <label>Transaction ID ( type OFFLINE for cash payment )</label>
                    <div>
                        <input type="hidden" name="batch_id"
                               value="{{$batch_info->id}}"/>
                        <input type="hidden" name="module_id"
                               value="{{$module_id}}"/>
                        <input type="hidden" name="subcategory_id"
                               value="{{$subcategory_id}}"/>
                        <input type="hidden" name="id" value="{{$student->id}}"/>
                        <input type="text" name="transaction"
                               value="{{old('transaction')}}" placeholder="Transaction ID" class="marginAbove" required/>
                        @if ($errors->has('transaction'))
                            <span role="alert">
                        <strong>{{ $errors->first('transaction') }}</strong>
                    </span>
                        @endif
                    </div>
                </div>
    
                <button type="submit" class="submitButton">
                    <h2>Submit</h2>
                </button>
            </form>
    
        </div>
    </div>

@endsection
