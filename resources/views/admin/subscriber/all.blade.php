@extends('layouts.admin')
@section('content')

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">All Subscriber</strong>
                    </div>
                    @if(session()->has('success'))
                    <script>
                    swal({
                      title: "Good job!",
                      text: "Category insert success!",
                      icon: "success",
                      });
                    </script>
                    @endif

                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Time</th>
                                    <th style="width: 75px;">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($allsubscriber as $data)
                                <tr>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->phone}}</td>
                                    <td>
                                        <img src="">
                                    </td>
                                    <td>
                                        @if($data->is_approve  != 0)
                                            <button class="btn btn-primary">Active</button>
                                        @else
                                            <button class="btn btn-danger">Disible</button>
                                        @endif
                                    </td>
                                    <td>{{$data->created_at}}</td>
                                    <td>
                                      <a href="#" title="Edit"><i class="fa fa-plus btn btn-primary"></i></a>
                                      <a href="#" title="Delete"><i class="fa fa-trash btn btn-danger"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->


</div><!-- /#right-panel -->

<!-- Right Panel -->
    @endsection
