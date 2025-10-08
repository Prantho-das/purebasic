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
          <div class="col-md-12" style="margin-top:80px">
              <div class="my_cl">
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
                    
                    <!--<div>{{ $point->links() }}</div>-->
              </div>
          </div>
      </div>
  </div>
@endsection
