@extends('layouts.admin')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            Admission Batch
                        </div>
                        {{--              <div class="col-md-2 align-right btn btn-primary">--}}
                        {{--                <i class="fas fa-plus"></i>--}}
                        {{--                <a href="{{route('batch_student.create')}}" style="color: #fff;">Add Batch</a>--}}
                        {{--              </div>--}}
                        <form action="{{route('data-enroll')}}" method="post" enctype="multipart/form-data"
                              class="col-md-12">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="batch_id">Filter by Batch:</label>
                                    <select name="batch_id" class="col-md-3 form-control-sm">
                                        <option value="">{{ 'Select' }}</option>
                                        @foreach($batchData as $aBatchData)
                                        <option value="{{$aBatchData->id}}">{{$aBatchData->plan}}</option>
                                        @endforeach
                                    </select>


                                    <label for="enroll_id" style="padding-left: 30px">Filter by Enroll Status:</label>
                                    <select name="enroll_id" class="col-md-3 form-control-sm">
                                        <option value="">{{ 'select' }}</option>
                                        <option value="0">Pending</option>
                                        <option value="1">Approved</option>
                                        <option value="2">Deactivated</option>
                                    </select>

                                    <button type="submit" class="btn btn-primary btn-sm form-control col-md-2">
                                        <i class="fa fa-dot-circle-o"></i> Submit
                                    </button>


                                </div>
                            </div>

                        </form>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered yajra-datatable" width="100%">
                            <thead>
                            <tr role="row">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Batch</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Reference</th>
                                <th>Subs. Remaining</th>
                                <th>Enroll Status</th>
                                <th style="width:136px;">Manage</th>
                            </tr>
                            </thead>

                                              <tbody>
                                              @if($showReport != 0)
                                              @foreach($items as $value)
                                              
                                                  @php
                                                    $due = $value->payable - $value->paid;
                                                  @endphp
                                                  <tr style="background: {{$due != 0 ? 'red' : ''}}; color: {{$due != 0 ? 'white' : ''}}">
                                                      <td>{{$value->student->id??''}}</td>
                                                      <td>{{$value->student->name??''}}</td>
                                                      <td>{{$value->student->mobile??''}}</td>
                                                      <td>{{$value->student->address??''}}</td>
                                                      <td>{{$value->course->plan??''}}</td>
                                                      <td>{{$value->paid}}</td>
                                                      <td style="font-weight: {{$due != 0 ? 'bold' : ''}}">{{$due}}</td>
                                                      <td>{{$value->reference}}</td>
                                                      <td>
                                                          @if($value->subscription_end==null)
                                                              {{'-'}}
                                                          @elseif($value->subscription_end<date('Y-m-d H:i:S'))
                                                              {{'Subscription Over'}}
                                                          @else
                                                              <?php
                                                              $startDate = date_create(date('Y-m-d'));
                                                              $endDate = date_create(date('Y-m-d',strtotime($value->subscription_end)));
                                                              $interval = date_diff($startDate, $endDate);
                                                              $days = $interval->format('%a');
                                                              ?>
                                                              {{ $days.' Days' }}
                                                          @endif
                                                      </td>
                                                      <td>
                                                          @if($value->enroll_status ==0)
                                                              {{'Pending'}}
                                                          @elseif($value->enroll_status ==1)
                                                              {{'Approved'}}
                                                          @else
                                                              {{'Deactivated'}}
                                                          @endif
                                                      </td>
                                                      <td>
                                                          @if($value->enroll_status ==0)

                                                              <a href="{{route('batch_student_approve',$value->id)}}"
                                                                 class="btn btn-success" title="approve"><i
                                                                      class="fas fa-check"></i></a>

                                                              <a href="{{route('batch_student_reject',$value->id)}}"
                                                                 class="btn btn-warning" title="Reject"><i
                                                                      class="fas fa-minus"></i></a>

                                                          @endif

                                                          @if($value->enroll_status ==2)

                                                              <a href="{{route('batch_student_activate',$value->id)}}"
                                                                 class="btn btn-success" title="Activate"><i
                                                                      class="fas fa-trash-restore-alt"></i></a>
                                                          @else
                                                              <a href="{{route('batch_student_deactivate',$value->id)}}"
                                                                 class="btn btn-close" title="Deactivate"><i
                                                                      class="fas fa-trash"></i></a>
                                                          @endif


                                                            @if ( $value->student)
                                                                <a href="{{'/admin/student_info/' . $value->student->id}}" class="btn btn-info" title="edit">Details</a>
                                                            @endif
                                                      </td>
                                                  </tr>
                                              @endforeach
                                              @endif
                                              </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

@endsection
@section('admin_js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.yajra-datatable').dataTable(
                {
                    ordering: false,
                    pageLength: 100,
                    buttons: ['csv'],
                    serverSide: false,
                }
            );
        });

        {{--$(function () {--}}

        {{--    var table = $('.yajra-datatable').DataTable({--}}
        {{--        processing: true,--}}
        {{--        serverSide: true,--}}
        {{--        ajax: "{{route('batch_student_ajax')}}",--}}
        {{--        columns: [--}}
        {{--            {data: 'DT_RowIndex', name: 'DT_RowIndex'},--}}
        {{--            {data: 'name', name: 'name.name'},--}}
        {{--            {data: 'batch', name: 'course.plan'},--}}
        {{--            {data: 'fees', name: 'fees'},--}}
        {{--            {data: 'payable', name: 'payable'},--}}
        {{--            {data: 'due', name: 'due'},--}}
        {{--            {data: 'phone', name: 'student.mobile'},--}}
        {{--            {data: 'dob', name: 'dob'},--}}
        {{--            {--}}
        {{--                data: 'action',--}}
        {{--                name: 'action',--}}
        {{--                orderable: true,--}}
        {{--                searchable: true--}}
        {{--            },--}}
        {{--        ]--}}
        {{--    });--}}

        {{--});--}}
    </script>
@endsection
