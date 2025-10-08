@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                Exam
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="{{url('/admin/add/model')}}" style="color: #fff;">Add Exam</a>
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
                  title: 'Modeltest Updateed',
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
                  title: 'Modeltest daleted',
                  showConfirmButton: false,
                  timer: 1500
                    })
              </script>
              @endif
              <div class="table-responsive">
                <table class="table table-bordered dataTable"  width="100%">
                    <thead>
                        <tr role="row">
                            <th>Exam Name</th>
                            <th>Total Marks</th>
                            <th>Exam Time</th>
                            <th>Create Time</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($model as $data)
                        <tr>
                            <td>{{str_limit($data->name,30)}}</td>
                            <td>{{$data->exam_in_minutes}}</td>
                            <td>{{$data->ex_time}}</td>
                            <td>{{$data->created_at}}</td>
                            <td>
                              <a href="{{url('/admin/questions/'.$data->id)}}" class="btn btn-info" title="All Question"><i class="fas fa-clipboard-list"></i></a>
                              <a href="{{url('/admin/edit/modeltest/'.$data->id)}}" class="btn btn-info" title="edit"><i class="fas fa-pencil-alt"></i></a>
                              <a href="{{url('/admin/delete/modeltest/'.$data->id)}}" class="btn btn-danger" title="trash"><i class="fas fa-trash"></i></a>
                              <a href="{{url('/admin/view/'.$data->id)}}" class="btn btn-info" title="View">View</a>
                              <a href="{{url('/admin/solve/'.$data->id)}}" class="btn btn-info" title="Solve">Solve</a> 
                              <a href="{{url('/admin/result/'.$data->id)}}" class="btn btn-info" title="Result">Result</a> 


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
