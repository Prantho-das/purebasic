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
                                    action="{{ url('student/otp/verify/' . $student->id . '/' . $is_login) }}">
                                </form>
                                <div class="form-group otp-container">
                                    <input type="text" class="otp-input" maxlength="1" required>
                                    <input type="text" class="otp-input" maxlength="1" required>
                                    <input type="text" class="otp-input" maxlength="1" required>
                                    <input type="text" class="otp-input" maxlength="1" required>
                                    <input type="text" class="otp-input" maxlength="1" required>
                                    <input type="text" class="otp-input" maxlength="1" required>
                                </div>
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


    <div class="row container" style="margin-top:0.5rem;">

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
    </div>

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
    </script>
@endsection
