@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <i class="fas fa-users"></i>
                Job Exam list
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="{{url('/admin/add/job')}}" style="color: #fff;">Add Job List</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                  @if(session()->has('success'))
                  <script>
                   swal({
                      title: "Good job!",
                      text: "Your Job list Uploads Success........",
                      icon: "success",
                      button: "Aww yiss!",
                    });
                  </script>
                 @endif
                 <span>Job Exam</span>               
              <div class="table-responsive">
                <table class="table table-bordered dataTable"  width="100%">
                    <thead>
                        <tr role="row">
                            <th>Job-Title</th>
                            <th style="width:136px;">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($alljob as $data)
                        <tr>
                            <td>{{str_limit($data->jobTitle,70)}}</td>
                            <td>
                              <a href="#" class="btn btn-success" title="view"><i class="fas fa-plus"></i></a>
                              <a href="#" class="btn btn-info" title="edit"><i class="fas fa-pencil-alt"></i></a>
                              <a href="#" class="btn btn-danger" title="trash"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
              </div>
              <div class="col-md-6">
              <span>Exam Circular</span>
              <div class="table-responsive">
                <table class="table table-bordered dataTable"  width="100%">
                    <thead>
                        <tr role="row">
                            <th>Job-Title</th>
                            <th style="width:136px;">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($allcircular as $data)
                        <tr>
                            <td>{{str_limit($data->jobTitle,70)}}</td>
                            <td>
                              <a href="#" class="btn btn-success" title="view"><i class="fas fa-plus"></i></a>
                              <a href="#" class="btn btn-info" title="edit"><i class="fas fa-pencil-alt"></i></a>
                              <a href="#" class="btn btn-danger" title="trash"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
              </div>
            </div>

          </div>
          <div class="card-footer small text-muted"></div>
        </div>

      </div>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
@endsection
