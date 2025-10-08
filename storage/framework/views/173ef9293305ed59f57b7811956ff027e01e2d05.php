
<?php $__env->startSection('content'); ?>
<div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                Question Bank
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <a href="<?php echo e(url('/admin/add/question_bank_topic')); ?>" style="color: #fff;">Add Topic</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                   <?php if(session()->has('update')): ?>
              <script>
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Modeltest Updateed',
                  showConfirmButton: false,
                  timer: 1500
                    })
              </script>
              <?php endif; ?>

              <?php if(session()->has('delete')): ?>
              <script>
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Modeltest daleted',
                  showConfirmButton: false,
                  timer: 1500
                    })
              </script>
              <?php endif; ?>
              <div class="table-responsive">
                <table class="table table-bordered dataTable"  width="100%">
                    <thead>
                        <tr role="row">
                            <th>Subject</th>
                            <th>Chapter</th>
                            <th>Topic</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($data->subject); ?></td>
                            <td><?php echo e($data->chapter); ?></td>
                            <td><?php echo e($data->name); ?></td>
                            <td>
                              <a href="<?php echo e(url('/admin/question_bank_questions/'.$data->id)); ?>" class="btn btn-info" title="All Question"><i class="fas fa-clipboard-list"></i></a>
                              <a href="<?php echo e(url('/admin/edit/question_bank_topic/'.$data->id)); ?>" class="btn btn-info" title="edit"><i class="fas fa-pencil-alt"></i></a>
                              <a href="<?php echo e(url('/admin/delete/question_bank_topic/'.$data->id)); ?>" class="btn btn-danger" title="trash"><i class="fas fa-trash"></i></a>
                              <a href="<?php echo e(url('/admin/solve/question_bank_topic/'.$data->id)); ?>" class="btn btn-info" title="Solve">Solve</a> 


                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
              </div>
              </div>
            </div>
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