<?php $__env->startSection('content'); ?>

    <div class="container">
        
        <?php $key=($exams_raw->perPage() * ($exams_raw->currentPage()-1))+1; ?>
        <?php $__currentLoopData = $exams_raw; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
            <div class="row caseContainer marginBelow">
                
                <div class="col-4">&nbsp</div>

                <div class="col-4 marginAbove round case">
                    <p><b><?php echo e($exam->name); ?></b></p>
                    <a href="<?php echo e(url('/clinical_case/question/'.$exam->id)); ?>" class="detailsButton">Details</a>
                    
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>