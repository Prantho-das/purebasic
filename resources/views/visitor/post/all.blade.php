@extends('layouts.visitor')
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
                        @php
                          $id = Session:: get('id');
                          $visitor = App\Visitor:: where('id',$id)->first();

                        @endphp
                        <div class="col-md-2">
                            <a href="{{url('/user/add-post/'.$visitor->id)}}" class="btn btn-primary"><i class="fa fa-plus" style="margin-right:10px;"></i>Add Post</a>
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

                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Post</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Time</th>
                                    <th style="width:100px">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($allpost as $data)
                                <tr>
                                    <td>
                                      <img src="{{asset('post/'.$data->image)}}" style="width: 75px;height: 32px;">
                                      {{str_limit($data->title,30)}}
                                    </td>
                                    <td>
                                      {{$data->categorys->name}}
                                    </td>
                                    <td>
                                      @if($data->is_approve == 1)
                                          <span class="btn btn-success">Approve</span>
                                        @else
                                          <span class="btn btn-danger">Panding</span>
                                        @endif
                                    </td>

                                    <td>{{$data->created_at}}</td>
                                    <td>
                                      <a href="{{url('/user/view-post/'.$data->id)}}" title="View"><i class="fa fa-plus btn btn-primary"></i></a>
                                      <a href="{{url('/user/edit-post/'.$data->id)}}" title="Edit"><i class="fa fa-pencil btn btn-success"></i></a>
                                      <a href="{{url('/user/delete-post/'.$data->id)}}" title="Delete"><i class="fa fa-trash btn btn-danger"></i></a>
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
