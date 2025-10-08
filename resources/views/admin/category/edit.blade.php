@extends('layouts.admin')
@section('content')
@if (Session::has('success'))
  <script>
  sawal({
    title: "Good job!",
    text: "Category insert success!",
    icon: "success",
  });
</script>
@endif
@if (Session::has('error'))
  <script>
  sawal({
    title: "Good job!",
    text: "Category insert success!",
    icon: "danger",
  });
</script>
@endif


<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="card">
      <div class="card-header">
        <strong> Category Insert</strong>
      </div>
      <div class="card-body card-block">
        <form action="{{url('/admin/category/update')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group"><label for="nf-email" class=" form-control-label">Category Name</label>
            <select class="form-control" name="mainCategory">
              @foreach ($mainCategory as $maincat)
              <option value="{{$maincat->id}}">{{$maincat->name}}</option>
              @endforeach

            </select>
          </div>
          <div class="form-group"><label for="nf-email" class=" form-control-label">Category Name</label>
            <input type="hidden" id="nf-email" name="id" value="{{$data->id}}" class="form-control">
            <input type="text" id="nf-email" name="name" value="{{$data->name}}" class="form-control">
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
