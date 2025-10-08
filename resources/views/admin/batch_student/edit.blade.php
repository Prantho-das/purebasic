@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <a href="{{url('batch_student')}}">
               Batch Student</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="{{url('batch_student.update',$value->id)}}" method="post" enctype="multipart/form-data">
              @csrf
                @method('put')
                <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Student Name</label>
                    <label for="nf-email" class=" form-control-label">{{$value->student->name}}</label>
                </div>
                <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Batch Name</label>
					<input type="text" name="plan" class="form-control" value='{{$value->course->plan}}'>
                </div>
				<div class="form-group">
                    <label for="nf-email" class=" form-control-label">Fees</label>
                    <label for="nf-fees" class=" form-control-label">{{$value->fees}}</label>
                  </div>
				<div class="form-group">
                    <label for="nf-email" class=" form-control-label">Payable</label>
                    <input type="text" name="payable" class="form-control" value='{{$value->payable}}'>
                  </div>

                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Paid</label>
                    <input type="text" name="paid" class="form-control" value='{{$value->paid}}'>
                  </div>

                <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Enroll Date</label>
                    <input type="text" name="paid" class="form-control date-picker" value='{{$value->enroll_at}}'>
                </div>

                  <button type="submit" class="btn btn-primary btn-sm">
                      <i class="fa fa-dot-circle-o"></i> Submit
                  </button>
              </form>
          </div>
        </div>

      </div>

    </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
@endsection




