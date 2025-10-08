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
				  <button class='btn btn-success' onclick="printDiv('print')">PDF</button>
              </div>
          </div>
          <div  class="card-body">
            <div class="row">
              <div class="col-md-12">
              <div class="table-responsive">

                <div class="">
                  <form method="get" action="{{url('/admin/student/view/result')}}">
                      <input type="hidden" name="modeltest_id" value="{{$id}}">
                      <select class="form-control" name="batch_id">
                      @foreach($batch as $data)
                      @php
                          $memberships = App\Membership::where('id',$data->membershipe_id)->first();
                        @endphp
                          <option value="{{$memberships->id}}">{{$memberships->plan}}</option>
                      @endforeach
                     </select>

                     <button type="submit" class="btn btn-primary mt-2 mb-5">Submit</button>

                  </form>
                  
                </div>

                @if($request)
				  <div id='print'>
                   <table  class="table table-bordered" style="text-transform: capitalize;"  width="100%">
                    <thead>
                        <tr role="row">
                            
                            <th>Model Test Name</th>
							 <th>Student Id</th>
							<th>Student Name</th>
                            <th>Obtained Marks</th>
                            <th>Total Marks</th>
                           
                        </tr>
                    </thead>
                    <tbody>

                      @php
                        $all_students = App\Student::where('batch_id',$request->batch_id)->get();
                      @endphp
						
                     @foreach($all_students as $key=>$student) 
                      @php
                        $results = App\Modeltest_answer::where('student_id',$student->id)->where('modeltest_id',$id)->orderBy('point','desc')->first();
                        $model_test = App\Modeltest::where('id',$id)->first();
                      @endphp
                          @if($results)
                            <tr>
                                <th>{{$model_test->name}}</th>
								<th>{{$student->student_id}}</th>
								 <th>{{$student->name}}</th>
                                <th>{{$results->point}}</th>
                                <th>{{$model_test->exam_in_minutes}}</th>
                                
                            </tr>
                          @endif
                        @endforeach
                    </tbody>
                </table> 
					  </div>
                @endif
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

<script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
  </script>
@endsection
