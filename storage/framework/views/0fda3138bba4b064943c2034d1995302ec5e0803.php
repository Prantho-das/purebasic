
<?php $__env->startSection('content'); ?>
<div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                All Question
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="<?php echo e(url('/admin/add/questions/'.$id)); ?>" style="color: #fff;">Add Question</a>
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
                  title: 'Option daleted',
                  showConfirmButton: false,
                  timer: 1500
                    })
              </script>
              <?php endif; ?>
              <div class="table-responsive">
                <table class="table table-bordered dataTable"  width="100%">
                    <thead>
                        <tr role="row">
                            <th style="width: 50px">No</th>
                            <th>Question Name</th>
                            <th style="width:212px;">Question Option Type</th>
                            <th style="width:105px;">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $question; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($key +1); ?></td>
                            <td><?php echo e($data->question); ?></td>
                            <td>
                              <?php if($data->is_multi == 1): ?>
                                Multiple  
                              <?php else: ?>
                                Single
                              <?php endif; ?>
                            </td>
                            <td>
                              
                              <a href="<?php echo e(url('/admin/edit/questions/'.$data->id)); ?>" class="btn btn-info" title="edit"><i class="fas fa-pencil-alt"></i></a>
								<a href="<?php echo e(url('/admin/delete/questions/'.$data->id)); ?>" class="btn btn-danger" title="edit"><i class="fas fa-trash"></i></a>
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