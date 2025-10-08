@extends('layouts.admin')
@section('content')

<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
            <form action="{{url('admin/lecture-sheet')}}" method="post">
                @csrf
                <div class="form-row align-items-center" style="margin-left: 10px">
                    <div class="col-sm-3 my-1">
                        <input type="text" name="name" class="form-control" id="lectureName" value="{{ empty($selected_name)?'':$selected_name }}" placeholder="Lecture Name">
                    </div>
                    <div class="col-sm-3 my-1">
                        <select class="custom-select my-1 mr-sm-2" id="subject" name="subject">
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                            <option value="{{$subject->category}}" {{ ($selected_subject == $subject->category)?'selected':'' }}>{{$subject->category}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4 my-1">
                        <select class="custom-select my-1 mr-sm-2" id="batch" name="batch">
                            <option value="">Select Batch</option>
                            @foreach($batches as $key=>$batch)
                                <option value="{{$key}}" {{ ($selected_batch == $key)?'selected':'' }}>{{$batch}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto my-1">
                        <button type="submit" class="btn btn-primary" >Submit</button>
                        <button onclick="location.href='{{url('admin/lecture-sheet')}}';" class="btn btn-danger" type="reset">Reset</button>
                    </div>
                </div>
            </form>
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                Lecture-Sheet
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="{{url('/admin/add/lecture-sheet')}}" style="color: #fff;">Add Information</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            @if(session()->has('success'))
                <script>
                 swal({
                    title: "Good job!",
                    text: "Your Lecture-Sheet uploads........",
                    icon: "success",
                    button: "Aww yiss!",
                  });
                </script>
               @endif

               @if(session()->has('delete'))
                   <script>
                     Swal.fire(
                      'Good job!',
                      'Your Lecture-Sheet delete........',
                      'success'
                    )
                   </script>

                  @endif

            <div class="table-responsive">
              <table class="table table-bordered dataTable"  width="100%">
                  <thead>
                      <tr role="row">
                          <th>Id</th>
                          <th>Title</th>
                          <th>Subject</th>
                          <th>Batch</th>
                          <th style="width:136px;">Manage</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($allsheet as $data)
                      <tr>
                          <td>{{$data->id}}</td>
                          <td>{{$data->title}}</td>
                          <td>{{$data->category}}</td>
                          @php
                            $lecturebatch = App\LectureBatch::where('lecture_id',$data->id)->get();
                          @endphp

                          <td>
                            @foreach($lecturebatch as $mamber)
                            {{isset($batches[$mamber->membershipe_id])?$batches[$mamber->membershipe_id]:''}}, <br>
                            @endforeach
                          </td>
                          <td>
                            <a href="{{url('/admin/view/lecture-sheet/'.$data->id)}}" class="btn btn-success" title="view"><i class="fas fa-plus"></i></a>
                            <a href="{{url('/admin/edit/lecture-sheet/'.$data->id)}}" class="btn btn-info" title="edit"><i class="fas fa-pencil-alt"></i></a>
                            <a href="{{url('/admin/delete/lecture-sheet/'.$data->id)}}" class="btn btn-danger" title="trash"><i class="fas fa-trash"></i></a>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
                {{  $allsheet ->links() }}
{{--                @if($allsheet instanceof Illuminate\Pagination\LengthAwarePaginator)--}}
{{--                    {{  $allsheet ->links() }}--}}
{{--                @endif--}}
            </div>
          </div>
          <div class="card-footer small text-muted">Updated</div>
        </div>

      </div>

    </div>
    <!-- /.content-wrapper -->

  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
@endsection
@section('admin_js')
<script type="text/javascript">
    $(document).ready(function () {
        // $('#subject').select2();
        // $('#batch').select2();
    });

</script>
@endsection
