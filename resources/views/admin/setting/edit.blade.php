@extends('layouts.admin')
@section('content')

<div class="content mt-3">
    <div class="animated fadeIn">
          <div class="card">
          <div class="card-header">
              <strong>Site Setting Change</strong>
          </div>
          <div class="card-body card-block">
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                <form action="{{url('admin/site-setting/edit/submit')}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group"><label for="nf-email" class=" form-control-label">site_title</label>
                        <input type="hidden" name="id" value="{{$data->id}}" class="form-control">
                        <input type="taxt" name="site_title" value="{{$data->site_title}}" class="form-control">
                      </div>
                      <div class="form-group"><label for="nf-email" class=" form-control-label">keyword</label>
                        <input type="taxt" name="keyword" value="{{$data->keyword}}" class="form-control">
                      </div>
                      <div class="form-group"><label for="nf-email" class=" form-control-label">description</label>
                        <input type="taxt" name="description" value="{{$data->description}}" class="form-control">
                      </div>
                      <div class="form-group"><label for="nf-email" class=" form-control-label">fav_icon</label>
                        <input type="file" name="fav_icon" class="form-control">
                        <img src="{{asset('uploads/setting/'.$data->fav_icon)}}" style="width:70px">
                      </div>
                      <div class="form-group"><label for="nf-email" class=" form-control-label">site_logo</label>
                        <input type="file" name="site_logo" class="form-control">
                        <img src="{{asset('uploads/setting/'.$data->site_logo)}}" style="width:70px">
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
