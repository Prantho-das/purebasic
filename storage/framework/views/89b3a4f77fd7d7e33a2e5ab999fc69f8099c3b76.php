<?php $__env->startSection('content'); ?>
<div id="content-wrapper">
      <div class="container-fluid">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo e(url('admin/')); ?>">Dashboard</a>
          </li>
          <li class="breadcrumb-item">Overview</li>
        </ol>
      </div>
<div>
    
<?php $__currentLoopData = $batchArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <p style="margin-left:2rem;"><span><b><?php echo e($batch[1]); ?></b> - enrolled : <b><?php echo e($batch[2]); ?></b></span> <a class="btn btn-primary" style="color: white; margin-left: 1rem;" href="<?php echo e('/admin/batch_student/' . $batch[0] . '/enrolled'); ?>">Show List</a><a class="btn btn-primary" style="color: white; margin-left: 1rem;" href="<?php echo e('/admin/batch_student/' . $batch[0] . '/mobile'); ?>">Phone List</a><a class="btn btn-primary" style="color: white; margin-left: 1rem;" href="<?php echo e('/admin/batch_student/' . $batch[0] . '/whatsapp'); ?>">WhatsApp List</a></p>
    


<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<div style="margin-left:2rem;"><b>Admin : <?php echo e($otp); ?></b></div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>