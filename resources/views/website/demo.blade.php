@extends('layouts.register')
@section('content')

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="register_bg">
                      <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-8">
                        <img src="{{asset('contents/website')}}/img/aaaa1.jpg" width="100%" style="margin-bottom: 20px;">
                          <div class="register_form">
                              <form class="" id="registration" action="{{url('/demo/student/submit')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group{{ $errors->has('name') ? ' is-invalid' : '' }}">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Full Name">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' is-invalid' : '' }}">
                                    <label>E-Mail</label>
                                    <div>
                                        <input type="email" class="form-control"  name="email" value="{{old('email')}}" placeholder="Enter a valid e-mail">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                

                                <div class="form-group{{ $errors->has('mobile') ? ' is-invalid' : '' }}">
                                    <label>Phone Number</label>
                                    <div>
                                        <input name="mobile" data-parsley-type="number" maxlength="11" minlength="11" value="{{old('mobile')}}" type="text" class="form-control"  placeholder="Mobile Number" minlength="11" maxlength="11">
                                        @if ($errors->has('mobile'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('mobile') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>



                                <div class="form-group{{ $errors->has('medical') ? ' is-invalid' : '' }}">
                                    <label>Medical / Dental college</label>
                                    <div>
                                        <input name="medical" value="{{old('medical')}}" type="text" class="form-control"  placeholder="Your answer">
                                        @if ($errors->has('medical'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('medical') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
								  
								   <div class="form-group" style="display:none">
                                         <div>
                                            @foreach($data as $data)
                                                 <input type="hidden" name="group" value="6" >
                                            @endforeach
                                    </div>
                                </div>



                                <div class="form-group{{ $errors->has('password') ? ' is-invalid' : '' }}">
                                    <label>Pasword</label>
                                    <div>
                                        <input type="password" name="password" class="form-control" value="{{old('password')}}"  placeholder="Password">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="m-t-10">
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Re-Type Password">
                                    </div>
                                </div>

                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            Registration
                                        </button>


                            </form>
                          </div>
                      </div>
                      <div class="col-md-2"></div>
                  </div>
                    </div>
                </div>
            </div>
        </div>


  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>


<script>
$(function(){
    $('#doctor').hide();

    $('.doctor').on('click',function(){
        $('#doctor').toggle();
    })

})

$(function(){
    $('#student').hide();

    $('.student').on('click',function(){
        $('#student').toggle();
    })

})

</script>

@endsection
