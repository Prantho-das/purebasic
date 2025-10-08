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
                            <strong class="card-title">Site Setting</strong>
                      </div>
                    </div>
                  </div>
                    @if(session()->has('success'))

                    @endif

                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    
                                    <th>site_title</th>
                                    <th>keyword</th>
                                    <th>description</th>
                                    <th>fav_icon</th>
                                    <th>site_logo</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($data as $data)
                                <tr>
                                   <td>{{$data->site_title}}</td>
                                   <td>{{$data->keyword}}</td>
                                    <td>{{$data->description}}</td>
                                    <td><img src="{{asset('uploads/setting/'.$data->fav_icon)}}" style="width:100%;height: 120px;"></td>
                                    <td><img src="{{asset('uploads/setting/'.$data->site_logo)}}" style="width:100%;height: 120px;"></td>
                                    <td>
                                      <a href="{{url('admin/site-setting/edit/'.$data->id)}}" title="Edit"><i class="fa fa-pencil btn btn-primary"></i></a>
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
