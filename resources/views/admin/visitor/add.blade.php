@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <i class="fas fa-users"></i>
                Downloads Links
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="{{url('/admin/books')}}" style="color: #fff;">All Links</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            @if(session()->has('success'))
              <script>
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Downloads link Created',
                  showConfirmButton: false,
                  timer: 1500
                    })
              </script>
              @endif


              @if(session()->has('delete'))
              <script>
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Batch Delete',
                  showConfirmButton: false,
                  timer: 1500
                    })
              </script>
              @endif

            <div class="table-responsive">
              <form action="{{url('/admin/books/uploads')}}" method="post" enctype="multipart/form-data">
                  @csrf
                      <div class="form-group">
                        <label for="nf-email" class=" form-control-label">Sl</label>
                        <input type="taxt" name="sl" class="form-control" required>
                      </div>
					
					<div class="form-group">
                        <label for="nf-email" class=" form-control-label">Name</label>
                        <input type="taxt" name="name" class="form-control" required>
                      </div>
					
					<div class="form-group">
                        <label for="nf-email" class=" form-control-label">url</label>
                        <input type="taxt" name="url" class="form-control" required>
                      </div>
					
					<div class="form-group">
                        <label for="nf-email" class=" form-control-label">Image</label>
                        <input type="file" name="image" class="form-control" required>
                      </div>


                      <button type="submit" class="btn btn-primary btn-sm">
                          <i class="fa fa-dot-circle-o"></i> Submit
                      </button>
                  </form>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated</div>
        </div>
      </div>
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
@endsection
