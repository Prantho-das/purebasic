@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                All Notice
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="{{url('/admin/add/notice')}}" style="color: #fff;">Add Notice</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered dataTable"  width="100%">
                  <thead>
                      <tr role="row">
                          <th>Name</th>
                          <th>Notice</th>
                          <th>Batch</th>
                          <th>Time</th>
                          <th style="width:136px;">Manage</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($notic as $data)
                      <tr>
                          <td>{{str_limit($data->name,30)}}</td>
                          <td>{{str_limit($data->notice,50)}}</td>
						  @php
						  $batchh=App\Membership::where('id',$data->batch_id)->first();
						  @endphp
						  @if($batchh)
                          <td>{{$batchh->plan}}</td>
						  @else
						  <td>Public</td>
						  @endif
                          <td>{{$data->created_at}}</td>
                          <td>
                            <a href="{{url('/admin/view/notice/'.$data->id)}}" class="btn btn-success" title="view"><i class="fas fa-plus"></i></a>
                            <a href="{{url('/admin/edit/notice/'.$data->id)}}" class="btn btn-info" title="edit"><i class="fas fa-pencil-alt"></i></a>
                            <a href="{{url('/admin/delete/notice/'.$data->id)}}" class="btn btn-danger" title="trash"><i class="fas fa-trash"></i></a>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated</div>
        </div>
      </div>
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
@endsection
