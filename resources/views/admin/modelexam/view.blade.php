@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
          <div class="breadcrumb">
              <div class="col-sm-4">
                  <div class="page-header float-left" style="margin-top: 5px;">
                      <div class="page-title">
                          <a href="{{url('admin/adduser')}}" class="btn btn-primary"><i class="fa fa-plus"></i>  Add About</a>
                      </div>
                  </div>
              </div>
          </div>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-users"></i>
            About Us
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered dataTable"  width="100%">
                <tr>
                  <th>About us</th>
                  <td>:</td>
                  <td>{{$data->aboutus}}</td>
                </tr>
                <tr>
                  <th>Updated</th>
                  <td>:</td>
                  <td>{{$data->updated_at}}</td>
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
