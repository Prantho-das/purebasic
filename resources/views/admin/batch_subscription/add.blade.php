@extends('layouts.admin')
@section('content')
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <a href="{{url('/admin/addmition/batch')}}"></a></i>
               Addmition Batch</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="{{url('admin/addmition/batch/add')}}" method="post" enctype="multipart/form-data">
              @csrf
                  
				
				<div class="form-group">
                    <label for="nf-email" class=" form-control-label">Batch Name</label>                  
                    <input type="text" name="plan" class="form-control">
                  </div>
				<div class="form-group">
                    <label for="nf-email" class=" form-control-label">Batch Type</label>                  
					  <select name="type" class="form-control">
						  <option value="online">online</option>
						  <option value="online">Offline </option>
					  </select>
                  </div>
				<div class="form-group">
                    <label for="nf-email" class=" form-control-label">Post Graduation Coverage</label>                  
					<input type="text" name="graduation" class="form-control">
                  </div>
				<div class="form-group">
                    <label for="nf-email" class=" form-control-label">Duration</label>                  
                    <input type="text" name="duration" class="form-control">
                  </div>
                  
                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Admission free</label>                  
                    <input type="text" name="ammount" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Batch Id</label>                  
                    <input type="text" name="batch_id" class="form-control">
                  </div>
				
				<div class="form-group">
                     <input type="checkbox" name="show"> Show in home page
                  </div>
				

                  <button type="submit" class="btn btn-primary btn-sm">
                      <i class="fa fa-dot-circle-o"></i> Submit
                  </button>
              </form>
          </div>
          <div class="card-footer small text-muted">Update</div>
        </div>

      </div>

    </div>

  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
@endsection



            
