<?php $__env->startSection('content'); ?>
    <div style="margin-top: 3rem; margin-bottom: 5rem;">
            
    
        <div class="row">
            
            <div class="col-4">&nbsp</div>
    
            <div class="col-4" >
                
            <?php $__currentLoopData = $all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
                <div style="margin: 1rem; padding: 0.5rem; border-radius: 0.3rem;" class="<?php echo e(in_array($notice->id, $read) ? 'oldNotice' : 'newNotice'); ?>">
                    <p><?php echo e(date('d F Y, h:i A', strtotime($notice->updated_at))); ?></p>
                    <p><b><?php echo e($notice->batch_name); ?></b></p>
                    <b><?php echo e($notice->notice); ?></b>
                <div style="margin: 1rem;"><a class="loginButton" href="/notice/<?php echo e($notice->id); ?>">Check Now</a></div>
                </div>
                    

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>