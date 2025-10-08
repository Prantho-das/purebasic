@extends('layouts.admin')
@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                              <strong class="card-title">All Post</strong>
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

                     @if(session()->has('update'))
                    <script>
                    swal({
                      title: "Good job!",
                      text: "This post updated",
                      icon: "success",
                      });
                    </script>
                    @endif


                     @if(session()->has('delete'))
                    <script>
                    swal({
                      title: "Good job!",
                      text: "This post deleted",
                      icon: "success",
                      });
                    </script>
                    @endif

                     @if(session()->has('change'))
                    <script>
                    swal({
                      title: "Good job!",
                      text: "Post Status Change",
                      icon: "success",
                      });
                    </script>
                    @endif
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <!--<th>User</th>-->
                                    <th>Post</th>
                                    <th>Status</th>
                                    <th>Change</th>
                                    <th>Time</th>
                                    <th width="96px;">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($sera as $data)
                                <tr>
                                 
                                    <td>
                                        <img src="{{asset('post/'.$data->image)}}" style="width: 75px;height: 32px;">
                                      {{str_limit($data->title,30)}}
                                    </td>
                                    <td>
                                      @if($data->is_approve == 1)
                                          <span class="btn btn-success">Approve</span>
                                        @else
                                          <span class="btn btn-danger">Panding</span>
                                        @endif
                                    </td>
                                    <td>@if($data->is_approve ==0)
                                      <a href="{{url('admin/sera/post/approve/'.$data->id)}}" class="fa fa-check btn btn-primary">Change Status</a>
                                      @else
                                      <a href="{{url('admin/sera/post/panding/'.$data->id)}}" class="fa fa-times btn btn-danger">Change Status</a>
                                      @endif
                                    </td>
                                    <td>{{$data->created_at}}</td>
                                    <td>
                                      <a href="{{url('admin/sera/post/view/'.$data->id)}}" title="View"><i class="fa fa-plus btn btn-primary"></i></a>
                                      <a href="{{url('admin/sera/post/edit/'.$data->id)}}" title="Edit"><i class="fa fa-pencil btn btn-primary"></i></a>
                                      <a href="{{url('admin/sera/post/delete/'.$data->id)}}" title="Delete"><i class="fa fa-trash btn btn-danger"></i></a>
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
