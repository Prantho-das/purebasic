@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                Admission Batch
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="{{url('/admin/addmition/batch/add')}}" style="color: #fff;">Add Batch</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-md-4">
                <form method="GET" action="{{ url('/admin/addmition/batch') }}">
                  <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by batch name..." value="{{ request('search') }}">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit">Search</button>
                      @if(request('search'))
                        <a href="{{ url('/admin/addmition/batch') }}" class="btn btn-secondary">Clear</a>
                      @endif
                    </div>
                  </div>
                </form>
              </div>
            </div>
            @if(session()->has('success'))
              <script>
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Batch Created',
                  showConfirmButton: false,
                  timer: 1500
                    })
              </script>
              @endif

               @if(session()->has('update'))
              <script>
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Batch Updateed',
                  showConfirmButton: false,
                  timer: 1500
                    })
              </script>
              @endif

              @if(session()->has('delete'))
              <script>
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Batch Delete',
                  showConfirmButton: false,
                  timer: 1500
                    })
              </script>
              @endif

            <div class="table-responsive">
              <table class="table table-bordered" width="100%">
                  <thead>
                      <tr role="row">
                          <th>Name</th>
                          <th>Type</th>
						  <th>Graduation</th>
						  <th>Duration</th>
						  <th>Taka</th>
                          <th>Time</th>
                          <th style="width:136px;">Manage</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($allbatch as $data)
                      <tr>

                          <td>{{$data->plan}}</td>
                          <td>{{$data->type}}</td>
						  <td>{{$data->graduation}}</td>
						  <td>{{$data->duration}}</td>
						  <td>{{$data->ammount}}</td>
                          <td>{{$data->created_at}}</td>
                          <td>
                            <a href="{{url('/admin/addmition/batch/edit/'.$data->id)}}" class="btn btn-info" title="edit"><i class="fas fa-pencil-alt"></i></a>
                           <!-- <a href="{{url('/admin/addmition/batch/delete/'.$data->id)}}" class="btn btn-danger" title="trash"><i class="fas fa-trash"></i></a>  -->
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
            <div class="mt-3">
                {{ $allbatch->links() }}
            </div>
          </div>
          <div class="card-footer small text-muted">
              Showing {{ $allbatch->firstItem() }}–{{ $allbatch->lastItem() }} of {{ $allbatch->total() }} batches
          </div>
        </div>
      </div>
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
@endsection
