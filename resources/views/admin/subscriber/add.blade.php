@extends('layouts.admin')
@section('content')

<div class="content mt-3">
    <div class="animated fadeIn">
          <div class="card">
          <div class="card-header">
              <strong> Category Insert</strong>
          </div>
          <div class="card-body card-block">
            <form action="{{url('/admin/category')}}" method="post" enctype="multipart/form-data">
              @csrf
                  <div class="form-group"><label for="nf-email" class=" form-control-label">Category Name</label>
                    <input type="taxt" id="nf-email" name="name" placeholder="Enter category name.." class="form-control">
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
