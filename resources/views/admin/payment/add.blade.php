@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <a href="{{url('/admin/payment/')}}">Back</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="{{route('payment.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nf-email" class=" form-control-label">Name</label>
                                <input type="text" name="name" placeholder="Enter your name.." value="{{old('name')}}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}">
                                 @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                 @endif
                            </div>


                            <div class="form-group">
                                <label for="nf-password" class=" form-control-label">Email</label>
                                <input type="email" name="email" placeholder="Enter your email.." value="{{old('email')}}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}">
                                 @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                 @endif
                            </div>


                            <div class="form-group">
                                <label for="nf-password" class=" form-control-label">Photo</label>
                                <input type="file" name="pic" class="form-control">
                            </div>

                            <div class="form-group field-password">
                                <label for="password" class="control-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"/>
                                 @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group field-confirm_password">
                                <label for="confirm_password" class="control-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="confirm_password" class="form-control" />
                            </div>

                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
                        </form>
          </div>
          <div class="card-footer small text-muted"></div>
        </div>

      </div>

    </div>

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
@endsection




