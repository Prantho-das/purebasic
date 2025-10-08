@extends('layouts.admin')
@section('content')

    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            Batch Duration & Fees
                        </div>
                        <div class="col-md-2 align-right btn btn-primary">
                            <i class="fas fa-plus"></i>
                            <a href="{{route('add.duration')}}" style="color: #fff;">Add Batch Duration</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    @if(session()->has('success'))
                        <script>
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Batch Duration Created',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        </script>
                    @endif

                    @if(session()->has('update'))
                        <script>
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Batch Duration Updateed',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        </script>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered durationTable yajra-datatable" style="width: 98%">
                            <thead>
                            <tr role="row">
                                <th>ID</th>
                                <th>Batch Name</th>
                                <th>Batch Duration</th>
                                <th>Fees</th>
                                <th>Information</th>
                                <th style="width:136px;">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allBatchDuration as $data)
                                <tr>
                                    <td>{{$data->bd_id}}</td>
                                    <td>{{$data->plan}}</td>
                                    <td>{{$data->bd_duration}} Days</td>
                                    <td>{{$data->bd_fee}} Taka</td>
                                    <td>{{$data->information}}</td>
                                    <td align="center">
                                        <a href="{{url('/admin/admission/editbatchduration/'.$data->bd_id)}}"
                                           class="btn btn-info" title="edit"><i class="fas fa-pencil-alt"></i></a>
                                    <!--                                     <a href="{{url('/admin/addmition/batch/delete/'.$data->bd_id)}}" class="btn btn-danger" title="trash"><i class="fas fa-trash"></i></a>-->
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
    </div>


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


