@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <a href="{{url('admin/all/notic')}}"></a><i class="fas fa-users"></i>
                Notice-board..</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="{{url('/admin/update/notic')}}" method="post" enctype="multipart/form-data">
              @csrf
                    <input type="hidden" name="id" value="{{$data->id}}">

                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Title</label>                  
                    <input type="text" name="title" class="form-control" value="{{$data->title}}">
                  </div>

                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Details</label>                  
                    <textarea type="text" name="notic" rows="4" class="form-control">{{$data->notic}}</textarea>
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



            
