@extends('layouts.admin')
@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                              <strong class="card-title">All Post</strong>
                        </div>
                        <div class="col-md-3">
                            <a href="{{url('admin/post/create')}}" class="btn btn-primary"><i class="fa fa-plus" style="margin-right:10px;"></i>Add Post</a>

                            <a href="{{url('admin/post')}}" class="btn btn-primary"><i class="fa fa-plus" style="margin-right:10px;"></i>All Post</a>
                        </div>
                      </div>
                    </div>


                    @if(session()->has('success'))
                    <script>
                    swal({
                      title: "Good job!",
                      text: "New post insert success!",
                      icon: "success",
                      });
                    </script>
                    @endif

                    @if(session()->has('delete'))
                    <script>
                    swal({
                      title: "Good job!",
                      text: "Post delete complate!",
                      icon: "success",
                      });
                    </script>
                    @endif

                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Title</th>
                                    <th>View</th>
                                    <th>Status</th>
                                    <th>Change</th>
                                    <th>Image</th>
                                    <th>Time</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($allpost as $data)
                                <tr>
                                  @if($data->user_id !=NULL)
                                    <td>{{$data->user->name}}</td>
                                  @else
                                  <td>{{$data->visitor->name}}</td>
                                  @endif
                                    <td>{{str_limit($data->title,30)}}</td>
                                    <td>{{$data->view_count}}</td>
                                    <td>
                                      @if($data->is_apporve == 1)
                                          <span class="btn btn-success">Approve</span>
                                        @else
                                          <span class="btn btn-danger">Panding</span>
                                        @endif
                                    </td>
                                    <td>@if($data->is_apporve ==1)
                                      <a href="{{url('admin/post/panding/'.$data->id)}}" class="fa fa-check btn btn-primary">Change Status</a>
                                      @else
                                      <a href="{{url('admin/post/approve/'.$data->id)}}" class="fa fa-times btn btn-danger">Change Status</a>
                                      @endif
                                    </td>
                                    <td>
                                        <img src="{{asset('post/'.$data->image)}}" style="width: 75px;height: 32px;">
                                    </td>
                                    <td>{{$data->created_at}}</td>
                                    <td>
                                      <a href="{{url('admin/post/'.$data->id)}}" title="View"><i class="fa fa-plus btn btn-primary"></i></a>
                                      <a href="{{url('admin/post/1/edit')}}" title="Edit"><i class="fa fa-pencil btn btn-primary"></i></a>
                                      <a href="{{url('admin/delete/post/'.$data->id)}}" title="Delete"><i class="fa fa-trash btn btn-danger"></i></a>
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
