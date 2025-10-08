@extends('layouts.register')
@section('content')

    <div class="row container">
        <div class="col-4">&nbsp</div>
        <div class="col-4">
            <form action="{{route('admissionform.save')}}" method="post" enctype="multipart/form-data" class="submitForm">
                @csrf
        
                @if (is_null($student_info->name))
                    <div>
                        <label>Name</label>
                        <input class="marginAbove marginBelow" type="text" name="name" placeholder="Name" required />
                    </div>
                @endif
        
                @if (is_null($student_info->mobile))
                    <div>
                        <label>Phone Number</label>
                        <input class="marginAbove marginBelow" type="number" name="phone_number" placeholder="Phone Number" required />
                    </div>
                @endif

                @if (is_null($student_info->email))        
                    <div>
                        <label>E-mail</label>
                        <input class="marginAbove marginBelow" type="email" name="email" placeholder="E-mail" required />
                    </div>
                @endif
                
                <!--div class="form-group">
                    <label for="nf-email" class=" form-control-label">BMDC</label>
                    <input type="text" name="bmdc" class="form-control" placeholder="BMDC">
                </div>
        
                <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Session</label>
                    <input type="text" name="pb_session" class="form-control" required placeholder="Session">
                </div>
        
                <div class="form-group" id="College">
                    <label for="nf-email" class=" form-control-label">Select College</label>
                    <select class="form-control" name="college" id="college" required>
                        <option value="select_lecture">Select College</option>
                        <option value="Medical College">Medical College</option>
                        <option value="Dental College">Dental College</option>
                    </select>
                </div-->
        
                <div>
                    <label>Address</label>
                    <input class="marginAbove marginBelow" type="text" name="address" placeholder="Address" required />
                </div>
                
                
                @if (empty($student_info->password))        
                    <div>
                        <label>Choose a password</label>
                        <input class="marginAbove marginBelow" type="password" name="password" placeholder="Password" required />
                    </div>
                    
                    <div>
                        <label>Retype Password</label>
                        <input class="marginAbove marginBelow" type="password" name="confirmation" placeholder="Retype Password" required />
                    </div
                    
                @endif
                
                
        
                <input type="text" name="enrolled_batch" value="{{session()->get('batchId')}}" required hidden />
                <input type="text" name="payment_method" value="{{session()->get('mar')}}" required hidden />
                <input type="text" name="transaction_id" value="{{session()->get('transactionId')}}" required hidden />
                <input type="text" name="pb_id" value="{{session()->get('studentId')}}" required hidden />
                <input type="text" name="batch_id" value="{{session()->get('batchId')}}" required hidden />
                <input type="text" name="sub_id" value="{{session()->get('subId')}}" required hidden />
        
                <button type="submit" class="submitButton">
                    <h2>Submit</h2>
                </button>
            </form>
        </div>
    </div>


@endsection
