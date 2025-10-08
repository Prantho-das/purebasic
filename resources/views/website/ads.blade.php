@extends('layouts.website')
@section('content')
<!-- Post Section Start -->
<div class="post-section section pt-30">
    @if(session()->has('error'))
            <script>
               swal({
                 title: "opps!",
                 text: "email & password not match...........",
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
                           <h2>Ads</h2>
                           <span>Sign in with your social media account</span>
                        </div>
                         @php
                            $id = Session:: get('id');
                            $visitor = App\Visitor:: where('id',$id)->first();
                          @endphp
                        <div class="login-form bg-white p-5 mt-50">
                           <form method="post" action="{{url('/create-ads')}}" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone">
                              @csrf
                              <div id="account_details">
                                 <div class="post-comment-form row mb-15">
                                    <div class="col-md-1 col-sm-1 col-m1">
                                       <div class="inline-left">
                                          <label for="name"><i class="fa fa-user"></i></label>
                                       </div>
                                    </div>
                                    <div class="col-md-11 col-sm-11 col-m11">
                                       <input type="hidden" name="id" id="name" value="{{$visitor->id}}">
                                       <input type="text" name="name" id="name" value="{{$visitor->name}}">
                                    </div>
                                 </div>
                                 <div class="post-comment-form row mb-15">
                                    <div class="col-md-1 col-sm-1 col-m1">
                                       <div class="inline-left">
                                          <label for="email"><i class="fa fa-envelope" aria-hidden="true"></i></label>
                                       </div>
                                    </div>
                                    <div class="col-md-11 col-sm-11 col-m11">
                                       <input type="email" name="email" id="email" placeholder="Email Address" value="{{$visitor->email}}"> 
                                    </div>
                                 </div>

                                

                                 <div class="post-comment-form row mb-15">
                                    <div class="col-md-1 col-sm-1 col-m1{{ $errors->has('phone') ? ' is-invalid' : '' }}">
                                       <div class="inline-left">
                                          <label for="email"><i class="fa fa-phone" aria-hidden="true"></i></label>
                                       </div>
                                    </div>
                                    <div class="col-md-11 col-sm-11 col-m11">
                                       <input type="number" name="phone" id="email" placeholder="Phone Number" value="{{$visitor->phone}}"> 
                                    </div>
                                 </div>

                                  <div class="post-comment-form row mb-15">
                                    <div class="col-md-1 col-sm-1 col-m1">
                                       <div class="inline-left">
                                          <label for="email"><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                                       </div>
                                    </div>
                                    <div class="col-md-11 col-sm-11 col-m11">
                                       <input type="text" name="city" id="email" placeholder="Company">
                                    </div>
                                 </div>
                                 <div class="post-comment-form row mb-15">
                                    <div class="col-md-1 col-sm-1 col-m1">
                                       <div class="inline-left">
                                          <label for="email"><i class="fa fa-calendar" aria-hidden="true"></i></label>
                                       </div>
                                    </div>
                                    <div class="col-md-11 col-sm-11 col-m11">
                                       <input type="number" name="day" id="email" placeholder="day" required=""> 
                                    </div>
                                 </div>

                                   <div class="post-comment-form row mb-15">
                                    <div class="col-md-1 col-sm-1 col-m1">
                                       <div class="inline-left">
                                          <label for="email"><i class="fa fa-picture-o" aria-hidden="true"></i></label>
                                       </div>
                                    </div>
                                    <div class="col-md-11 col-sm-11 col-m11">
                                       <input type="file" name="image" id="email" required="">
                                    </div>
                                 </div>

                                  <div class="post-comment-form row mb-15">
                                    <div class="col-md-1 col-sm-1 col-m1">
                                       <div class="inline-left">
                                          <label for="email"><i class="fa fa-money" aria-hidden="true"></i></label>
                                       </div>
                                    </div>
                                    <div class="col-md-11 col-sm-11 col-m11">
                                       <select class="form-control" name="payment" required="">
                                          <option value="0">Select Payment Method</option>
                                          <option value="Bkash">Bkash (01776601950)</option>
                                          <option value="Roket">Roket (01776601950)</option>
                                       </select>
                                    </div>
                                 </div>

                                  <div class="post-comment-form row mb-15">
                                    <div class="col-md-1 col-sm-1 col-m1">
                                       <div class="inline-left">
                                          <label for="email"><i class="fa fa-money" aria-hidden="true"></i></label>
                                       </div>
                                    </div>
                                    <div class="col-md-11 col-sm-11 col-m11">
                                       <input type="text" name="transaction" id="email" placeholder="Transaction Id" required="">
                                    </div>
                                 </div>




                              </div>
                              <button type="submit" class="btn btn-primary"><i class="fa fa-arrow-right"></i> Ads Submit</button>
                           </form>
                        </div>
                        <div class="form-bottm-area p-5">
                           <a href="{{url('/user/register')}}" class="forget">Create a account</a>
                           <p class="mt-2">By proceeding, you agree to the Blog's <a href="{{url('/terms')}}" class="link-bold">Terms of Use</a> and <a href="{{url('/privacy')}}" class="link-bold">Privacy Policy</a></p>
                        </div>
                  </div>
                  <div class="col-md-3"></div>
               </div>
            </div>
         </div>
</div>
@endsection