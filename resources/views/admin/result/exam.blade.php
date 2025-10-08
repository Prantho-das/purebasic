@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <i class="fas fa-book"></i>  
                All Exam Result
              </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-bordered" style="text-transform: capitalize;"  width="100%">
                    <thead>
                        <tr role="row">
                             <th>SL</th>
                            <th>Exam name</th>
                            <th>Date</th>
                            <th>Total marks</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                     @foreach($result as $key=>$data) 
                            <tr>
                                <th>{{$key+1}}</th>
                                <th>{{$data->name}}</th>
                                <th>{{$data->created_at}}</th>
                                <th>{{$data->exam_in_minutes}}</th>
                                <th>
                                  <a href="{{url('/admin/student/vie/result/'.$data->id)}}">view</a>
                                </th>
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
