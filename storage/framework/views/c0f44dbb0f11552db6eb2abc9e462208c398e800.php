
<?php $__env->startSection('content'); ?>
<div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                All Mentor
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="<?php echo e(url('/admin/add/mentor')); ?>" style="color: #fff;">Add Mentor</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered dataTable"  width="100%">
                  <thead>
                      <tr role="row">
                          <th>Photo</th>
                          <th>Name</th>
                          <th>Designation</th>
                          <th style="width:136px;">Manage</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $mentors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td> <img src="<?php echo e(asset('uploads/mentor/'.$data->image)); ?>" style="width: 150px;"></td>
                      <td><?php echo e($data->name); ?></td>
                      <td><?php echo e($data->designation); ?></td>
                      <td>
                        <a href="<?php echo e(url('/admin/view/mentor/'.$data->id)); ?>" class="btn btn-success" title="view"><i class="fas fa-plus"></i></a>
                        <a href="<?php echo e(url('/admin/edit/mentor/'.$data->id)); ?>" class="btn btn-info" title="edit"><i class="fas fa-pencil-alt"></i></a>
                        <a href="<?php echo e(url('/admin/delete/mentor/'.$data->id)); ?>" class="btn btn-danger" title="trash"><i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
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