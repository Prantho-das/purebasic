@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <i class="fas fa-book"></i> All Exam
              </div>
				<div class="col-md-2">
					
				</div>
          </div>
          <div  class="card-body">
            <div class="row">
              <div class="col-md-12">
              <div class="table-responsive">
				   <table class="table table-striped" style="background: #fff;border: 1px solid #ccc;">
                        <tr>
                            <th style="width: 1px;">SL</th>
                            <th>Name</th>
                        </tr>
                        @php 
                            $modeltest = App\Modeltest:: where('status',1)->get(); 
                        @endphp 
                        @foreach($modeltest as $key=>$dataa)
                            <tr>
                                <th>{{$key+1}}</th>
                                <th><a href="{{url('/admin/exam-wise-result/'.$dataa->id)}}" style="color:#000">{{$dataa->name}}</a></th>
                               
                            </tr>
                        @endforeach
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
