@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <i class="fas fa-users"></i>
                Downloads Links
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="{{url('/admin/books/add')}}" style="color: #fff;">Add Links</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            @if(session()->has('success'))
              <script>
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Downloads link Created',
                  showConfirmButton: false,
                  timer: 1500
                    })
              </script>
              @endif


              @if(session()->has('delete'))
              <script>
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Batch Delete',
                  showConfirmButton: false,
                  timer: 1500
                    })
              </script>
              @endif

            <div class="table-responsive">
              <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Url</th>
                                    <th>Image</th>
                                    <th style="width: 100px;">Time</th>
                                    <th style="width: 142px;">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($books as $data)
                                <tr>
                                    <td style="padding: 15px 10px;">{{$data->sl}}</td>
                                    <td style="padding: 15px 10px;">{{$data->name}}</td>
                                    <td style="padding: 15px 10px;">{{$data->url}}</td>
                                    <td style="padding: 0px 10px;">
                                        <img src="{{asset('uploads/user/'.$data->image)}}" style="width: 100px; height: 52px; padding: 5px;" />
                                        {{$data->name}}
                                    </td>
                                    <td style="padding: 15px 10px;">{{$data->created_at}}</td>
                                    <td style="padding: 15px 10px;">
                                        <a href="#" title="Delete" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated</div>
        </div>
      </div>
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
@endsection
