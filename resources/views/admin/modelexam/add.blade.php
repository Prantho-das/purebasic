@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <a href="{{url('/admin/all/exam')}}"></a><i class="fas fa-users"></i>
                ModelExam Uploads</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="{{url('/admin/upload/exam')}}" method="post" enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                  <label for="nf-email" class=" form-control-label">Select Modeltest</label>
                  <select name="modeltest" class="form-control">
                    <option value="0">Select Option</option>
                    @foreach($model as $data)
                    <option value="{{$data->id}}">{{$data->name}}</option>
                    @endforeach
                  </select>
                </div>

                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Model exam question</label>
                    <input type="text" name="question" class="form-control" required>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nf-email" class=" form-control-label">A</label>
                        <input type="text" name="a" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nf-email" class=" form-control-label">B</label>
                        <input type="text" name="b" class="form-control" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nf-email" class=" form-control-label">C</label>
                        <input type="text" name="c" class="form-control" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="nf-email" class=" form-control-label">D</label>
                        <input type="text" name="d" class="form-control" required>
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                  <label for="nf-email" class=" form-control-label">Select Modeltest</label>
                  <select name="modeltest" class="form-control">
                    <option value="0">Select Option</option>
                    <option value="">ooooo</option>
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
