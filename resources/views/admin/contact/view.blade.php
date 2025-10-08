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
                    <li><a href="{{url('/admin/all/contact')}}">All- Message</a></li>
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
                        <strong class="card-title">Contact Message</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">

                            <tr>
                              <th>Name : </th>
                              <td>{{$data->name}}</td>
                            </tr>
                            <tr>
                              <th>Email : </th>
                              <td>{{$data->email}}</td>
                            </tr>
                            <tr>
                              <th>Phone : </th>
                              <td>{{$data->phone}}</td>
                            </tr>
                            <tr>
                              <th>Subject : </th>
                              <td>{{$data->subject}}</td>
                            </tr>
                            <tr>
                              <th>Message : </th>
                              <td>
                                {{$data->message}}
                              </td>
                            </tr>
                            <tr>
                              <th>Time : </th>
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
