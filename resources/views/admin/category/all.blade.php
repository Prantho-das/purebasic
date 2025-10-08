@extends('layouts.admin')
@section('content')

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                        <strong class="card-title">All Category</strong>
                                
                            </div>
                            <div class="col-md-2">
                                <a href="{{url('admin/category/create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>      Add Category</a>
                            </div>
                        </div>
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

                    @if(session()->has('update'))
                    <script>
                    swal({
                      title: "Good job!",
                      text: "Category update success!",
                      icon: "success",
                      });
                    </script>
                    @endif

                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Category Name</th>
                                    <th>Time</th>
                                    <th style="width: 75px;">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($allcat as $data)
                                <tr>
                                    <td style="padding: 0px 10px;">{{$data->name}}</td>
                                    <td style="padding: 0px 10px;">{{$data->created_at}}</td>
                                    <td style="padding: 0px 10px;">
                                      <a href="{{url('admin/category/edit/'.$data->id)}}" title="edit"><i class="fa fa-pencil btn btn-primary"></i></a>
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
