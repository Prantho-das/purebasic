@extends('layouts.website')
@section('content')
 @php
    $id=Session:: get('id');
@endphp
    @if(session()->has('approve'))
    <script>
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Your information submited',
        showConfirmButton: false,
        timer: 1500
          })
    </script>
    @endif
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="my_cl">
                   <table class="table table-striped" style="background: #fff;border: 1px solid #ccc;">
                        @php $point=App\Modeltest_answer:: where('status',1)->orderBy('id','desc')->paginate(15); @endphp

                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Exam name</th>
                            <th>Date</th>
                            <th>Total marks</th>
                            <th>Obtained marks</th>
                        </tr>

                        @foreach($point as $key=>$data) 
                        @php 
                            $modeltest = App\Modeltest:: where('id',$data->modeltest_id)->first(); 
                        @endphp 
                            @if($modeltest)
                            <tr>
                                <th>{{$key+1}}</th>
                                @php
                                    $student=App\Student::where('id',$data->student_id)->first();
                                @endphp
                                <th>{{$student->name}}</th>
                                <th>{{$modeltest->name}}</th>
                                <th>{{$data->created_at}}</th>
                                <th>{{$modeltest->exam_in_minutes}}</th>
                                <th>{{$data->point}}</th>
                            </tr>
                            @endif 
                        @endforeach
                    </table>
                    
                    <div>{{ $point->links() }}</div>
              </div>
          </div>
      </div>
  </div>
@endsection
