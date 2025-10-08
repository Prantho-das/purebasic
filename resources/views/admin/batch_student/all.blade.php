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
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="{{route('batch_student.create')}}" style="color: #fff;">Add Batch Tree</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered dataTable"  width="100%">
                  <thead>
                      <tr role="row">
                          <th>Student</th>
                          <th>Batch</th>
						  <th>Fees</th>
						  <th>Payable</th>
						  <th>Due</th>
                          <th>Subs. Remaining</th>
                          <th>Enroll Status</th>
                          <th style="width:136px;">Manage</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($items as $value)
                      <tr>
                          <td>{{$value->student->name??''}}</td>
                          <td>{{$value->course->plan??''}}</td>
						  <td>{{$value->fees}}</td>
						  <td>{{$value->payable}}</td>
						  <td>{{$value->payable - $value->paid}}</td>
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
                              {{'blocked'}}
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
                            <a href="{{route('student_info.edit',$value->id)}}" class="btn btn-info" title="edit">Details</i></a>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
          </div>
            <div class="card-footer small text-muted">
                {{ $items->links() }}
            </div>
        </div>
      </div>
    </div>

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
@endsection
