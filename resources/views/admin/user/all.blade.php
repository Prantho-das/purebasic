@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                All User
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <a href="{{url('admin/create/user')}}" style="color: #fff;">Add User</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                  @if(session()->has('success'))
                  <script>
                   swal({
                      title: "Good job!",
                      text: "Your User Created Success........",
                      icon: "success",
                      button: "Aww yiss!",
                    });
                  </script>
                 @endif             
              <div class="table-responsive">
                <table class="table table-bordered dataTable"  width="100%">
                    <thead>
                        <tr role="row">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Image</th>
                            <th style="width:136px;">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($alluser as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>{{$data->email}}</td>
                            <td>............</td>
                            <td>
                              <img src="{{asset('uploads/user/'.$data->photo)}}" style="width: 50px;">
                            </td>
                            <td>
                              <a href="{{url('/admin/view/user/'.$data->id)}}" class="btn btn-success" title="view"><i class="fas fa-plus"></i></a>
                              <a href="{{url('/admin/delete/user/'.$data->id)}}" class="btn btn-danger" title="trash"><i class="fas fa-trash"></i></a>
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
