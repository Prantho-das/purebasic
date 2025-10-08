<?php $__env->startSection('content'); ?>
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <a href="<?php echo e(url('admin/all/notice')); ?>"></a>
               All Notice</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="<?php echo e(url('/admin/upload/notice')); ?>" method="post" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>
                  <div class="form-group<?php echo e($errors->has('title') ? ' is-invalid' : ''); ?>">
                    <label for="nf-email" class=" form-control-label">Name</label>
                    <input type="text" name="title" class="form-control" required>
                    <?php if($errors->has('title')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('title')); ?></strong>
                        </span>
                    <?php endif; ?>
                  </div>

                     <div class="form-group">
                        <label for="nf-email" class=" form-control-label">Admission Batch</label>
                        <select class="form-control" name="batch[]" multiple="">
                           <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option value="<?php echo e($data->id); ?>"><?php echo e($data->plan); ?></option>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                     </div>

                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Notice</label>
                    <textarea type="text" name="notic" rows="4" class="form-control" required></textarea>
                  </div>

                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Link</label>
                    <textarea type="text" name="link" class="form-control" ></textarea>
                  </div>


                  <button type="submit" class="btn btn-primary btn-sm">
                      <i class="fa fa-dot-circle-o"></i> Submit
                  </button>
              </form>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

      </div>

    </div>

  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>