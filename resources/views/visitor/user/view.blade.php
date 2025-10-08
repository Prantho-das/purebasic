@extends('layouts.visitor')
@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-3"></div>
              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header">
                          <strong class="card-title mb-3">Profile</strong>
                      </div>
                      <div class="card-body">
                              <img class="rounded-circle mx-auto d-block" src="{{asset('uploads/user/'.$view->image)}}" alt="Card image cap">
                              <h5 style="text-transform: capitalize;" class="text-sm-center mt-2 mb-1">{{$view->fullname}}</h5>

                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-md-12">
                              <table class="single_user_table table">
                                <tr>
                                  <th class="text-right">Name</th>
                                  <td>:</td>
                                  <td>{{$view->name}}</td>
                                </tr>
                                <tr>
                                  <th class="text-right">Email</th>
                                  <td>:</td>
                                  <td>{{$view->email}}</td>
                                </tr>

                                <tr>
                                  <th class="text-right">Cell</th>
                                  <td>:</td>
                                  <td>{{$view->phone}}</td>
                                </tr>
                                <tr>
                                  <th class="text-right">Hometown</th>
                                  <td>:</td>
                                  <td>{{$view->hometown}}</td>
                                </tr>
                                <tr>
                                  <th class="text-right">Short Bio</th>
                                  <td>:</td>
                                  <td>{{$view->shortbio}}</td>
                                </tr>


                              </table>
                            </div>
                          </div>
                          <hr>
                          <div class="card-text text-sm-center" style="margin-bottom: 20px;">
                              <a href="#"><i class="fa fa-facebook pr-1"></i></a>
                              <a href="#"><i class="fa fa-twitter pr-1"></i></a>
                              <a href="#"><i class="fa fa-linkedin pr-1"></i></a>
                              <a href="#"><i class="fa fa-pinterest pr-1"></i></a>
                          </div>

                      </div>
                  </div>
              </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection
