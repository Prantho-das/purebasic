@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <i class="fas fa-users"></i>
                Paid Student List
              </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                  @if(session()->has('delete'))
                    <script>
                      Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Due student delete',
                        showConfirmButton: false,
                        timer: 1500
                          })
                    </script>
                    @endif
              <div class="table-responsive">
                <table class="table table-bordered" style="text-transform: capitalize;"  width="100%">
                    <thead>
                        <tr role="row">
                            <th>name</th>
                            <th>email</th>
                            <th>mobile</th>
                            <th>plan</th>
                            <th>payment</th>
                            <th>Taka</th>
                            <th>transaction</th>
                            <th>status</th>
                            <th style="width:138px;">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($paidmember as $data)
						@if($data->students !=Null)
                        <tr class="takbir">
							<td>{{$data->students->name}}</td>
                            <td>{{$data->students->email}}</td>
                            <td>{{$data->students->mobile}}</td>
                            <td>{{$data->membership->plan}}</td>
                            <td> {{$data->mar}}</td>
                            <td> {{$data->taka}}</td>
                            <td>{{$data->transaction}}</td>
                            @if($data->is_approve ==1)
                            <td style="color:green">Approved</td>
							@elseif($data->is_approve ==3)
							 <td style="color:green">Reject</td>
                            @else
                            <td style="color:red">Pendinng</td>
                            @endif

                            <td>
                              @if($data->is_approve ==0)
                              <a href="{{url('/admin/due/member/approve/'.$data->id)}}" class="btn btn-success" title="approve"><i class="fas fa-check"></i></a>
                              @endif
                              <a href="{{url('/admin/due/member/view/'.$data->id)}}" class="btn btn-info" title="view"><i class="fas fa-plus"></i></a>
                              <a href="{{url('/admin/due/member/delete/'.$data->id)}}" class="btn btn-danger" title="trash"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
						@endif
                        @endforeach
                    </tbody>
                </table>
              </div>
              </div>
            </div>
          </div>
          <div class="card-footer small text-muted"></div>
        </div>
      </div>
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
@endsection
