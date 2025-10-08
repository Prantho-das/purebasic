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
                    <li><a href="{{url('/admin/allmessage')}}">All Message</a></li>
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
                        <strong class="card-title">View Message</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <tr>
                              <th>Name</th>
                              <td>:</td>
                              <td>{{$data->conus_name}}</td>
                            </tr>
                            <tr>
                              <th>Email</th>
                              <td>:</td>
                              <td>{{$data->conus_email}}</td>
                            </tr>
                            <tr>
                              <th>Number</th>
                              <td>:</td>
                              <td>{{$data->conus_number}}</td>
                            </tr>
                            <tr>
                              <th>Company</th>
                              <td>:</td>
                              <td>{{$data->conus_company}}</td>
                            </tr>
                            <tr>
                              <th>Subject</th>
                              <td>:</td>
                              <td>{{$data->conus_subject}}</td>
                            </tr>
                            <tr>
                              <th>Message</th>
                              <td>:</td>
                              <td>{{$data->conus_message}}</td>
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
