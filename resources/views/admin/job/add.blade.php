@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <a href="{{url('/admin/all/job')}}"></a><i class="fas fa-users"></i>
                Job Exam list</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="{{url('/admin/upload/job')}}" method="post" enctype="multipart/form-data">
              @csrf
                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Job Title</label>                  
                    <input type="text" name="title" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Exam & Circular</label>                  
                    <select name="manage" class="form-control">
                      <option value="0">Select Option</option>
                      <option value="1">Job Exam</option>
                      <option value="2">Job Circular</option>
                    </select>
                  </div>


                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Details</label>                  
                    <textarea name="details" class="form-control summernote" rows="6"></textarea>
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



            
