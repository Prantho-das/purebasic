@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <i class=""></i>
               News..
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="{{url('/admin/all/news')}}" style="color: #fff;">All News</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered"  width="100%">

                <tr>
                  <th>Title</th>
                  <td>{{$data->title}}</td>
                </tr>
                <tr>
                  <th>Details</th>
                  <td>{{$data->details}}</td>
                </tr>
                
                <tr>
                  <th>Links</th>
                  <td>{{$data->link}}</td>
                </tr>

                <tr>
                  <th>Photo</th>
                  <td>
                      <img src="{{asset('uploads/review/'.$data->photo)}}" style="width:100%">
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
