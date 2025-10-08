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
                            <strong class="card-title">All Video</strong>
                          </div>
                          <div class="col-md-2">
                                <a href="{{url('admin/add-video')}}" class="btn btn-primary"><i class="fa fa-plus"></i>  Add Video</a>
                          </div>
                        </div>
                    </div>
                    @if(session()->has('success'))
                    <script>
                    swal({
                      title: "Good job!",
                      text: "New Video uploads success....",
                      icon: "success",
                      });
                    </script>
                    @endif

                    @if(session()->has('delete'))
                    <script>
                    swal({
                      title: "Good job!",
                      text: "video permanent delete....",
                      icon: "success",
                      });
                    </script>
                    @endif
                    <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Video</th>
                                        <th>Subtile</th>
                                        <th>Time</th>
                                        <th style="width: 63px;">Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($allvideo as $data)
                                    <tr>
                                      <td>
                                        <img src="{{asset('uploads/video/'.$data->image)}}" style="width: 163px; height: 74px;">
                                        <a href="#"> {{str_limit($data->title,60)}}</a>
                                      </td>
                                      <td>{{str_limit($data->subtitle,50)}}</td>
                                      <td>{{$data->created_at}}</td>
                                      <td>
                                        <a href="{{url('/admin/view-video/'.$data->id)}}" title="Edit"><i class="fa fa-plus btn btn-primary"></i></a>
                                        <a href="{{url('/admin/delete-video/'.$data->id)}}" title="Delete"><i class="fa fa-trash btn btn-danger"></i></a>
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
