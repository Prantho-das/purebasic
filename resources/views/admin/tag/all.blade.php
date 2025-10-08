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
                            <strong class="card-title">All Tag</strong>
                          </div>
                          <div class="col-md-2">
                            <a href="{{url('admin/add/tag')}}" class="btn btn-primary"><i class="fa fa-plus"></i>      Add Tag</a>
                          </div>
                        </div>
                    </div>
                    @if(session()->has('success'))
                    <script>
                    swal({
                      title: "Good job!",
                      text: "Tag uploads success!",
                      icon: "success",
                      });
                    </script>
                    @endif
                    @if(session()->has('update'))
                    <script>
                    swal({
                      title: "Good job!",
                      text: "Tag update success!",
                      icon: "success",
                      });
                    </script>
                    @endif
                    @if(session()->has('delete'))
                    <script>
                    swal({
                      title: "Good job!",
                      text: "Tag delete success!",
                      icon: "success",
                      });
                    </script>
                    @endif

                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Tag Name</th>
                                    <th>Image</th>
                                    <th style="width: 160px;">Time</th>
                                    <th style="width: 100px;">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($alltag as $data)
                                <tr>
                                    <td style="padding: 0px 10px;">{{$data->name}}</td>
                                    <td style="padding: 0px 10px;">
                                      <img src="{{asset('uploads/tag/'.$data->image)}}" style="width: 80px;">
                                    </td>
                                    <td style="padding: 0px 10px;">{{$data->created_at}}</td>
                                    <td style="padding: 0px 10px;">
                                      <a href="{{url('admin/view/tag/'.$data->id)}}" title="edit"><i class="fa fa-pencil btn btn-primary"></i></a>
                                      <a href="{{url('admin/delete/tag/'.$data->id)}}" title="Delete"><i class="fa fa-trash btn btn-danger"></i></a>
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
