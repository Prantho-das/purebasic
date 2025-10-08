@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <a href="{{url('admin/all/notic')}}"></a><i class="fas fa-users"></i>
               Gallery</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="{{url('/admin/upload/photos')}}" method="post" enctype="multipart/form-data">
              @csrf
                  <div class="form-group{{ $errors->has('photo') ? ' is-invalid' : '' }}">
                    <label for="nf-email" class=" form-control-label">Photo</label>                  
                    <input type="file" name="photo" class="form-control">
                    @if ($errors->has('photo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('photo') }}</strong>
                        </span>
                    @endif
                  </div>

                  <button type="submit" class="btn btn-primary btn-sm">
                      <i class="fa fa-dot-circle-o"></i> Submit
                  </button>
              </form>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

      </div>

    </div>

  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
@endsection



            
