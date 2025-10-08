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
                              <strong class="card-title">All Post</strong>
                        </div>

                        <div class="col-md-2">
                              <a href="{{url('admin/post/create')}}" class="btn btn-success" style="margin-left: 61px; border-radius: 8px;"> Add Post</a>
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
                                    <!--<th>User</th>-->
                                    <th>Id</th>
                                    <th>Post</th>
                                    <th>View</th>
                                    <th>Writer</th>
                                    <th>Time</th>
                                    <th width="180px" class="text:center">Status</th>
                                    <th width="120px">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($allpost as $key=>$data)
                                <tr>
                                  <td>{{$key+1}}</td>
                                    <td>
                                        <img src="{{asset('post/'.$data->image)}}" style="width: 75px;height: 32px;">
                                        <a href="{{url('admin/post/'.$data->id)}}">{{str_limit($data->title,30)}}</a>
                                    </td>
                                    <td><i class="fa fa-eye"></i> {{$data->view_count}}</td>
                                    @if($data->user_id !=NULL)
                                    <td>{{$data->user->name}}</td>
                                    @endif
                                    <td>{{$data->created_at}}</td>
                                    <td>
                                      @if($data->is_apporve == 1)
                                          <span class="btn btn-success">Approve</span>
                                        @else
                                          <span class="btn btn-danger">Panding</span>
                                        @endif

                                        @if($data->is_apporve ==1)
                                      <a href="{{url('admin/post/panding/'.$data->id)}}" class="fa fa-check btn btn-primary">Change Status</a>
                                      @else
                                      <a href="{{url('admin/post/approve/'.$data->id)}}" class="fa fa-times btn btn-danger">Change Status</a>
                                      @endif

                                    </td>


                                    <td>

                                      <div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: #605ca8; padding: 3px 32px; font-size: 12px;">
                                        Action
                                      </button>
                                      <div class="dropdown-menu takbiraa" aria-labelledby="dropdownMenuButton">
                                        <a href="{{url('admin/post/'.$data->id)}}" title="View" class="dropdown-item"><i class="fa fa-plus"></i>  View</a>
                                        <a href="{{url('admin/post/1/edit')}}" title="Edit" class="dropdown-item"><i class="fa fa-pencil"></i>  Edit</a>
                                        <a href="{{url('admin/delete/post/'.$data->id)}}" title="Delete" class="dropdown-item"><i class="fa fa-trash"></i>  Delete</a>
                                      </div>
                                    </div>
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
