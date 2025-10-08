@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <a href="{{url('/admin/all/modeltest')}}"></a><i class="fas fa-plus"></i>
                Model Test Updated</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="{{url('/admin/update/modeltest')}}" method="post" enctype="multipart/form-data">
              @csrf

                <div class="form-group">
                    <label for="nf-pattern" class=" form-control-label">Exam Pattern</label>
                    <select class="form-control" required name="exam_pattern" id="nf-pattern">
                        <option value="">Choice option</option>
                        <option {{ $data->exam_type === 'BCS' ? 'selected' : '' }} value="BCS">BCS</option>
                        <option {{ $data->exam_type === 'Regular Exam' ? 'selected' : 'selected' }} value="Regular Exam">Regular Exam</option>
                        <option {{ $data->exam_pattern === 'Lecture' ? 'selected' : '' }} value="Lecture Wise">Lecture Wise</option>
                        <option {{ $data->exam_pattern === 'Clinical Case' ? 'selected' : '' }} value="Clinical Case">Clinical Case</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label for="nf-type" class=" form-control-label">Exam Type</label>
                    <select class="form-control" required name="exam_type" id="nf-type">
                        <option value="">Choice option</option>
                        <option {{ $data->exam_type === 'Free' ? 'selected' : '' }} value="Free">Free Exam</option>
                        <option {{ $data->exam_type === 'Premium' ? 'selected' : '' }} value="Premium">Premium Exam</option>
                    </select>
                </div>

                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Model Test Name</label>
                    <input type="hidden" name="id" value="{{$data->id}}" class="form-control">
                    <input type="text" name="name" value="{{$data->name}}" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Total Marks</label>
                    <input type="number" name="exam_in_minutes" class="form-control" required value="{{$data->exam_in_minutes}}">
                  </div>
                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Model Test Length (Minutes)</label>
                    <input type="number" name="ex_time" value="{{$data->ex_time}}" class="form-control" required>
                  </div>

				<div class="form-group">
                    <label for="nf-email" class=" form-control-label">Solve Class</label>
                    <input type="text" name="solve_shet" value="{{$data->solve_shet}}" class="form-control" required placeholder="Solve Sheet">
                  </div>

				<div class="form-group">
                    <label for="nf-email" class=" form-control-label">Serial</label>
                    <input type="number" name="serial" value="{{$data->serial}}" class="form-control" required placeholder="Serial">
                  </div>

                  <div class="form-group">
                      <label for="nf-email" class=" form-control-label">Admission Batch</label>
                      <select class="form-control" name="batch[]" multiple="" required="">
                      @foreach($memberbatch as $batch)
                      @php
                        $batch_id = App\ModeltestBatch::where('modeltest_id',$data->id)->where('membershipe_id',$batch->id)->first();
                      @endphp
                      <option value="{{$batch->id}}" {{ $batch->id == ($batch_id->membershipe_id ?? 0) ? 'selected' : '' }}>{{$batch->plan}}</option>
                      @endforeach
                    </select>
                    </div>
                  <button type="submit" class="btn btn-primary btn-sm">
                      <i class="fa fa-dot-circle-o"></i> Submit
                  </button>
              </form>
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
