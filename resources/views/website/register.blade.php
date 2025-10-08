@extends('layouts.register')
@section('content')

    <div class="w3-row">
        <div class="w3-quarter">&nbsp</div>
        <div class="w3-half">
            <div class="w3-card-4 w3-margin">
                <form class="w3-container" id="registration" action="{{url('/student/register/submit')}}"
                      method="post" enctype="multipart/form-data">
                    @csrf
                    <h2>
                        Register Account
                    </h2>
                    <div class="w3-section">
                        <label><b>Name<b></label>
                        <input type="text" class="w3-input w3-border" name="name" value="{{old('name')}}"
                               placeholder="Name as per NID" required>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                            <strong class="w3-red">{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="w3-section">
                        <label><b>E-Mail<b></label>
                        <div>
                            <input type="email" class="w3-input w3-border" name="email"
                                   value="{{old('email')}}" placeholder="Valid Email Address" required>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                <strong class="w3-red">{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
    
    
                    <div class="w3-section">
                        <label><b>Phone Number<b></label>
                        <div>
                            <input name="mobile" data-parsley-type="number" maxlength="15" minlength="9"
                                   value="{{old('mobile')}}" type="text" class="w3-input w3-border"
                                   placeholder="Valid Phone Number" minlength="9" maxlength="15" required>
                            @if ($errors->has('mobile'))
                                <span class="invalid-feedback" role="alert">
                                <strong class="w3-red">{{ $errors->first('mobile') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
    
    
    				<div class="w3-section">
                        <label><b>Country<b></label>
                        <div>
    						<select name="country" class="w3-select">
    						  <option value="Bangladesh" >Bangladesh</option>
    						  <option value="Other">Other Country</option>
    						</select>
                            @if ($errors->has('country'))
                                <span class="invalid-feedback" role="alert">
                                <strong class="w3-red">{{ $errors->first('country') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
    
    
                    <div class="w3-section">
                        <label><b>Choose a password<b></label>
                        <div>
                            <input type="password" name="password" class="w3-input w3-border"
                                   value="{{old('password')}}" placeholder="Password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                <strong class="w3-red">{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="w3-section">
                            <input type="password" class="w3-input w3-border" name="password_confirmation"
                                   placeholder="Re-Type Password" required>
                        </div>
                    </div>
    
                    <div class="w3-section">
                        <button type="submit" class="w3-btn w3-black">
                            Register
                        </button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#datepicker").datepicker();
        });
    </script>


@endsection
