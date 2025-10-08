@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <a href="{{url('admin/all/notice')}}"></a>
               All Notice</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="{{url('/admin/upload/notice')}}" method="post" enctype="multipart/form-data">
              @csrf
                  <div class="form-group{{ $errors->has('title') ? ' is-invalid' : '' }}">
                    <label for="nf-email" class=" form-control-label">Name</label>
                    <input type="text" name="title" class="form-control" required>
                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                  </div>

                     <div class="form-group">
                        <label for="nf-email" class=" form-control-label">Admission Batch</label>
                        <select class="form-control" name="batch[]" multiple="">
                           @foreach($data as $data)
                           <option value="{{$data->id}}">{{$data->plan}}</option>
                           @endforeach
                        </select>
                     </div>

                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Notice</label>
                    <textarea type="text" name="notic" rows="4" class="form-control" required></textarea>
                  </div>

                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Link</label>
                    <textarea type="text" name="link" class="form-control" ></textarea>
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
