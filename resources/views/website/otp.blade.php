@extends('layouts.register')
@section('content')
    <section class="log-register-main no-before-after">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="login-reg-tabs">
                        <h3>We have sent an OTP to {{ $student->mobile }}; Please enter the OTP </h3>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="login-tab-pane" role="tabpanel"
                                aria-labelledby="login-tab" tabindex="0">
                                <form method="post"
                                id="otp-form"
                                    action="{{ url('student/otp/verify/' . $student->id . '/' . $is_login) }}">
                                @csrf
                                <div class="form-group otp-container">
                                    <input type="text" class="otp-input" maxlength="1" required>
                                    <input type="text" class="otp-input" maxlength="1" required>
                                    <input type="text" class="otp-input" maxlength="1" required>
                                    <input type="text" class="otp-input" maxlength="1" required>
                                </div>
                                <input type="hidden" id="otp-value" name="otp" value="">
                                <button type="button" class="btn btn-primary common-btn-design" id="otp-submit-btn">Submit
                                    OTP
                                    <span class="icon"><i class="fa-classic fa-regular fa-arrow-right"></i></span>
                                </button>

                                </form>
                                <div class="text-center">Time Remaining <label timer id='timer' class="timer"></label>
                                </div>
                                <div class="text-center">
                                    <a id="resend" href="{{ '/student/otp/' . $id . '/login' }}"
                                        class="forget-pass">Resend
                                        OTP</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    {{-- <div class="row container" style="margin-top:0.5rem;">

        <div class="col-3">&nbsp</div>

        <div class="col-6 submitForm">

            <div class="progress">
                <span style='font-size:1.5rem; color: #0066ff;'>Step 1</span>
                <span style='font-size:3rem; color: #0066ff;'>&#x2192</span>
                <span style='font-size:1.5rem; color: #0066ff;'>Step 2</span>
                <span style='font-size:3rem; color: #0066ff;'>&#x2192</span>
                <span style='font-size:1.5rem; color: #39393a;'>Step 3</span>
            </div>

            <div style="margin: 0.1rem;">&nbsp;</div>
            <h3 style="color: red;">WhatsApp <a style="color: green;"
                    href="https://api.whatsapp.com/send?phone=%2B8801673652555">+8801673652555 </a> if you do not receive
                otp..</h3>


            <div id="otpSection">

                <form method="post" action="{{ url('student/otp/verify/' . $student->id . '/' . $is_login) }}">
                    @csrf

                    <h3><label>We have sent an OTP to {{ $student->mobile }}; Please enter the OTP and click Next..</label>
                    </h3>
                    <h3></h3>

                    <input name="otp" type="text" placeholder="OTP" required
                        value="{{ $otpRequired == 0 ? $otp : '' }}">
                    @if ($errors->has('otp'))
                        <span role="alert">
                            <strong>{{ $errors->first('otp') }}</strong>
                        </span>
                    @endif


                    @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            Wrong OTP Please Enter Valid OTP
                        </div>
                    @endif

                    <button type="submit" class="submitButton">
                        <h3>Next</h3>
                    </button>

                </form>
            </div>

        </div>
    </div> --}}

    <script>
        var timeoutHandle;

        function countdown(minutes, seconds) {

            document.getElementById("resend").style.display = "none";

            function tick() {
                var counter = document.getElementById("timer");
                counter.innerText =
                    minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
                seconds--;
                if (seconds > 0) {
                    timeoutHandle = setTimeout(tick, 1000);
                } else if (seconds == 0) {
                    document.getElementById("otpSection").style.display = "none";
                    document.getElementById("resend").style.display = "unset";
                } else {
                    if (minutes >= 1) {
                        setTimeout(function() {
                            countdown(minutes - 1, 59);
                        }, 1000);
                    }
                }
            }
            tick();

        }

        countdown(2, 00);


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


        document.getElementById('otp-submit-btn').addEventListener('click', () => {
            let otpValue = '';
            otpInputs.forEach(input => {
                otpValue += input.value;
            });
            document.getElementById('otp-value').value = otpValue;

            // Submit the form
            const form = document.querySelector('#otp-form');
            form.submit();
        });


        
    </script>
@endsection
