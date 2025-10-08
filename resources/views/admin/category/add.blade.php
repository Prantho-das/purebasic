@extends('layouts.admin')
@section('content')
<div class="content mt-3">
  <div class="animated fadeIn">
    @if (session()->has('success'))
    <div class="alert alert-primary" role="alert">
      Category Insert Success .
    </div>
    @endif
    <div class="card">
      <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                 <strong> Category Insert</strong>
            </div>
            <div class="col-md-2">
              <a href="{{url('admin/category')}}" class="btn btn-primary">All Category</a>
            </div>
        </div>
      </div>
      <div class="card-body card-block">
        <form action="{{url('/admin/category')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group"><label for="nf-email" class=" form-control-label">Category Name</label>
            <select class="form-control" name="mainCategory">
              @foreach ($mainCategory as $maincat)
              <option value="{{$maincat->id}}">{{$maincat->name}}</option>
              @endforeach

            </select>
          </div>
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
