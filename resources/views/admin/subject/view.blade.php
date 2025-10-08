@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                Subject.........
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <a href="{{url('/admin/all/subject')}}" style="color: #fff;">All Subject</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered dataTable"  width="100%">
                <tr>
                  <th>Name</th>
                  <td>:</td>
                  <td>{{$data->name}}</td>
                </tr>
                <tr>
                  <th>Time</th>
                  <td>:</td>
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
