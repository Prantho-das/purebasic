@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            User Information
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
                  <th>Email</th>
                  <td>:</td>
                  <td>{{$data->email}}</td>
                </tr>
                <tr>
                  <th>Role</th>
                  <td>:</td>
                  <td></td>
                </tr>
                <tr>
                  <th>Image</th>
                  <td>:</td>
                  <td><img src="{{asset('uploads/user/'.$data->photo)}}"></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
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
