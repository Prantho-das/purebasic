<?php $__env->startSection('content'); ?>
<div id="content-wrapper">
      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                Admission Batch
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="<?php echo e(url('/admin/addmition/batch/add')); ?>" style="color: #fff;">Add Batch</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <?php if(session()->has('success')): ?>
              <script>
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Batch Created',
                  showConfirmButton: false,
                  timer: 1500
                    })
              </script>
              <?php endif; ?>

               <?php if(session()->has('update')): ?>
              <script>
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Batch Updateed',
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
                  title: 'Batch Delete',
                  showConfirmButton: false,
                  timer: 1500
                    })
              </script>
              <?php endif; ?>

            <div class="table-responsive">
              <table class="table table-bordered dataTable"  width="100%">
                  <thead>
                      <tr role="row">
                          <th>Name</th>
                          <th>Type</th>
						  <th>Graduation</th>
						  <th>Duration</th>
						  <th>Taka</th>
                          <th>Time</th>
                          <th style="width:136px;">Manage</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $allbatch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>

                          <td><?php echo e($data->plan); ?></td>
                          <td><?php echo e($data->type); ?></td>
						  <td><?php echo e($data->graduation); ?></td>
						  <td><?php echo e($data->duration); ?></td>
						  <td><?php echo e($data->ammount); ?></td>
                          <td><?php echo e($data->created_at); ?></td>
                          <td>
                            <a href="<?php echo e(url('/admin/addmition/batch/edit/'.$data->id)); ?>" class="btn btn-info" title="edit"><i class="fas fa-pencil-alt"></i></a>
                           <!-- <a href="<?php echo e(url('/admin/addmition/batch/delete/'.$data->id)); ?>" class="btn btn-danger" title="trash"><i class="fas fa-trash"></i></a>  -->
                          </td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated</div>
        </div>
      </div>
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>