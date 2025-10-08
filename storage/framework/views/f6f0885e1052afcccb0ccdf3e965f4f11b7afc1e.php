
<?php $__env->startSection('content'); ?>
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                Notice-board.........
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="<?php echo e(url('/admin/all/notice')); ?>" style="color: #fff;">All Notic</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered"  width="100%">
                <tr>
                  <th>Name</th>
                  <td>
                      <?php echo e($data->name); ?>

                  </td>
                </tr>
                <tr>
                  <th>Batch</th>
                  <td>
                      <?php echo e($data->batch->plan); ?>

                  </td>
                </tr>

                <tr>
                  <th>Details</th>
                  <td>
                      <?php echo e($data->notice); ?>

                  </td>
                </tr>
                <tr>
                  <th>Time</th>
                  <td><?php echo e($data->created_at); ?></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated</div>
        </div>

      </div>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>