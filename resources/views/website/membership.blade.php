@extends('layouts.register')
@section('content')

    
    <div class="row container">
        <div class="col-4">&nbsp</div>
        <div class="col-4">
    
            <form action="{{url('bkash-create')}}" method="post" enctype="multipart/form-data" class="submitForm">
                @csrf
                

                <div class="marginAbove marginBelow">
                    <h3>{{$batch_info->plan}}</h3>
                    <h3>Choose suitable package and pay</h3>

                        @foreach($selectBatchDuration as $item)
                            <h3>
                                <label>
                                    <input type="radio" name="payerReference" value="{{$userId . '_bdId_' . $item->bd_id . '_' . $item->bd_fee}}" required>Duration: {{$item->bd_duration}} Days - Fees: {{$item->bd_fee}} Taka {{$item->information ? $item->information : ''}}
                                </label>
    
    
                            </h3>
                        @endforeach
                        
                </div>
                

    

    
                <button type="submit" class="submitButton">
                    <h3>Pay Now</h3>
                </button>
            </form>
    
        </div>
    </div>

@endsection
