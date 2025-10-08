@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <i class="fas fa-users"></i>
                Options
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="{{url('/admin/add/option/'.$id)}}" style="color: #fff;">Add Option</a>
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
                            <th>Option Name</th>
                            <th>Type</th>
                            <th style="width: 170px">Time</th>
                            <th style="width: 56px">Manage</th>

                        </tr>
                    </thead>
                    <tbody>
                      @foreach($option as $data)
                        <tr>
                            <td>{{$data->option}}</td>
                            <td>
                              @if ($data->correct_or_not == 1)
                                Correct Ans
                              @else
                                Wrong
                              @endif
                            </td>
                            <td>{{$data->created_at}}</td>
                            <td>
                               <a href="{{url('admin/edit/option/'.$data->id)}}" class="btn btn-info" title="edit"><i class="fas fa-pencil-alt"></i></a>
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
