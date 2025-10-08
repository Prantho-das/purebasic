@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <i class="fas fa-users"></i>
                Notice-board.........
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="{{url('/admin/all/notic')}}" style="color: #fff;">All Notic</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered"  width="100%">
                <tr>
                  <th>Title</th>
                  <td>
                      {{$data->title}}
                  </td>
                </tr>

                <tr>
                  <th>Details</th>
                  <td>
                      {{$data->notic}}
                  </td>
                </tr>
                <tr>
                  <th>Time</th>
                  <td>{{$data->created_at}}</td>
                </tr>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated</div>
        </div>

      </div>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
@endsection
