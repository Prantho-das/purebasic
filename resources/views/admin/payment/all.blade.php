@extends('layouts.admin')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            Payment Transaction List
                        </div>

                        <form action="{{route('payment_data_load')}}" method="post" enctype="multipart/form-data"
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
                                    <select name="app_status" class="col-md-3 form-control-sm">
                                        <option value="">{{ 'select' }}</option>
                                        <option value="0">Pending</option>
                                        <option value="1">Approved</option>
                                        <option value="2">Rejected</option>
                                    </select>

                                    <button type="submit" class="btn btn-primary btn-sm form-control col-md-2">
                                        <i class="fa fa-dot-circle-o"></i> Submit
                                    </button>

                                </div>
                            </div>

                        </form>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered yajra-datatable"
                                           style="text-transform: capitalize;"
                                           width="100%">
                                        <thead>
                                        <tr role="row">
                                            <th>Date</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>Due</th>
                                            <th>Batchpackage</th>
                                            <th>Paid</th>
                                            <th>Plan</th>
                                            <th>Subscription</th>
                                            <th>payment</th>
                                            <th>Taka</th>
                                            <th>transaction</th>
                                            <th>status</th>
                                            <th>Manage</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($showReport != 0 && count($paidmember) > 0)
                                        @foreach($paidmember as $data)
                                            @if($data->id)
                                                <tr class="takbir">
                                                    <td>{{date("d, F, Y", strtotime($data->created_at))}}</td>
                                                    <td>{{$data->student_id}}</td>
                                                    <td>{{$data->name}}</td>
                                                    
                                                    <td style="text-transform: lowercase;">{{$data->mobile}}</td>
                                                    <td>{{$data->address}}</td>
                                                    <td>{{$data->payable - $data->paid}}</td>
                                                    <td>{{$data->payable}}</td>
                                                    <td>{{$data->paid}}</td>
                                                    <td>{{$data->plan??'-'}}</td>
                                                    <td>{{$data->bd_duration ??'-'}} Days</td>
                                                    <td> {{$data->mar}}</td>
                                                    <td> {{$data->amount??'-'}}</td>
                                                    <td>{{$data->transaction}}</td>
                                                    @if($data->is_approve ==1)
                                                        <td style="color:green">Approved</td>
                                                    @elseif($data->is_approve ==2)
                                                        <td style="color:red">Rejected</td>
                                                    @else
                                                        <td style="color:red">Pending</td>
                                                    @endif

                                                    <td>
                                                        @if($data->is_approve ==0)

                                                            <a href="{{route('payment_approval',$data->id)}}"
                                                               class="btn btn-success" title="approve"><i
                                                                    class="fas fa-check"></i></a>

                                                            <a href="{{route('payment_reject',$data->id)}}"
                                                               class="btn btn-warning" title="Reject"><i
                                                                    class="fas fa-minus"></i></a>

                                                        @endif
                                                        <form method="post"
                                                              action="{{route('payment.destroy',$data->id)}}">
                                                            @csrf
                                                            @method('delete')
                                                            <button
                                                                type="submit" onclick="return confirm('Are you sure?')"
                                                                class="btn btn-dange" title="Delete"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                    <div class="card-footer small text-muted">--}}
                    {{--                        {{ $paidmember->links() }}--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script>
        function showDeleteConfirm() {
            var ask = confirm("Do you want to delete?");
            if (ask) {
                console.log('Click YES');
                window.location.replace("{{route('payment.destroy',$data->id)}}");
            } else {
                console.log('Click NO');
                window.location.replace("{{url('admin/payment')}}");

            }

        }
    </script>
    @endif
@endsection

@section('admin_js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.yajra-datatable').dataTable(
                {
                    ordering: false,
                }
            );
        });
    </script>

@endsection
