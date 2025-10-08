<?php $__env->startSection('content'); ?>
<div id="content-wrapper">
 <?php if(session()->has('edit')): ?>
              <script>
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Questions Update Success',
                  showConfirmButton: false,
                  timer: 1500
                    })
              </script>
              <?php endif; ?>
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <a href="<?php echo e(url('/admin/all/job')); ?>"></a>
                Questions Uploads
              </div>
              <div class="col-md-2">
                 <a href="<?php echo e(url('admin/question_bank_questions/'.$data->question_bank_id)); ?>" class="btn btn-primary"><i class="fas fa-book"></i> All Questions</a>
              </div>
            </div>
          </div>

          <div class="card-body">
            <form action="<?php echo e(url('/admin/edit/question_bank_questions/'.$id)); ?>" method="post" enctype="multipart/form-data">
             <?php echo csrf_field(); ?>

             <h3 class="bg-secondary"style="padding: 5px 15px;">Add Questions</h3>
             <div class="form-group">
              <label for="nf-email" class=" form-control-label">Questions name</label>
              <input type="text" name="name" class="form-control" required value="<?php echo e($data->question); ?>">
            </div>
            <div class="form-group">
              <input type="checkbox" name="is_multi" class="" <?php echo e($data->is_multi == 1 ? 'checked' : ''); ?> >
              <label for="nf-email" class=" form-control-label">MCQ</label><br>
            </div>
            <div class="form-group">
              <input type="checkbox" name="is_free" class="" <?php echo e($data->is_free == 1 ? 'checked' : ''); ?> >
              <label for="nf-email" class=" form-control-label">Free</label><br>
            </div>
            <div class="form-group">
              <label for="nf-email" class=" form-control-label">Questions Details</label>
              <input type="text" name="detailss" class="form-control" value="<?php echo e($data->detailss); ?>">
            </div>
            <div class="form-group">
              <label for="nf-email" class=" form-control-label">Solve Link</label>
              <input type="text" name="solve_link" class="form-control" value="<?php echo e($data->solve_link); ?>">
            </div>
            <h3 class="bg-secondary" style="padding: 5px 15px;">Add Option</h3>
            <div class="row">
              <?php
                $que_options = App\QuestionBankOption::where('question_id',$data->id)->get();
                $alphabet = ['A','B','C','D','E'];
              ?>
              <?php $__currentLoopData = $que_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $options): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="nf-email" class=" form-control-label">Option <?php echo e($alphabet[$key]); ?></label>
                  <input type="text" name="option[<?php echo e($key); ?>][option]" class="form-control" required value='<?php echo e($options->option); ?>'>
                  <input type="checkbox" name="option[<?php echo e($key); ?>][correct]" class="" <?php echo e($options->correct_or_not == 1 ? 'checked' : ''); ?>>
                  <label for="nf-email" class=" form-control-label">Correct Ans ?</label><br>
                </div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
              
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