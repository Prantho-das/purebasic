@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

  <div class="container-fluid">
    <div class="card mb-3">
      <div class="card-header">
        <div class="row">
          <div class="col-md-10">
           
        </div>
      </div>
    </div>
    <div class="card-body">
      <form action="{{url('/admin/banner/create')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="nf-email" class=" form-control-label">Banner</label>
          <input type="file" name="image" value="{{old('image')}}" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}">
          @if ($errors->has('image'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('image') }}</strong>
          </span>
          @endif
        </div>

        <div class="form-group">
          <label for="nf-email" class=" form-control-label">Batch Id</label>
          <input type="number" name="batch_id" value="{{old('batch_id')}}" class="form-control{{ $errors->has('batch_id') ? ' is-invalid' : '' }}">
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

</div>
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
@endsection




