<?php $__env->startSection('content'); ?>
    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <i class="fas fa-users"></i>
                            Student Summary Report
                        </div>

                        <form action="<?php echo e(route('report.summary.dataload')); ?>" method="post" enctype="multipart/form-data"
                              class="col-md-12">
                            <?php echo csrf_field(); ?>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="batch_id">Filter by Batch:</label>
                                    <select name="batch_id" class="col-md-3 form-control-sm">
                                        <option value=""><?php echo e('Select'); ?></option>
                                        <?php $__currentLoopData = $batchData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aBatchData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($aBatchData->id); ?>"><?php echo e($aBatchData->plan); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm form-control col-md-2">
                                        <i class="fa fa-dot-circle-o"></i> Submit
                                    </button>

                                </div>
                            </div>

                        </form>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered yajra-datatable"
                                           style="text-transform: capitalize;"
                                           width="100%">
                                        <thead>
                                        <tr role="row">
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Batch</th>
                                            <th>Quiz Marks</th>
                                            <th>Exam Marks</th>
                                            <th>Video Watch Marks</th>
                                            <th>Result</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if($showReport != 0): ?>
                                            <?php $__currentLoopData = $batchResult; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <th><?php echo e($batch->student_id); ?></th>
                                                <th><?php echo e($batch->name); ?></th>
                                                <th><?php echo e($batch->mobile); ?></th>
                                                <th><?php echo e($batch->plan); ?></th>


                                                <?php $quizMark = \Illuminate\Support\Facades\DB::table('modeltest_answers as a')
                                ->leftJoin('modeltest_batches as b', 'a.modeltest_id', '=', 'b.modeltest_id')
                                ->where('a.student_id', $batch->student_id)
                                ->where('b.lecture_id', '!=', null)
                                ->where('b.membershipe_id', $batch->membershipe_id)
                                ->sum('point');

                                                ?>
                                                <th><?php echo e(number_format($quizMark, 2)); ?></th>

                                                <?php $lectureMark = \Illuminate\Support\Facades\DB::table('modeltest_answers as a')
                                ->leftJoin('modeltest_batches as b', 'a.modeltest_id', '=', 'b.modeltest_id')
                                ->where('a.student_id', $batch->student_id)
                                ->where('b.lecture_id', '=', null)
                                ->where('b.membershipe_id', $batch->membershipe_id)
                                ->sum('point');

                                                ?>
                                                <th><?php echo e(number_format($lectureMark, 2)); ?></th>

                                                <?php
                                                    $videoMark = \Illuminate\Support\Facades\DB::table('watch_count')
                                                    ->where('batch_id', $batch->membershipe_id)
                                                    ->where('user_id', $batch->student_id)
                                                    ->where('count', '>=', 2)
                                                    ->count('id')*2;

                                                $totalMark = $videoMark + $lectureMark + $quizMark;

                                                ?>
                                                <th><?php echo e(number_format($videoMark, 2)); ?></th>

                                                <th><?php echo e(number_format($totalMark, 2)); ?></th>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                                        <div class="card-footer small text-muted">

                                        </div>
                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('admin_js'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.yajra-datatable').dataTable(
                {
                    ordering: false,
                }
            );
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>