
<?php $__env->startSection('content'); ?>
<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                <i class="fas fa-users"></i>
                All Banner
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="<?php echo e(url('/admin/banner/create')); ?>" style="color: #fff;">Add Banner</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                  <?php if(session()->has('success')): ?>
                  <script>
                   swal({
                      title: "Good job!",
                      text: "Your User Created Success........",
                      icon: "success",
                      button: "",
                    });
                  </script>
                 <?php endif; ?>             
              <div class="table-responsive">
                <table class="table table-bordered dataTable"  width="100%">
                    <thead>
                        <tr role="row">
                            <th>Title</th>
                            <th>Batch Id</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><img src="<?php echo e(asset('uploads/banner/'.$data->image)); ?>" width="150" alt=""></td>
                            <td><?php echo e($data->batch_id); ?></td>
                            <td>
                              <a href="<?php echo e(url('/admin/banner/edit/'.$data->id)); ?>" class="btn btn-success" title="edit"><i class="fas fa-edit"></i></a>
                              <a href="<?php echo e(url('/admin/banner/delete/'.$data->id)); ?>" class="btn btn-danger" title="trash"><i class="fas fa-trash"></i></a>
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
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>