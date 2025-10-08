@extends('layouts.admin')
@section('content')

<div class="content mt-3">
    <div class="animated fadeIn">
          <div class="card">
          <div class="card-header">
              <strong>Social link Change</strong>
          </div>
          <div class="card-body card-block">
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                <form action="{{url('admin/edit/social/link/submit')}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group"><label for="nf-email" class=" form-control-label">facebook</label>
                        <input type="hidden" name="id" value="{{$data->id}}" class="form-control">
                        <input type="text" name="facebook" value="{{$data->facebook}}" class="form-control">
                      </div>
                      <div class="form-group"><label for="nf-email" class=" form-control-label">twitter</label>
                        <input type="text" name="twitter" value="{{$data->twitter}}" class="form-control">
                      </div>
                      <div class="form-group"><label for="nf-email" class=" form-control-label">google</label>
                        <input type="text" name="google" value="{{$data->google}}" class="form-control">
                      </div>
                      <div class="form-group"><label for="nf-email" class=" form-control-label">youtube</label>
                        <input type="text" name="youtube" value="{{$data->youtube}}" class="form-control">
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
