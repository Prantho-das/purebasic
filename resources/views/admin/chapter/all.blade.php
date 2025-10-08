@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <i class="fas fa-users"></i>
                All Banner
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="{{url('/admin/banner/create')}}" style="color: #fff;">Add Banner</a>
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
                      button: "",
                    });
                  </script>
                 @endif             
              <div class="table-responsive">
                <table class="table table-bordered dataTable"  width="100%">
                    <thead>
                        <tr role="row">
                            <th>Title</th>
                            <th style="width:136px;">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($datas as $data)
                        <tr>
                            <td><img src="{{ asset('uploads/banner/'.$data->image) }}" width="150" alt=""></td>
                            <td>
                              {{-- <a href="{{url('/admin/batchPackage/edit/'.$data->id)}}" class="btn btn-success" title="view"><i class="fas fa-plus"></i></a> --}}
                              <a href="{{ url('/admin/banner/delete/'.$data->id) }}" class="btn btn-danger" title="trash"><i class="fas fa-trash"></i></a>
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
