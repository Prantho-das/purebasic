@extends('layouts.admin')
@section('content')

<div class="content mt-3">
    <div class="animated fadeIn">
          <div class="card">
          <div class="card-header">
              <strong> Photos Uploads</strong>
          </div>
          <div class="card-body card-block">
            <form action="{{url('/admin/uploads-photos')}}" method="post" enctype="multipart/form-data">
              @csrf
                  <div class="form-group"><label for="nf-email" class=" form-control-label">Caption</label>
                    <input type="text" name="caption" class="form-control" required="">
                  </div>
                  <div class="form-group"><label for="nf-email" class=" form-control-label">Photo</label>
                    <input type="file" name="photo" class="form-control" required="">
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
