@extends('layouts.register')
@section('content')
    <section class="log-register-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="login-reg-tabs">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ request()->filled('registration')?'':'active' }}" id="login-tab" data-bs-toggle="tab"
                                    data-bs-target="#login-tab-pane" type="button" role="tab"
                                    aria-controls="login-tab-pane" aria-selected="{{ request()->filled('registration')?'false':'true' }}">Login</button>
                            </li>
                            <li class="nav-item " role="presentation">
                                <button class="nav-link {{ request()->filled('registration')?'active':'' }}" id="register-tab" data-bs-toggle="tab"
                                    data-bs-target="#register-tab-pane" type="button" role="tab"
                                    aria-controls="register-tab-pane" aria-selected="{{request()->filled('registration')?'true':'false' }}}}">Registration</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade {{request()->filled('registration')?'':'active show' }}" id="login-tab-pane" role="tabpanel"
                                aria-labelledby="login-tab" tabindex="0">
                                <form id="login-form" action="{{ route('student.login.submit') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter Your Mobile Number"
                                          name="email"  id="mobile" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Enter Your Password"
                                          name="password"  id="password" required>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                                        <label class="form-check-label" for="checkDefault">
                                            Keep me logged in
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary common-btn-design" id="login-btn">
                                        Send OTP
                                        <span class="icon"><i class="fa-classic fa-regular fa-arrow-right"></i></span>
                                    </button>
                                    <div class="w-100 text-center"><a class="forget-pass">Forgot your password?</a></div>
                                </form>
                                <form id="otp-form" style="display: none;">
                                    <div class="form-group otp-container">
                                        <input type="text" class="otp-input" maxlength="1" required>
                                        <input type="text" class="otp-input" maxlength="1" required>
                                        <input type="text" class="otp-input" maxlength="1" required>
                                        <input type="text" class="otp-input" maxlength="1" required>
                                        <input type="text" class="otp-input" maxlength="1" required>
                                        <input type="text" class="otp-input" maxlength="1" required>
                                    </div>
                                    <button type="button" class="btn btn-primary common-btn-design"
                                        id="otp-submit-btn">Submit OTP
                                        <span class="icon"><i class="fa-classic fa-regular fa-arrow-right"></i></span>
                                    </button>

                                </form>
                            </div>
                            <div class="tab-pane fade {{request()->filled('registration')?'active show':'' }}" id="register-tab-pane" role="tabpanel" aria-labelledby="register-tab"
                                tabindex="0">
                                <form id="registration" action="{{ url('/student/register/submit') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name') }}" placeholder="Name as per NID" required>
                                        @if ($errors->has('name'))
                                            <span class="d-block invalid-feedback" role="alert">
                                                <strong class="w3-red">{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email"
                                            value="{{ old('email') }}" placeholder="Valid Email Address" required>
                                        @if ($errors->has('email'))
                                            <span class="d-block invalid-feedback" role="alert">
                                                <strong class="w3-red">{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <input name="mobile" data-parsley-type="number" maxlength="15" minlength="9"
                                            value="{{ old('mobile') }}" type="text" class="form-control"
                                            placeholder="Valid Phone Number" minlength="9" maxlength="15" required>
                                        @if ($errors->has('mobile'))
                                            <span class="d-block invalid-feedback" role="alert">
                                                <strong class="w3-red">{{ $errors->first('mobile') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <select name="country" class="form-control">
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Other">Other Country</option>
                                        </select>
                                        @if ($errors->has('country'))
                                            <span class="d-block invalid-feedback" role="alert">
                                                <strong class="w3-red">{{ $errors->first('country') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control"
                                            value="{{ old('password') }}" placeholder="Password" required>
                                        @if ($errors->has('password'))
                                            <span class="d-block invalid-feedback" role="alert">
                                                <strong class="w3-red">{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password_confirmation"
                                            placeholder="Re-Type Password" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary common-btn-design"
                                        id="register-btn">register Now
                                        <span class="icon"><i class="fa-classic fa-regular fa-arrow-right"></i></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>


    <script>
        // Login button event listener
       

        // OTP input handling
        

        
    </script>
@endsection
