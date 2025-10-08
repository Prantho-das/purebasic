@extends('layouts.admin')
@section('content')

<div class="content mt-3">
    <div class="animated fadeIn">
          <div class="card">
          <div class="card-header">
              <strong>Address Change</strong>
          </div>
          <div class="card-body card-block">
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                <form action="{{url('admin/address/submit')}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group"><label for="nf-email" class=" form-control-label">address</label>
                        <input type="hidden" name="id" value="{{$data->id}}" class="form-control">
                        <input type="text" name="address" value="{{$data->address}}" class="form-control">
                      </div>
                      <div class="form-group"><label for="nf-email" class=" form-control-label">email</label>
                        <input type="text" name="email" value="{{$data->email}}" class="form-control">
                      </div>
                      <div class="form-group"><label for="nf-email" class=" form-control-label">phone</label>
                        <input type="text" name="phone" value="{{$data->phone}}" class="form-control">
                      </div>
                      <div class="form-group"><label for="nf-email" class=" form-control-label">copyright</label>
                        <input type="text" name="copyright" value="{{$data->copyright}}" class="form-control">
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
