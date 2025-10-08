
<?php $__env->startSection('content'); ?>

    <div style="margin-top: 5rem;"><b>Admin : <?php echo e($adminOtp); ?></b></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>