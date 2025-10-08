@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                Book
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="{{url('/admin/add/book')}}" style="color: #fff;">Add Photo</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            @if(session()->has('update'))
              <script>
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Photos Updateed',
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
                  title: 'Photos Delete',
                  showConfirmButton: false,
                  timer: 1500
                    })
              </script>
              @endif

            <div class="table-responsive">
              <table class="table table-bordered dataTable"  width="100%">
                  <thead>
                      <tr role="row">
                          <th>Photos</th>
                          <th>Time</th>
                          <th style="width:136px;">Manage</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($book as $data)
                      <tr>
                          <td>
                            <img src="{{asset('uploads/book/'.$data->name)}}" style="width: 150px;">
                          </td>
                          <td>{{$data->created_at}}</td>
                          <td>
                            <a href="{{url('/admin/view/book/'.$data->id)}}" class="btn btn-success" title="view"><i class="fas fa-plus"></i></a>
                            <!-- <a href="{{url('/admin/edit/photos/'.$data->id)}}" class="btn btn-info" title="edit"><i class="fas fa-pencil-alt"></i></a> -->
                            <a href="{{url('/admin/delete/book/'.$data->id)}}" class="btn btn-danger" title="trash"><i class="fas fa-trash"></i></a>
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
