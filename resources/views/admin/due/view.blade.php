@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <i class="fas fa-users"></i>
                      Student Information                
                      </div>
                <div class="col-md-2">
                    <div class="page-title">
                          <a href="{{url('admin/paid/member')}}" class="btn btn-primary"><i class="fa fa-plus"></i>  All Student</a>
                      </div>
                </div>
            </div>
          </div>
         <div class="col-md-12">
              <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered dataTable">
                <tr>
                  <th style="width:30%">Name :</th>
                  <td style="width:70%">{{$data->students->name}}</td>
                </tr>
                <tr>
                  <th>Name :</th>
                  <td>{{$data->students->email}}</td>
                </tr><tr>
                  <th>Phone Number :</th>
                  <td>{{$data->students->mobile}}</td>
                </tr><tr>
                  <th>Gender :</th>
                  <td>{{$data->students->gender}}</td>
                </tr>
                
                <tr>
                  <th>Date of Birth :</th>
                  <td>{{$data->students->birth}}</td>
                </tr><tr>
                  <th>Position :</th>
                  <td>{{$data->students->position}}</td>
                </tr><tr>
                  <th>BMDC ( Permanant / Temporaray ) ( If Doctor ) :</th>
                  <td>{{$data->students->BMDC}}</td>
                </tr>
                <tr>
                  <th>Graduate level ( If Student ) :</th>
                  <td>{{$data->students->levell}}</td>
                </tr>
                <tr>
                  <th>Medical / Dental college :</th>
                  <td>{{$data->students->medical}}</td>
                </tr>
                <tr>
                  <th>Medical / Dental College Batch :</th>
                  <td>{{$data->students->batch}}</td>
                </tr>
                <tr>
                  <th>Session :</th>
                  <td>{{$data->students->sessionn}}</td>
                </tr>
                
                <tr>
                  <th>Admission Batch :</th>
                  <td>{{$data->membership->plan}}</td>
                </tr>
                
                <tr>
                  <th>Facebook Id :</th>
                  <td>{{$data->students->fb}}</td>
                </tr>

                <tr>
                  <th>Address :</th>
                  <td>{{$data->students->address}}</td>
                </tr>
                <tr>
                  <th>Time</th>
                  <td>{{$data->created_at}}</td>
                </tr>
              </table>
            </div>
          </div>
         </div>
          <div class="card-footer small text-muted">Purebasic.com</div>
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
