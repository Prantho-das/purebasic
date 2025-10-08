
<?php $__env->startSection('content'); ?>
<div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                Lecture-Sheet
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="<?php echo e(url('/admin/lecture-sheet')); ?>" style="color: #fff;">All Lecture-Sheet</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered dataTable"  width="100%">
                <tr>
                  <th>Date & Time</th>
                  <td>:</td>
                  <td><?php echo e($data->date_time); ?></td>
                </tr>
                <tr>
                  <th>Title</th>
                  <td>:</td>
                  <td><?php echo e($data->title); ?></td>
                </tr>
                <tr>
                  <th>Category</th>
                  <td>:</td>
                  <td><?php echo e($data->category); ?></td>
                </tr>
				  <tr>
                  <th>Lecture Note</th>
                  <td>:</td>
                  <td><?php echo e($data->links); ?></td>
                </tr>
				   <tr>
                  <th>Lecture Pdf</th>
                  <td>:</td>
                  <td><?php echo e($data->v_link); ?></td>
                </tr>
				  
				  <tr>
                  <th>Useful Pdf</th>
                  <td>:</td>
                  <td><a href="<?php echo e(asset('uploads/pdf/'.$data->pdf)); ?>" download="" class="btn btn-primary">Get Useful Pdf</a></td>
                </tr>
				  
                <tr>
                  <th>Time</th>
                  <td>:</td>
                  <td><?php echo e($data->created_at); ?></td>
                </tr>
              </table>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>