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
                              <strong class="card-title">All Job</strong>
                        </div>
                      </div>
                    </div>


                    @if(session()->has('success'))
                    <script>
                    swal({
                      title: "Good job!",
                      text: "Contact Messge Delete Success",
                      icon: "success",
                      });
                    </script>
                    @endif

                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <!--<th>User</th>-->
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Time</th>
                                    <th width="120px">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($allcontact as $data)
                                <tr>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->phone}}</td>
                                    <td>{{$data->subject}}</td>
                                    <td>{{str_limit($data->message,50)}}</td>
                                    <td>{{$data->created_at}}</td>
                                    <td>
                                      <div class="dropdown">
                                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: #605ca8; padding: 3px 32px; font-size: 12px;">
                                        Action
                                      </button>
                                      <div class="dropdown-menu takbiraa" aria-labelledby="dropdownMenuButton">
                                        <a href="{{url('admin/view/contact/'.$data->id)}}" title="View" class="dropdown-item"><i class="fa fa-plus"></i>  View</a>
                                        <a href="{{url('admin/delete/contact/'.$data->id)}}" title="Delete" class="dropdown-item"><i class="fa fa-trash"></i>  Delete</a>
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
