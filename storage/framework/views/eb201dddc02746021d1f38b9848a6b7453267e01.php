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

                    <form action="<?php echo e(route('store.duration')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="nf-batch_id" class=" form-control-label">Batch Name</label>
                            <select name="batch_id" class="form-control">
                                <option value=""><?php echo e('Select Batch'); ?></option>
                                <?php $__currentLoopData = $batch_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->plan); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('batch_id')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('batch_id')); ?></strong>
                                  </span>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="batch_duration" class=" form-control-label">Batch Duration (in days)</label>
                            <input type="number" name="batch_duration"
                                   class="form-control" required value="180">
                        </div>

                        <div class="form-group">
                            <label for="fee" class=" form-control-label">Batch Fees</label>
                            <input type="number" name="batch_fee"
                                   class="form-control" required value="9500">
                        </div>
                        
                        <div class="form-group">
                            <label for="information" class=" form-control-label">Information</label>
                            <input type="text" name="information"
                                   class="form-control" value="( With Lecture Notes )">
                        </div>

                        <div class="form-group">
                            <label for="subscription_end" class=" form-control-label">Subscription End</label>
                            <input type="date" name="subscription_end"
                                   class="form-control">
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