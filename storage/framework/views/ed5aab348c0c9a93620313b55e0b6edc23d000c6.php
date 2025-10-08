<?php $__env->startSection('content'); ?>

    
    <div class="row container">
        <div class="col-4">&nbsp</div>
        <div class="col-4">
    
            <form action="<?php echo e(url('bkash-create')); ?>" method="post" enctype="multipart/form-data" class="submitForm">
                <?php echo csrf_field(); ?>
                

                <div class="marginAbove marginBelow">
                    <h3>Please Pay <?php echo e($clinical_case->price); ?> Taka To Watch This Case</h3>


                        <input type="hidden" name="payerReference" value="<?php echo e($userId . '_caseId_' . $clinical_case->id . '_' . $clinical_case->price); ?>" required>

                            
                            

                </div>
                

    

    
                <button type="submit" class="submitButton">
                    <h3>Pay Now</h3>
                </button>
            </form>
    
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>