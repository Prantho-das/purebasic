@extends('layouts.admin')
@section('content')

<div class="content mt-3">
    <div class="animated fadeIn">
          <div class="card">
          <div class="card-header">
              <strong>Visitor information Change</strong>
          </div>
          <div class="card-body card-block">
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                <form action="{{url('/admin/visitor/update')}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group"><label for="nf-email" class=" form-control-label">Username</label>
                        <input type="hidden" name="id" value="{{$data->id}}" class="form-control">
                        <input type="taxt" name="name" value="{{$data->name}}" class="form-control">
                      </div>
                      <div class="form-group"><label for="nf-email" class=" form-control-label">fullname</label>
                        <input type="taxt" name="fullname" value="{{$data->fullname}}" class="form-control">
                      </div>
                      <div class="form-group"><label for="nf-email" class=" form-control-label">email</label>
                        <input type="taxt" name="email" value="{{$data->email}}" class="form-control">
                      </div>
                      <div class="form-group"><label for="nf-email" class=" form-control-label">phone</label>
                        <input type="text" name="phone" value="{{$data->phone}}" class="form-control">
                      </div>

                      <div class="form-group"><label for="nf-email" class=" form-control-label">hometown</label>
                        <input type="taxt" name="hometown" value="{{$data->hometown}}" class="form-control">
                      </div>
                      <div class="form-group"><label for="nf-email" class=" form-control-label">shortbio</label>
                        <input type="taxt" name="shortbio" value="{{$data->shortbio}}" class="form-control">
                      </div>
                      <div class="form-group"><label for="nf-email" class=" form-control-label">image</label>
                        <input type="file" name="image" class="form-control">
                        <img src="{{asset('uploads/user/'.$data->image)}}" style="width:70px">
                      </div>
                      

                      <button type="submit" class="btn btn-primary btn-sm">
                          <i class="fa fa-dot-circle-o"></i> Submit
                      </button>
                  </form>
              </div>
              </div>
              <div class="col-md-2"></div>
            </div>
          </div>
    </div><!-- .animated -->
</div><!-- .content -->
</div>

@endsection
