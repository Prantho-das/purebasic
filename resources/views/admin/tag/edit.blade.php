@extends('layouts.admin')
@section('content')

<div class="content mt-3">
    <div class="animated fadeIn">
          <div class="card">
          <div class="card-header">
              <strong> Tag Uploads...</strong>
          </div>
          <div class="card-body card-block">
            <form action="{{url('/admin/tag/update')}}" method="post" enctype="multipart/form-data">
              @csrf
                  <div class="form-group"><label for="nf-email" class=" form-control-label">Tag Name</label>
                    <input type="taxt" id="nf-email" name="name" value="{{$data->name}}" class="form-control">
                    <input type="hidden" id="nf-email" name="id" value="{{$data->id}}" class="form-control">
                  </div>

                  <div class="form-group"><label for="nf-email" class=" form-control-label">Image</label>
                    <input type="file" name="image" class="form-control">
                  </div>

                  <button type="submit" class="btn btn-primary btn-sm">
                      <i class="fa fa-dot-circle-o"></i> Submit
                  </button>
              </form>
          </div>
          </div>
    </div><!-- .animated -->
</div><!-- .content -->
</div>

@endsection
