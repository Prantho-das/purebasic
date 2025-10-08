<?php $__env->startSection('content'); ?>
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <a href="<?php echo e(url('/admin/all/subject')); ?>"></a
                Subject Uploads</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="<?php echo e(url('/admin/update/subject')); ?>" method="post" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>

                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Subject Name</label>
                    <input type="hidden" name="id" value="<?php echo e($data->id); ?>" class="form-control">
                    <input type="text" name="name" value="<?php echo e($data->name); ?>" class="form-control" required>
                  </div>

                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Subject Serial</label>
                    
                    <input type="number" name="serial" value="<?php echo e($data->serial); ?>" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Question Bank Subject Serial</label>
                    
                    <input type="number" name="qb_serial" value="<?php echo e($data->qb_serial); ?>" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Price</label>
                    
                    <input type="number" name="price" value="<?php echo e($data->price); ?>" class="form-control">
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>