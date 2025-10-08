@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <i class="fas fa-users"></i>
                Model Test Exam
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="{{url('/admin/add/exam')}}" style="color: #fff;">Add ModeExam</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                  @if(session()->has('success'))
                  <script>
                    Swal.fire(
                        'Good job!',
                        'ModelExam Uploads Success........',
                        'success'
                      )
                  </script>
                 @endif
              <div class="table-responsive">
                <table class="table table-bordered dataTable"  width="100%">
                    <thead>
                        <tr role="row">
                            <th>Mdel test</th>
                            <th>Question</th>
                            <th>A</th>
                            <th>B</th>
                            <th>C</th>
                            <th>D</th>
                            <th>time</th>
                            <th style="width:136px;">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($exam as $data)
                        <tr>
                            <td>{{$data->modeltest->name}}</td>
                            <td>{{str_limit($data->question,70)}}</td>
                            <td>{{$data->a}}</td>
                            <td>{{$data->b}}</td>
                            <td>{{$data->c}}</td>
                            <td>{{$data->d}}</td>
                            <td>{{$data->created_at}}</td>
                            <td>
                              <a href="#" class="btn btn-success" title="view"><i class="fas fa-plus"></i></a>
                              <a href="#" class="btn btn-info" title="edit"><i class="fas fa-pencil-alt"></i></a>
                              <a href="#" class="btn btn-danger" title="trash"><i class="fas fa-trash"></i></a>
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
