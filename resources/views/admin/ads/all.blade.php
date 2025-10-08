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
                            <strong class="card-title">All Ads</strong>
                      </div>
                      <div class="col-md-2">
                        <a href=""></a>
                      </div>
                    </div>
                  </div>
                    @if(session()->has('success'))
                    <script>
                    swal({
                      title: "Good job!",
                      text: "This Ads Publish Your Website",
                      icon: "success",
                      });
                    </script>
                    @endif

                    @if(session()->has('off'))
                    <script>
                    swal({
                      title: "Good job!",
                      text: "This Ads Now Off",
                      icon: "error",
                      });
                    </script>
                    @endif

                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Ads</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>City</th>
                                    <th>Payment</th>
                                    <th>Transaction Id</th>
                                    <th>Time</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($ads as $data)
                                <tr>
                                    <td>
                                      <img src="{{asset('uploads/gallery/'.$data->image)}}" style="width: 75px;height: 32px;">
                                      <a href="#">{{$data->name}}</a>
                                    </td>
                                    <td>{{$data->email}}</td>
                                    <td>{{$data->phone}}</td>
                                    <td>{{$data->city}}</td>
                                    <td>{{$data->payment}}</td>
                                    <td>{{$data->transaction}}</td>
                                    <td>{{$data->created_at}}</td>
                                    
                                    <td>
                                     <!-- <a href="{{url('admin/view/ads/'.$data->id)}}" title="view"><i class="fa fa-view btn btn-success"></i></a> -->
                                     @if($data->is_approve ==0)
                                      <a href="{{url('admin/ads-edit/'.$data->id)}}" title="on"><i class="fa fa-toggle-on btn btn-primary"></i></a>
                                      @else
                                      <a href="{{url('admin/ads-off/'.$data->id)}}" title="off"><i class="fa fa-toggle-off btn btn-danger"></i></a>
                                      @endif
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
