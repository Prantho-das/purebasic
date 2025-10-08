@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <i class="fas fa-users"></i>
                Mentor
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="{{url('/admin/all/mentors')}}" style="color: #fff;">All Mentors</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered"  width="100%">
                <tr>
                  <th>Name</th>
                  <td>
                      {{$data->name}}
                  </td>
                </tr>
                <tr>
                  <th>Designation</th>
                  <td>
                      {{$data->designation}}
                  </td>
                </tr>

                <tr>
                  <th>Image</th>
                   <td> <img src="{{asset('uploads/mentor/'.$data->image)}}" style="width: 150px;"></td>
                </tr>
                <tr>
                  <th>Time</th>
                  <td>{{$data->created_at}}</td>
                </tr>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated</div>
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
