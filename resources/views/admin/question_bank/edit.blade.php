@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                Update Topic</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="{{url('/admin/update/question_bank_topic')}}" method="post" enctype="multipart/form-data">
              @csrf

                <input type="hidden" name="id" class="form-control" required value="{{$data->id}}">

                <div class="form-group">
                    <label for="nf-pattern" class=" form-control-label">Topic Type</label>
                    <select class="form-control" required name="type">
                        <option value="PG_Dentistry">PG_Dentistry</option>

                    </select>
                </div>
                
                <div class="form-group">
                    <label for="nf-email" class="form-control-label">Subject</label>
                    <select name="subject" class="form-control">
                    @php
                       $subjects=App\Category::where('status',1)->latest('id')->get();
                    @endphp
                    @foreach($subjects as $subject)
                    <option value="{{$subject->id}}" {{$data->subject_id == $subject->id ? 'selected' : ''}}>{{$subject->name}}</option>
                    @endforeach
                 </select>
                </div>

                <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Chapter</label>
                     <select name="chapter" class="form-control" required>
                        @php
                           $chapter=App\Chapter::where('status',1)->get();
                        @endphp
                        @foreach($chapter as $chap)
                            <option value="{{$chap->id}}" {{$data->chapter_id == $chap->id ? 'selected' : ''}}>{{$chap->name}}</option>
                        @endforeach
                     </select>
                </div>

                <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Topic Name</label>
                    <input type="text" name="name" class="form-control" required value="{{$data->name}}">
                </div>
                
                <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Topic Serial</label>
                    <input type="number" name="serial" class="form-control" required value="{{$data->serial}}">
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
