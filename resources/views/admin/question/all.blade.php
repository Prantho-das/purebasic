@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                All Question
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="{{url('/admin/add/questions/'.$id)}}" style="color: #fff;">Add Question</a>
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
                  title: 'Option daleted',
                  showConfirmButton: false,
                  timer: 1500
                    })
              </script>
              @endif
              <div class="table-responsive">
                <table class="table table-bordered dataTable"  width="100%">
                    <thead>
                        <tr role="row">
                            <th style="width: 50px">No</th>
                            <th>Question Name</th>
                            <th style="width:212px;">Question Option Type</th>
                            <th style="width:105px;">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($question as $key=>$data)
                        <tr>
                            <td>{{$key +1}}</td>
                            <td>{{$data->question}}</td>
                            <td>
                              @if ($data->is_multi == 1)
                                Multiple  
                              @else
                                Single
                              @endif
                            </td>
                            <td>
                              {{-- <a href="{{url('/admin/all/option/'.$data->id)}}" class="btn btn-info" title="All Options"><i class="fas fa-clipboard-list"></i></a> --}}
                              <a href="{{url('/admin/edit/questions/'.$data->id)}}" class="btn btn-info" title="edit"><i class="fas fa-pencil-alt"></i></a>
								<a href="{{url('/admin/delete/questions/'.$data->id)}}" class="btn btn-danger" title="edit"><i class="fas fa-trash"></i></a>
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
