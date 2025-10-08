@extends('layouts.visitor') @section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    @if(session()->has('success'))
                    <script>
                    swal({
                      title: "Good job!",
                      text: "profile update success...........",
                      icon: "success",
                      });
                    </script>
                    @endif
                    <div class="card-header">
                        <strong>User </strong> Update
                    </div>
                    <div class="card-body card-block">
                        <form action="{{url('/user/profile-update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                              
                            <div class="form-group">
                                <label for="nf-email" class=" form-control-label">Name</label>
                                <input type="hidden" id="nf-email" name="id" value="{{$edit->id}}" class="form-control">
                                <input type="taxt" id="nf-email" name="name" value="{{$edit->name}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="nf-password" class=" form-control-label">Email</label>
                                <input type="taxt" id="nf-password" name="email" value="{{$edit->email}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nf-password" class=" form-control-label">Phone Number</label>
                                <input type="taxt" id="nf-password" name="cell" value="{{$edit->phone}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nf-password" class=" form-control-label">Home town</label>
                                <input type="taxt" id="nf-password" name="hometown" value="{{$edit->hometown}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="nf-password" class=" form-control-label">Short Bio</label>
                                <input type="taxt" id="nf-password" name="shortbio" value="{{$edit->shortbio}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="nf-password" class=" form-control-label">Image</label>
                                <input type="file" name="photo"  class="form-control">
                                <img src="{{asset('uploads/user/' .$edit->image)}}" style="width:100px">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-md-2"></div>

        </div>
    </div>
    <!-- .animated -->
</div>
<!-- .content -->

</div>
<!-- /#right-panel -->

<!-- Right Panel -->
@endsection
