@extends('layouts.admin')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            {{$batchName}}
                        </div>
                        

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
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Reference</th>
                                <th>Subs. Remaining</th>
                                <th>Information</th>
                                <th style="width:136px;">Manage</th>
                            </tr>
                            </thead>

                                              <tbody>
                                              @foreach($items as $value)
                                              
                                                  @php
                                                    $due = $value->payable - $value->paid;
                                                  @endphp
                                                  <tr style="background: {{$due != 0 ? 'red' : ''}}; color: {{$due != 0 ? 'white' : ''}}">
                                                      <td>{{$value->student->id??''}}</td>
                                                      <td>{{$value->student->name??''}}</td>
                                                      <td>{{$value->student->mobile??''}}</td>
                                                      <td>{{$value->student->address??''}}</td>
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
                                                      <td>{{$value->information??''}}</td>
                                                      <td>
                                                            @if ( $value->student)
                                                                <a href="{{'/admin/updateInformation/user/' . $value->student->id . '/batch/' . $batchId . '/batchSubscription/' . $value->id}}" class="btn btn-info" title="edit">Update</a>
                                                            @endif
                                                      </td>
                                                  </tr>
                                              @endforeach
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
                }
            );
        });


    </script>
@endsection
