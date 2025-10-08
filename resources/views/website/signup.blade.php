@extends('layouts.website')
@section('content')
<!-- Post Section Start -->
<div class="post-section section pt-30">
    @if(session()->has('error'))
            <script>
               swal({
                 title: "opps!",
                 text: "Email & Password Not Match",
                 icon: "error",
                 });
            </script>
            @endif
            <div class="form-section">
               <div class="container fixed-width">
                  <div class="row">
                  <div class="col-md-3"></div>
                     <div class="col-md-6 offset-lg-2 login_form">
                        <div class="header_login text-center">
                           <h2>Sign Up</h2>
                           <span>Sign in with your social media account</span>
                        </div>
                        <div class="social-btn text-center">
                           <a href="#" class="btn btn-primary btn-lg" title="Facebook"><i class="fa fa-facebook"></i></a>
                           <a href="#" class="btn btn-info btn-lg" title="Twitter"><i class="fa fa-twitter"></i></a>
                           <a href="#" class="btn btn-danger btn-lg" title="Google"><i class="fa fa-google"></i></a>

                           <p>Or</p>
                        </div>
                        <div class="login-form bg-white p-5 mt-50">
                           <form method="post" action="{{url('user/register/store')}}" enctype="multipart/form-data">
                              @csrf
                              <div id="account_details">
                                 <div class="post-comment-form row mb-15">
                                    <div class="col-md-1 col-sm-1 col-m1{{ $errors->has('name') ? ' is-invalid' : '' }}">
                                       <div class="inline-left">
                                          <label for="name"><i class="fa fa-user"></i></label>
                                       </div>
                                    </div>
                                    <div class="col-md-11 col-sm-11 col-m11">
                                       <input type="text" name="name" id="name" placeholder="Name" value="{{old('name')}}"> @if ($errors->has('name'))
                                       <span class="invalid-feedback" role="alert" style="display: initial;">
                                       <strong>{{ $errors->first('name') }}</strong>
                                       </span> 
                                       @endif
                                    </div>
                                 </div>
                                 <div class="post-comment-form row mb-15">
                                    <div class="col-md-1 col-sm-1 col-m1{{ $errors->has('email') ? ' is-invalid' : '' }}">
                                       <div class="inline-left">
                                          <label for="email"><i class="fa fa-envelope" aria-hidden="true"></i></label>
                                       </div>
                                    </div>
                                    <div class="col-md-11 col-sm-11 col-m11">
                                       <input type="email" name="email" id="email" placeholder="Email Address" value="{{old('email')}}"> @if ($errors->has('email'))
                                       <span class="invalid-feedback" role="alert" style="display: initial;">
                                       <strong>{{ $errors->first('email') }}</strong>
                                       </span> @endif
                                    </div>
                                 </div>


                                 <div class="post-comment-form row mb-15">
                                    <div class="col-md-1 col-sm-1 col-m1{{ $errors->has('phone') ? ' is-invalid' : '' }}">
                                       <div class="inline-left">
                                          <label for="email"><i class="fa fa-phone" aria-hidden="true"></i></label>
                                       </div>
                                    </div>
                                    <div class="col-md-11 col-sm-11 col-m11">
                                       <input type="number" name="phone" id="email" placeholder="Phone Number" value="{{old('phone')}}"> @if ($errors->has('phone'))
                                       <span class="invalid-feedback" role="alert" style="display: initial;">
                                       <strong>{{ $errors->first('phone') }}</strong>
                                       </span> @endif
                                    </div>
                                 </div>

                                  <div class="post-comment-form row mb-15">
                                    <div class="col-md-1 col-sm-1 col-m1{{ $errors->has('city') ? ' is-invalid' : '' }}">
                                       <div class="inline-left">
                                          <label for="email"><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                                       </div>
                                    </div>
                                    <div class="col-md-11 col-sm-11 col-m11">
                                       <input type="text" name="city" id="email" placeholder="Current Address" value="{{old('city')}}"> @if ($errors->has('city'))
                                       <span class="invalid-feedback" role="alert" style="display: initial;">
                                       <strong>{{ $errors->first('city') }}</strong>
                                       </span> @endif
                                    </div>
                                 </div>



                                 <div class="post-comment-form row mb-15">
                                    <div class="col-md-1 col-sm-1 col-m1{{ $errors->has('password') ? ' is-invalid' : '' }}">
                                       <div class="inline-left">
                                          <label for="pswd"><i class="fa fa-unlock-alt" aria-hidden="true"></i></label>
                                       </div>
                                    </div>
                                    <div class="col-md-11 col-sm-11 col-m11">
                                       <input id="password-field" type="password" name="password" id="pswd" placeholder="Password">
                                       <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                       @if ($errors->has('password'))
                                       <span class="invalid-feedback" role="alert" style="display: initial;">
                                       <strong>{{ $errors->first('password') }}</strong>
                                       </span> @endif
                                    </div>
                                 </div>
                                 <div class="post-comment-form row mb-15">
                                    <div class="col-md-1 col-sm-1 col-m1">
                                       <div class="inline-left">
                                          <label for="pswd1"><i class="fa fa-lock" aria-hidden="true"></i></label>
                                       </div>
                                    </div>
                                    <div class="col-md-11 col-sm-11 col-m11">
                                       <input type="password" name="password_confirmation" id="pswd1" placeholder="Re-enter Password">

                                    </div>
                                 </div>
                                 <div class="post-comment-form s-up row mb-15">
                                    <div class="col-md-1 col-sm-1 col-m1">
                                       <div class="inline-left">
                                       </div>
                                    </div>
                                    <div class="col-md-11 col-sm-11 col-m11">

                                       <div class="form-group form-check p-2">
                                       <div class="form-check">
                                           <input type="checkbox" class="form-check-input" id="exampleCheck1" required="">
                                           <label class="form-check-label" for="exampleCheck1">I agree to the Terms of Service</label>
                                         </div>

                                          
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <button type="submit" class="btn btn-primary login_submit"><i class="fa fa-arrow-right"></i> Login</button>
                           </form>
                        </div>
                        <div class="form-bottm-area p-5">
                           <a href="{{url('/user/login')}}" class="forget">Have A Account?</a>
                           <p class="mt-2">By proceeding, you agree to the Blog's <a href="{{url('/terms')}}" class="link-bold">Terms of Use</a> and <a href="{{url('/privacy')}}" class="link-bold">Privacy Policy</a></p>
                        </div>
                  </div>
                  <div class="col-md-3"></div>
               </div>
            </div>
         </div>
</div>
@endsection