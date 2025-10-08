@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <i class="fas fa-book"></i> Exam Wise Result
              </div>
				<div class="col-md-2">
					<button class='btn btn-success' onclick="printDiv('print')">PDF</button>
				</div>
          </div>
          <div  class="card-body">
            <div class="row">
              <div class="col-md-12">
              <div class="table-responsive">
				   <div id='print'>
	    <table class="table table-striped" style="background: #fff;border: 1px solid #ccc;">
    @php $point=App\Modeltest_answer:: where('status',1)->orderBy('id','desc')->paginate(15); @endphp

    <tr>
        <!--<th>SL</th>-->
        <th>Student Id</th>
		 <th>Student Name</th>
        <th>Date</th>
        <th>Obtained marks</th>
        <th>Merit Position</th>
    </tr>

    @foreach($modeltest as $key=>$data) 

        <tr>
            <!--<th>{{$key+1}}</th>-->
            @php
                $student=App\Student::where('id',$data->student_id)->first();
            @endphp
			@if($student)
            <td>{{$student->student_id}}</td>
			 <td>{{$student->name}}</td>
            <td>{{$data->created_at}}</td>
            <td>{{$data->point}}</td>
            <td>{{$key+1}}</td>
			@endif
        </tr>

    @endforeach
</table>
</div>
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
