<?php $__env->startSection('content'); ?>
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <a href="<?php echo e(url('/admin/all/modeltest')); ?>"></a><i class="fas fa-plus"></i>
                Model Test Updated</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form action="<?php echo e(url('/admin/update/modeltest')); ?>" method="post" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>

                <div class="form-group">
                    <label for="nf-pattern" class=" form-control-label">Exam Pattern</label>
                    <select class="form-control" required name="exam_pattern" id="nf-pattern">
                        <option value="">Choice option</option>
                        <option <?php echo e($data->exam_type === 'BCS' ? 'selected' : ''); ?> value="BCS">BCS</option>
                        <option <?php echo e($data->exam_type === 'Regular Exam' ? 'selected' : 'selected'); ?> value="Regular Exam">Regular Exam</option>
                        <option <?php echo e($data->exam_pattern === 'Lecture' ? 'selected' : ''); ?> value="Lecture Wise">Lecture Wise</option>
                        <option <?php echo e($data->exam_pattern === 'Clinical Case' ? 'selected' : ''); ?> value="Clinical Case">Clinical Case</option>
                    </select>
                </div>
                
                
                <div class="form-group">
                    <label for="nf-type" class=" form-control-label">Exam Type</label>
                    <select class="form-control" required name="exam_type" id="nf-type">
                        <option value="">Choice option</option>
                        <option <?php echo e($data->exam_type === 'Free' ? 'selected' : ''); ?> value="Free">Free Exam</option>
                        <option <?php echo e($data->exam_type === 'Premium' ? 'selected' : ''); ?> value="Premium">Premium Exam</option>
                    </select>
                </div>

                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Model Test Name</label>
                    <input type="hidden" name="id" value="<?php echo e($data->id); ?>" class="form-control">
                    <input type="text" name="name" value="<?php echo e($data->name); ?>" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Total Marks</label>
                    <input type="number" name="exam_in_minutes" class="form-control" required value="<?php echo e($data->exam_in_minutes); ?>">
                  </div>
                  <div class="form-group">
                    <label for="nf-email" class=" form-control-label">Model Test Length (Minutes)</label>
                    <input type="number" name="ex_time" value="<?php echo e($data->ex_time); ?>" class="form-control" required>
                  </div>

				<div class="form-group">
                    <label for="nf-email" class=" form-control-label">Solve Class</label>
                    <input type="text" name="solve_shet" value="<?php echo e($data->solve_shet); ?>" class="form-control" required placeholder="Solve Sheet">
                  </div>

				<div class="form-group">
                    <label for="nf-email" class=" form-control-label">Serial</label>
                    <input type="number" name="serial" value="<?php echo e($data->serial); ?>" class="form-control" required placeholder="Serial">
                  </div>

                  <div class="form-group">
                      <label for="nf-email" class=" form-control-label">Admission Batch</label>
                      <select class="form-control" name="batch[]" multiple="" required="">
                      <?php $__currentLoopData = $memberbatch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php
                        $batch_id = App\ModeltestBatch::where('modeltest_id',$data->id)->where('membershipe_id',$batch->id)->first();
                      ?>
                      <option value="<?php echo e($batch->id); ?>" <?php echo e($batch->id == ($batch_id->membershipe_id ?? 0) ? 'selected' : ''); ?>><?php echo e($batch->plan); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    </div>
                  <button type="submit" class="btn btn-primary btn-sm">
                      <i class="fa fa-dot-circle-o"></i> Submit
                  </button>
              </form>
          </div>
          <div class="card-footer small text-muted"></div>
        </div>

      </div>

    </div>

  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>