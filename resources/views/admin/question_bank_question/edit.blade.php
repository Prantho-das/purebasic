@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
 @if(session()->has('edit'))
              <script>
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Questions Update Success',
                  showConfirmButton: false,
                  timer: 1500
                    })
              </script>
              @endif
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <a href="{{url('/admin/all/job')}}"></a>
                Questions Uploads
              </div>
              <div class="col-md-2">
                 <a href="{{url('admin/question_bank_questions/'.$data->question_bank_id)}}" class="btn btn-primary"><i class="fas fa-book"></i> All Questions</a>
              </div>
            </div>
          </div>

          <div class="card-body">
            <form action="{{url('/admin/edit/question_bank_questions/'.$id)}}" method="post" enctype="multipart/form-data">
             @csrf

             <h3 class="bg-secondary"style="padding: 5px 15px;">Add Questions</h3>
             <div class="form-group">
              <label for="nf-email" class=" form-control-label">Questions name</label>
              <input type="text" name="name" class="form-control" required value="{{$data->question}}">
            </div>
            <div class="form-group">
              <input type="checkbox" name="is_multi" class="" {{$data->is_multi == 1 ? 'checked' : ''}} >
              <label for="nf-email" class=" form-control-label">MCQ</label><br>
            </div>
            <div class="form-group">
              <input type="checkbox" name="is_free" class="" {{$data->is_free == 1 ? 'checked' : ''}} >
              <label for="nf-email" class=" form-control-label">Free</label><br>
            </div>
            <div class="form-group">
              <label for="nf-email" class=" form-control-label">Questions Details</label>
              <input type="text" name="detailss" class="form-control" value="{{$data->detailss}}">
            </div>
            <div class="form-group">
              <label for="nf-email" class=" form-control-label">Solve Link</label>
              <input type="text" name="solve_link" class="form-control" value="{{$data->solve_link}}">
            </div>
            <h3 class="bg-secondary" style="padding: 5px 15px;">Add Option</h3>
            <div class="row">
              @php
                $que_options = App\QuestionBankOption::where('question_id',$data->id)->get();
                $alphabet = ['A','B','C','D','E'];
              @endphp
              @foreach ($que_options as $key => $options)

              <div class="col-md-4">
                <div class="form-group">
                  <label for="nf-email" class=" form-control-label">Option {{$alphabet[$key]}}</label>
                  <input type="text" name="option[{{$key}}][option]" class="form-control" required value='{{$options->option}}'>
                  <input type="checkbox" name="option[{{$key}}][correct]" class="" {{$options->correct_or_not == 1 ? 'checked' : ''}}>
                  <label for="nf-email" class=" form-control-label">Correct Ans ?</label><br>
                </div>
              </div>
              @endforeach
              
              
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
