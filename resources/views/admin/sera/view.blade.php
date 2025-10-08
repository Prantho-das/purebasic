@extends('layouts.admin')
@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="{{url('/admin/')}}">Dashboard</a></li>
                    <li><a href="{{url('/admin/post')}}">All- Post</a></li>
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
                       <div class="row">
                         <div class="col-md-10">
                            <strong class="card-title">View Post</strong>
                         </div>
                         @php
                            $id = Session:: get('id');
                          @endphp
                         <div class="col-md-2">
                            <a href="{{url('/user/all-post/'.$id)}}" class="btn btn-primary"><i class="fa fa-book" style="margin-right:10px;"></i>All Post</a>
                         </div>
                       </div>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <tr>
                              <th>Title</th>
                              <td>:</td>
                              <td>{{$data->title}}</td>
                            </tr>
                            <tr>
                              <th>Category</th>
                              <td>:</td>
                              <td>{{$data->categorys->name}}</td>
                            </tr>
                            <tr>
                              <th>Description</th>
                              <td>:</td>
                              <td>{!! $data->description !!}</td>
                            </tr>
                            <tr>
                              <th>Status</th>
                              <td>:</td>
                              <td>
                                @if($data->is_apporve == 1)
                                    <span class="btn btn-success">Approve</span>
                                  @else
                                    <span class="btn btn-danger">Panding</span>
                                  @endif
                              </td>
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
@endsection
