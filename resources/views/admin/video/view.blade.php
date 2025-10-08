@extends('layouts.admin')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-12">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="{{url('/admin/')}}">Dashboard</a></li>
                    <li><a href="{{url('/admin/all-video')}}">All Video</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">View Video</strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <tr>
                              <th>Image</th>
                              <td>:</td>
                              <td><img src="{{asset('uploads/video/'.$data->image)}}" style="width: 32%;height: 30%;"></td>
                            </tr>
                            <tr>
                              <th>Video</th>
                              <td>:</td>
                              <td>{!! $data->video !!}</td>
                            </tr>
                            <tr>
                              <th>Time</th>
                              <td>:</td>
                              <td>{{$data->created_at}}</td>
                            </tr>

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
