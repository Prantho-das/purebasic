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
                            <strong class="card-title">Social link Change</strong>
                      </div>
                    </div>
                  </div>
                    @if(session()->has('success'))

                    @endif

                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    
                                    <th>address</th>
                                    <th>email</th>
                                    <th>phone</th>
                                    <th>copyright</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($data as $data)
                                <tr>
                                   <td>{{$data->address}}</td>
                                   <td>{{$data->email}}</td>
                                    <td>{{$data->phone}}</td>
                                    <td>{{$data->copyright}}</td>
                                    
                                    <td>
                                      <a href="{{url('admin/edit/adrreess/'.$data->id)}}" title="Edit"><i class="fa fa-pencil btn btn-primary"></i></a>
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
