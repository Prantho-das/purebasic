@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <a href="{{url('admin/all/notice')}}"></a><i class="fas fa-users"></i>Mentor</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="{{url('/admin/update/mentor',$data->id)}}" method="post" enctype="multipart/form-data">
              @csrf
                  <div class="form-group{{ $errors->has('name') ? ' is-invalid' : '' }}">
                    <label for="nf-email" class=" form-control-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{$data->name}}" required>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                  </div>
                   <div class="form-group{{ $errors->has('title') ? ' is-invalid' : '' }}">
                    <label for="nf-email" class=" form-control-label">Designation</label>
                    <input type="text" name="designation" class="form-control" value="{{$data->designation}}"   required>
                    @if ($errors->has('designation'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('designation') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="form-group{{ $errors->has('image') ? ' is-invalid' : '' }}">
                    <label for="nf-email" class=" form-control-label">Image</label>                  
                    <input type="file" name="image" class="form-control">
                    @if ($errors->has('image'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                    @endif
                  </div>

                  <button type="submit" class="btn btn-primary btn-sm">
                      <i class="fa fa-dot-circle-o"></i> Submit
                  </button>
              </form>
          </div>
          <div class="card-footer small text-muted">Updated</div>
        </div>

      </div>

    </div>

  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
@endsection
