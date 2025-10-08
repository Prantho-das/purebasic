<?php $__env->startSection('content'); ?>

    <div class="container">
        <?php $i=0; ?>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subjects): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

           <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row subjectsContainer">
                    <div class="col-4">&nbsp</div>
                    
                    <div class="col-4 marginAbove round centerText subjects">
                
                        <a href="<?php echo e('/free_lectures/batch/' . $batch_id . '/subject/' . $subject->id . '/chapter'); ?>"class="linkButton"><?php echo e($subject->name); ?></a>
                            </a>
                        
                    </div>
                    
                
                </div>


                <?php $i++; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>