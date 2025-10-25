@extends('layouts.register')
@section('content')
    <section class="log-register-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="login-reg-tabs">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="login-tab" data-bs-toggle="tab"
                                    data-bs-target="#login-tab-pane" type="button" role="tab"
                                    aria-controls="login-tab-pane" aria-selected="true">Login</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="register-tab" data-bs-toggle="tab"
                                    data-bs-target="#register-tab-pane" type="button" role="tab"
                                    aria-controls="register-tab-pane" aria-selected="false">Registration</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="login-tab-pane" role="tabpanel"
                                aria-labelledby="login-tab" tabindex="0">
                                <form id="login-form" action="{{ url('/student/login/submit') }}" method="get">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter Your Mobile Number"
                                            id="mobile" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Enter Your Password"
                                            id="password" required>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                                        <label class="form-check-label" for="checkDefault">
                                            Keep me logged in
                                        </label>
                                    </div>
                                    <button type="button" class="btn btn-primary common-btn-design" id="login-btn">
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
                            <div class="tab-pane fade" id="register-tab-pane" role="tabpanel" aria-labelledby="register-tab"
                                tabindex="0">
                                <form id="registration" action="{{ url('/student/register/submit') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name') }}" placeholder="Name as per NID" required>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="w3-red">{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email"
                                            value="{{ old('email') }}" placeholder="Valid Email Address" required>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="w3-red">{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <input name="mobile" data-parsley-type="number" maxlength="15" minlength="9"
                                            value="{{ old('mobile') }}" type="text" class="form-control"
                                            placeholder="Valid Phone Number" minlength="9" maxlength="15" required>
                                        @if ($errors->has('mobile'))
                                            <span class="invalid-feedback" role="alert">
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
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="w3-red">{{ $errors->first('country') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control"
                                            value="{{ old('password') }}" placeholder="Password" required>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="w3-red">{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password_confirmation"
                                            placeholder="Re-Type Password" required>
                                    </div>
                                    <button type="button" class="btn btn-primary common-btn-design"
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
        document.getElementById('login-btn').addEventListener('click', function() {
            const mobile = document.getElementById('mobile').value;
            const password = document.getElementById('password').value;

            // Basic validation
            if (mobile && password) {
                // Hide login form, show OTP form
                document.getElementById('login-form').style.display = 'none';
                document.getElementById('otp-form').style.display = 'block';
                // Focus on the first OTP input
                document.querySelector('.otp-input').focus();
            } else {
                alert('Please enter both mobile number and password.');
            }
        });

        // OTP input handling
        const otpInputs = document.querySelectorAll('.otp-input');
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                // Allow only digits
                if (e.target.value.length > 0 && !/^\d$/.test(e.target.value)) {
                    e.target.value = '';
                    return;
                }
                // Move to next input if a digit is entered
                if (e.target.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                // Move to previous input on backspace if empty
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });

            // Allow pasting OTP
            input.addEventListener('paste', (e) => {
                e.preventDefault();
                const pasteData = e.clipboardData.getData('text').replace(/\D/g, ''); // Only digits
                if (pasteData.length <= otpInputs.length) {
                    for (let i = 0; i < pasteData.length && i < otpInputs.length; i++) {
                        otpInputs[i].value = pasteData[i];
                        if (i < otpInputs.length - 1) {
                            otpInputs[i + 1].focus();
                        }
                    }
                }
            });
        });

        // OTP submit button event listener
        document.getElementById('otp-submit-btn').addEventListener('click', function() {
            // Collect OTP
            let otp = '';
            otpInputs.forEach(input => otp += input.value);

            // Basic OTP validation (6 digits)
            if (otp.length === 6 && /^\d{6}$/.test(otp)) {
                // alert('OTP submitted: ' + otp);
                // Perform further actions (e.g., send OTP to server)
                // Reset forms
                document.getElementById('otp-form').style.display = 'none';
                document.getElementById('login-form').style.display = 'block';
                document.getElementById('login-form').reset();
                document.getElementById('otp-form').reset();
            } else {
                alert('Please enter a valid 6-digit OTP.');
            }
        });
    </script>
@endsection
