<?php $__env->startSection('content'); ?>

    <div class="container">
        <?php if($free): ?>
            <div class="centerText">
            <h3>Please read the instructions before appearng in free exams</h3>
            <a href="/help" class="instructionButton">Instructions</a>
            </div>
        <?php endif; ?>
        <div>
            <h3 class="centerText"> <?php echo e($batch_info->plan); ?> </h3>
            <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
                <thead>
                <tr>
                    <th title="Field #1">Exam Name</th>
                    <th title="Field #2">Total Mark</th>
                    <th title="Field #3">Total Time</th>
                    <th title="Field #4">Action</th>
                    <th style="display: none"></th>
    
                </tr>
                </thead>
                <tbody>
                <?php $key=($exams_raw->perPage() * ($exams_raw->currentPage()-1))+1; ?>
                <?php $__currentLoopData = $exams_raw; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($key++ . '. ' .  $exam->name); ?></td>
                        <td><?php echo e($exam->exam_in_minutes); ?></td>
                        <td><?php echo e($exam->ex_time.' minutes'); ?></td>
                        <td><a href="<?php echo e(url('/spacialmodeltest-examm/'.$exam->id)); ?>">Start Exam</a></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
    
            </table>
            <div class="row">
                <div class="col-3">&nbsp</div>
                <div class="col-6"><?php echo e($exams_raw->links()); ?></div>
                <div class="col-3">&nbsp</div>

            </div>
        </div>
                    
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>