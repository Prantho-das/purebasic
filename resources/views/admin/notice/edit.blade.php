@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <a href="{{url('admin/all/notice')}}"></a>
                Notice-board..</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="{{url('/admin/update/notice')}}" method="post" enctype="multipart/form-data">
              @csrf
                    <input type="hidden" name="id" value="{{$data->id}}">

                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Name</label>
                    <input type="text" name="title" class="form-control" value="{{$data->name}}">
                  </div>
                     
                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Notice</label>
                    <textarea type="text" name="notic" rows="4" class="form-control">{{$data->notice}}</textarea>
                  </div>
                  
                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Link</label>
                    <textarea type="text" name="link" class="form-control" >{{$data->link}}</textarea>
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
