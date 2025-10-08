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
                            <a href="{{url('/admin/help/add')}}" style="color: #fff;">Add Help</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    @if(session()->has('success'))
                        <script>
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Help Added!',
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
                                title: 'Help Updated!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        </script>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered durationTable" style="width: 98%">
                            <thead>
                            <tr role="row">
                                <th>Serial</th>
                                <th>Title</th>
                                <th>Details</th>
                                <th>Tutorial</th>
                                <th style="width:136px;">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allHelp as $data)
                                <tr>
                                    <td>{{$data->serial}}</td>
                                   <td>{{$data->title}}</td>
                                    <td>{{$data->details}}</td>
                                    <td>{{$data->is_tutorial == 1 ? "Yes" : "No"}}</td>
                                    <td align="center">
                                        <a href="{{url('/admin/help/update/'.$data->id)}}"
                                           class="btn btn-info" title="edit"><i class="fas fa-pencil-alt"></i></a>
                                    <!--                                     <a href="{{url('/admin/help/update/'.$data->id)}}" class="btn btn-danger" title="trash"><i class="fas fa-trash"></i></a>-->
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


