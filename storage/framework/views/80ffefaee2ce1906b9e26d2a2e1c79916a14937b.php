<?php $__env->startSection('content'); ?>

    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            Add Batch Duration & Fees
                        </div>
                    </div>
                </div>

                <!-- Body start -->
                <div class="card-body">

                    <?php $__currentLoopData = $editdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <form action="<?php echo e(route('update.duration')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <label for="nf-batch_id" class=" form-control-label">Batch Name</label>
                            <select name="batch_id" class="form-control" disabled>
                                <option value="<?php echo e($item->bd_id); ?>"><?php echo e($item->plan); ?></option>
                            </select>
                            <?php if($errors->has('batch_id')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('batch_id')); ?></strong>
                                  </span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <input type="text" name="bd_id"
                                   class="form-control" value="<?php echo e($item->bd_id); ?>" hidden>
                        </div>

                        <div class="form-group">
                            <label for="batch_duration" class=" form-control-label">Batch Duration (in days)</label>
                            <input type="number" name="batch_duration"
                                   class="form-control" value="<?php echo e($item->bd_duration); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="fee" class=" form-control-label">Batch Fees</label>
                            <input type="number" name="batch_fee"
                                   class="form-control" value="<?php echo e($item->bd_fee); ?>" required>
                        </div>


                        <div class="form-group">
                            <label for="information" class=" form-control-label">Information</label>
                            <input type="text" name="information"
                                   class="form-control" value="<?php echo e($item->information); ?>">
                        </div>

                        <div class="form-group">
                            <label for="subscription_end" class=" form-control-label">Subscription End</label>
                            <input type="date" name="subscription_end"
                                   class="form-control" value="<?php echo e($item->subscription_end ? date('Y-m-d', strtotime($item->subscription_end)) : ''); ?>">
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                    </form>


                </div>
                <!-- Body end -->

            </div>
        </div>
    </div>
    </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>