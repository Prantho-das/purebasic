<?php $__env->startSection('content'); ?>
<div id="content-wrapper">

  <div class="container-fluid">
    <div class="card mb-3">
      <div class="card-header">
        <div class="row">
          <div class="col-md-10">
           
        </div>
      </div>
    </div>
    <div class="card-body">
      <form action="<?php echo e(url('/admin/banner/edit',$data->id)); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="form-group">
          <label for="nf-email" class=" form-control-label">Batch Id</label>
          <input type="number" name="batch_id" value="<?php echo e($data->batch_id); ?>" class="form-control<?php echo e($errors->has('batch_id') ? ' is-invalid' : ''); ?>">
          <?php if($errors->has('batch_id')): ?>
          <span class="invalid-feedback" role="alert">
            <strong><?php echo e($errors->first('batch_id')); ?></strong>
          </span>
          <?php endif; ?>
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