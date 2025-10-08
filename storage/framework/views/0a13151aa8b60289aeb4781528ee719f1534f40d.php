<?php $__env->startSection('content'); ?>

    
    <div class="row container">
        <div class="col-4">&nbsp</div>
        <div class="col-4">
    
            <form action="<?php echo e(url('bkash-create')); ?>" method="post" enctype="multipart/form-data" class="submitForm">
                <?php echo csrf_field(); ?>
                

                <div class="marginAbove marginBelow">
                    <h3><?php echo e($batch_info->plan); ?></h3>
                    <h3>Choose suitable package and pay</h3>

                        <?php $__currentLoopData = $selectBatchDuration; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <h3>
                                <label>
                                    <input type="radio" name="payerReference" value="<?php echo e($userId . '_bdId_' . $item->bd_id . '_' . $item->bd_fee); ?>" required>Duration: <?php echo e($item->bd_duration); ?> Days - Fees: <?php echo e($item->bd_fee); ?> Taka <?php echo e($item->information ? $item->information : ''); ?>

                                </label>
    
    
                            </h3>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                </div>
                

    

    
                <button type="submit" class="submitButton">
                    <h3>Pay Now</h3>
                </button>
            </form>
    
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>