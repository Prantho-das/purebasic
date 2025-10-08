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
                  
                   @if(session()->has('success'))
                    <script>
                      Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Student information updated',
                        showConfirmButton: false,
                        timer: 1500
                          })
                    </script>
                    @endif
                  
                  <form method="post" action="{{url('/admin/paid/member/update')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" name="id" value="{{$data->students->id}}" />
                                <div class="form-group">
                                    <label for="fastname">Full Name<span class="text-danger">*</span></label>
                                    <input type="text" required="" class="form-control" name="name" id="fastname" value="{{$data->students->name}}" />
                                </div>
                                <div class="form-group">
                                    <label for="input2">Email<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="email" value="{{$data->students->email}}" />
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone Number(Without Country Code)<span class="text-danger">*</span></label>
                                    <input type="text" required="" class="form-control" name="mobile" value="{{$data->students->mobile}}" />
                                </div>
                                
                                <div class="form-group">
                                    <label for="phone">Gender<span class="text-danger">*</span></label>
                                    <input type="text" required="" class="form-control" name="gender" value="{{$data->students->gender}}" />
                                </div>
                                
                                <div class="form-group">
                                    <label for="phone">Date of Birth<span class="text-danger">*</span></label>
                                    <input type="text" required="" class="form-control" name="birth" value="{{$data->students->birth}}" />
                                </div>
                                
                                <div class="form-group">
                                    <label for="phone">Position<span class="text-danger">*</span></label>
                                    <input type="text" required="" class="form-control" name="position" value="{{$data->students->position}}" />
                                </div>
                                <div class="form-group">
                                    <label for="phone">Medical / Dental college<span class="text-danger">*</span></label>
                                    <input type="text" required="" class="form-control" name="medical" value="{{$data->students->medical}}" />
                                </div>

                                <div class="form-group">
                                    <label for="phone">Medical / Dental College Batch<span class="text-danger">*</span></label>
                                    <input type="text" required="" class="form-control" name="batch" value="{{$data->students->batch}}" />
                                </div>
                                <div class="form-group">
                                    <label for="phone">Session<span class="text-danger">*</span></label>
                                    <input type="text" required="" class="form-control" name="sessionn" value="{{$data->students->sessionn}}" />
                                </div>

                              <div class="form-group">
                                    <label for="phone">Level<span class="text-danger">*</span></label>
                                    <input type="text" required="" class="form-control" name="batch" value="{{$data->students->batch}}" />
                                </div>
                               

                                
       
                                
                                 <div class="form-group">
                                    <label for="phone">Facebook Id<span class="text-danger">*</span></label>
                                    <input type="text" required="" class="form-control" name="fb" value="{{$data->students->fb}}" />
                                </div>
                                <div class="form-group">
                                    <label for="phone">Address<span class="text-danger">*</span></label>
                                    <input type="text" required="" class="form-control" name="address" value="{{$data->students->address}}" />
                                </div>






                                <div class="form-group">
                                    <label for="input2">Batch Name<span class="text-danger">*</span></label>
                                    <select class="form-control" name="group" value="{{$data->group}}">
                                        <option value="{{$data->membership->id}}">{{$data->membership->plan}}</option>
                                    </select>
                                </div>
                                
                                 <div class="form-group">
                                    <label for="fastname">Profile Picture<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="photo" />
                                </div>

                              
                                <div class="form-group{{ $errors->has('password') ? ' is-invalid' : '' }}">
                                    <label for="fastname">New  Password<span class="text-danger">*</span></label>
                                    <input type="password" name="password" class="form-control">
                                    @if ($errors->has('password'))
                                       <span class="invalid-feedback" role="alert">
                                           <strong>{{ $errors->first('password') }}</strong>
                                       </span>
                                   @endif
                                </div>
                                
                                <div class="form-group">
                                    <label for="fastname">Confirm Password<span class="text-danger">*</span></label>
                                   <input type="password" name="password_confirmation" class="form-control">
                                </div>
                                
                               
                                
                                
                                
                                
         

                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </form>

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
