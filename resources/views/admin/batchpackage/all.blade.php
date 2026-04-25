
@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                All Batch Package
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="{{url('/admin/batchPackage/create')}}" style="color: #fff;">Add Batch Package</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-md-4">
                <form method="GET" action="{{ url('/admin/batchPackage') }}">
                  <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by title..." value="{{ request('search') }}">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit">Search</button>
                      @if(request('search'))
                        <a href="{{ url('/admin/batchPackage') }}" class="btn btn-secondary">Clear</a>
                      @endif
                    </div>
                  </div>
                </form>
              </div>
            </div>
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
                <table class="table table-bordered" width="100%">
                    <thead>
                        <tr role="row">
                            <th>Title</th>
                            <th style="width:136px;">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($datas as $data)
                       <tr>
                            <td>{{$data->title}}</td>
                            <td>{{$data->showing_status==1?'Active':'Inactive'}}</td>
                            <td>{{$data->batch_category==1?'Medicine':''}}</td>
                            <td>{{$data->batch_category==2?'Dentistry':''}}</td>
                            <td>{{$data->batch_category==3?'BCS':''}}</td>
                            <td>
                              <a href="{{url('/admin/batchPackage/edit/'.$data->id)}}" class="btn btn-success" title="view"><i class="fas fa-edit"></i></a>
                              <a href="{{url('/admin/batchPackage/delete/'.$data->id)}}" class="btn btn-danger" title="trash"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
              </div>
            </div>

            <div class="mt-3">{{ $datas->links() }}</div>
          </div>
          <div class="card-footer small text-muted">
            Showing {{ $datas->firstItem() }}–{{ $datas->lastItem() }} of {{ $datas->total() }} packages
          </div>
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
