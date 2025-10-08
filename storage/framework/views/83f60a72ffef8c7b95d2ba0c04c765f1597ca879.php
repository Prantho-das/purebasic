
<?php $__env->startSection('content'); ?>

<div id="content-wrapper">

      <div class="container-fluid">
        <div class="card mb-3">
            <form action="<?php echo e(url('admin/lecture-sheet')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="form-row align-items-center" style="margin-left: 10px">
                    <div class="col-sm-3 my-1">
                        <input type="text" name="name" class="form-control" id="lectureName" value="<?php echo e(empty($selected_name)?'':$selected_name); ?>" placeholder="Lecture Name">
                    </div>
                    <div class="col-sm-3 my-1">
                        <select class="custom-select my-1 mr-sm-2" id="subject" name="subject">
                            <option value="">Select Subject</option>
                            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($subject->category); ?>" <?php echo e(($selected_subject == $subject->category)?'selected':''); ?>><?php echo e($subject->category); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-sm-4 my-1">
                        <select class="custom-select my-1 mr-sm-2" id="batch" name="batch">
                            <option value="">Select Batch</option>
                            <?php $__currentLoopData = $batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>" <?php echo e(($selected_batch == $key)?'selected':''); ?>><?php echo e($batch); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-auto my-1">
                        <button type="submit" class="btn btn-primary" >Submit</button>
                        <button onclick="location.href='<?php echo e(url('admin/lecture-sheet')); ?>';" class="btn btn-danger" type="reset">Reset</button>
                    </div>
                </div>
            </form>
          <div class="card-header">
            <div class="row">
              <div class="col-md-10">
                Lecture-Sheet
              </div>
              <div class="col-md-2 align-right btn btn-primary">
                <i class="fas fa-plus"></i>
                <a href="<?php echo e(url('/admin/add/lecture-sheet')); ?>" style="color: #fff;">Add Information</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <?php if(session()->has('success')): ?>
                <script>
                 swal({
                    title: "Good job!",
                    text: "Your Lecture-Sheet uploads........",
                    icon: "success",
                    button: "Aww yiss!",
                  });
                </script>
               <?php endif; ?>

               <?php if(session()->has('delete')): ?>
                   <script>
                     Swal.fire(
                      'Good job!',
                      'Your Lecture-Sheet delete........',
                      'success'
                    )
                   </script>

                  <?php endif; ?>

            <div class="table-responsive">
              <table class="table table-bordered dataTable"  width="100%">
                  <thead>
                      <tr role="row">
                          <th>Id</th>
                          <th>Title</th>
                          <th>Subject</th>
                          <th>Batch</th>
                          <th style="width:136px;">Manage</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $allsheet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                          <td><?php echo e($data->id); ?></td>
                          <td><?php echo e($data->title); ?></td>
                          <td><?php echo e($data->category); ?></td>
                          <?php
                            $lecturebatch = App\LectureBatch::where('lecture_id',$data->id)->get();
                          ?>

                          <td>
                            <?php $__currentLoopData = $lecturebatch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mamber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e(isset($batches[$mamber->membershipe_id])?$batches[$mamber->membershipe_id]:''); ?>, <br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </td>
                          <td>
                            <a href="<?php echo e(url('/admin/view/lecture-sheet/'.$data->id)); ?>" class="btn btn-success" title="view"><i class="fas fa-plus"></i></a>
                            <a href="<?php echo e(url('/admin/edit/lecture-sheet/'.$data->id)); ?>" class="btn btn-info" title="edit"><i class="fas fa-pencil-alt"></i></a>
                            <a href="<?php echo e(url('/admin/delete/lecture-sheet/'.$data->id)); ?>" class="btn btn-danger" title="trash"><i class="fas fa-trash"></i></a>
                          </td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
              </table>
                <?php echo e($allsheet ->links()); ?>




            </div>
          </div>
          <div class="card-footer small text-muted">Updated</div>
        </div>

      </div>

    </div>
    <!-- /.content-wrapper -->

  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('admin_js'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        // $('#subject').select2();
        // $('#batch').select2();
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>