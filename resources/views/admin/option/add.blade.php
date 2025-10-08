@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
 @if(session()->has('success'))
    <script>
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Option Create Success',
        showConfirmButton: false,
        timer: 1500
          })
    </script>
    @endif

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                Option Create
              </div>
              <div class="col-md-2">
                 <a href="{{url('admin/all/option/'.$id)}}" class="btn btn-primary"><i class="fas fa-book"></i> All Option</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="{{url('/admin/add/option/'.$id)}}" method="post" enctype="multipart/form-data">
              @csrf
                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Option name</label>
                    <input type="text" name="name" class="form-control" required>
                  </div>

                  <div class="form-group">
                    <input type="checkbox" name="is_curract" class="">
                    <label for="nf-email" class=" form-control-label">Is Correct ?</label><br>
                  </div>

                  <button type="submit" class="btn btn-primary btn-sm">
                      <i class="fa fa-dot-circle-o"></i> Submit
                  </button>
              </form>
          </div>
          <div class="card-footer small text-muted"></div>
        </div>

      </div>

    </div>

  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
@endsection
