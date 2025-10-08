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
                <table id="dataTable" class="table table-bordered" style="text-transform: capitalize;"  width="100%">
                    <thead>
                        <tr role="row">
                             <th>SL</th>
                            <th>Student Id</th>
							 <th>Name</th>
                            <th>Exam name</th>
                            <th>Date</th>
                            <th>Total marks</th>
                            <th>Obtained marks</th>
                        </tr>
                    </thead>
                    <tbody>
                     @foreach($result as $key=>$data) 
                        @php 
                            $modeltest = App\Modeltest:: where('id',$data->modeltest_id)->first(); 
                        @endphp 
                            @if($modeltest)
                            <tr>
                                <td>{{$key+1}}</th>
                                @php
                                    $student=App\Student::where('id',$data->student_id)->first();
                                @endphp
						@if($student)
                                <td>{{$student->student_id}}</td>
								<td>{{$student->name}}</td>
                                <td>{{$modeltest->name}}</td>
                                <td>{{$data->created_at}}</td>
                                <td>{{$modeltest->exam_in_minutes}}</td>
                                <td>{{$data->point}}</td>
						@endif
                            </tr>
                            @endif 
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
