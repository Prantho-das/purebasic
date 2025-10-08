@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <a href="{{url('/admin/all/subject')}}"></a>
                Subject Uploads</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="{{url('/admin/upload/subject')}}" method="post" enctype="multipart/form-data">
              @csrf

                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Subject Name</label>
                    <input type="text" name="name" class="form-control" required>
                  </div>
                  
                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Subject Serial</label>
                    <input type="number" name="serial" class="form-control">
                  </div>
                  
                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Question Bank Subject Serial</label>
                    <input type="number" name="qb_serial" class="form-control">
                  </div>


                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Price</label>
                    <input type="number" name="price" class="form-control">
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
