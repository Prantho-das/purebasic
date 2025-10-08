@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                All subjects
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <a href="{{url('/admin/add/subject')}}" style="color: #fff;">Add subject</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                  @if(session()->has('update'))
              <script>
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Subject Updateed',
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
                  title: 'Subject daleted',
                  showConfirmButton: false,
                  timer: 1500
                    })
              </script>
              @endif
              <div class="table-responsive">
                <table class="table table-bordered dataTable"  width="100%">
                    <thead>
                        <tr role="row">
                            <th>Subject</th>
                            <th style="width:150px;">Serial</th>
                            <th style="width:150px;">Question Bank Serial</th>
                            <th style="width:150px;">Price</th>
                            <th style="width:185px;">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($subject as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            
                            <td>{{$data->serial}}</td>
                            <td>{{$data->qb_serial}}</td>
                            <td>{{$data->price}}</td>

                            <td>

                            <a href="{{url('/admin/edit/subject/'.$data->id)}}" class="btn btn-info" title="edit"><i class="fas fa-pencil-alt"></i></a>
                            <a href="{{url('/admin/delete/subject/'.$data->id)}}" class="btn btn-danger" title="trash"><i class="fas fa-trash"></i></a>
                            
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
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
@endsection
