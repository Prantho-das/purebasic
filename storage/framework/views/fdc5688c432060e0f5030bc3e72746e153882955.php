<?php $__env->startSection('content'); ?>
    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            Admission Batch
                        </div>
                        
                        
                        
                        
                        <form action="<?php echo e(route('data-enroll')); ?>" method="post" enctype="multipart/form-data"
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


                                    <label for="enroll_id" style="padding-left: 30px">Filter by Enroll Status:</label>
                                    <select name="enroll_id" class="col-md-3 form-control-sm">
                                        <option value=""><?php echo e('select'); ?></option>
                                        <option value="0">Pending</option>
                                        <option value="1">Approved</option>
                                        <option value="2">Deactivated</option>
                                    </select>

                                    <button type="submit" class="btn btn-primary btn-sm form-control col-md-2">
                                        <i class="fa fa-dot-circle-o"></i> Submit
                                    </button>


                                </div>
                            </div>

                        </form>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered yajra-datatable" width="100%">
                            <thead>
                            <tr role="row">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Batch</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Reference</th>
                                <th>Subs. Remaining</th>
                                <th>Enroll Status</th>
                                <th style="width:136px;">Manage</th>
                            </tr>
                            </thead>

                                              <tbody>
                                              <?php if($showReport != 0): ?>
                                              <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              
                                                  <?php
                                                    $due = $value->payable - $value->paid;
                                                  ?>
                                                  <tr style="background: <?php echo e($due != 0 ? 'red' : ''); ?>; color: <?php echo e($due != 0 ? 'white' : ''); ?>">
                                                      <td><?php echo e($value->student->id??''); ?></td>
                                                      <td><?php echo e($value->student->name??''); ?></td>
                                                      <td><?php echo e($value->student->mobile??''); ?></td>
                                                      <td><?php echo e($value->student->address??''); ?></td>
                                                      <td><?php echo e($value->course->plan??''); ?></td>
                                                      <td><?php echo e($value->paid); ?></td>
                                                      <td style="font-weight: <?php echo e($due != 0 ? 'bold' : ''); ?>"><?php echo e($due); ?></td>
                                                      <td><?php echo e($value->reference); ?></td>
                                                      <td>
                                                          <?php if($value->subscription_end==null): ?>
                                                              <?php echo e('-'); ?>

                                                          <?php elseif($value->subscription_end<date('Y-m-d H:i:S')): ?>
                                                              <?php echo e('Subscription Over'); ?>

                                                          <?php else: ?>
                                                              <?php
                                                              $startDate = date_create(date('Y-m-d'));
                                                              $endDate = date_create(date('Y-m-d',strtotime($value->subscription_end)));
                                                              $interval = date_diff($startDate, $endDate);
                                                              $days = $interval->format('%a');
                                                              ?>
                                                              <?php echo e($days.' Days'); ?>

                                                          <?php endif; ?>
                                                      </td>
                                                      <td>
                                                          <?php if($value->enroll_status ==0): ?>
                                                              <?php echo e('Pending'); ?>

                                                          <?php elseif($value->enroll_status ==1): ?>
                                                              <?php echo e('Approved'); ?>

                                                          <?php else: ?>
                                                              <?php echo e('Deactivated'); ?>

                                                          <?php endif; ?>
                                                      </td>
                                                      <td>
                                                          <?php if($value->enroll_status ==0): ?>

                                                              <a href="<?php echo e(route('batch_student_approve',$value->id)); ?>"
                                                                 class="btn btn-success" title="approve"><i
                                                                      class="fas fa-check"></i></a>

                                                              <a href="<?php echo e(route('batch_student_reject',$value->id)); ?>"
                                                                 class="btn btn-warning" title="Reject"><i
                                                                      class="fas fa-minus"></i></a>

                                                          <?php endif; ?>

                                                          <?php if($value->enroll_status ==2): ?>

                                                              <a href="<?php echo e(route('batch_student_activate',$value->id)); ?>"
                                                                 class="btn btn-success" title="Activate"><i
                                                                      class="fas fa-trash-restore-alt"></i></a>
                                                          <?php else: ?>
                                                              <a href="<?php echo e(route('batch_student_deactivate',$value->id)); ?>"
                                                                 class="btn btn-close" title="Deactivate"><i
                                                                      class="fas fa-trash"></i></a>
                                                          <?php endif; ?>


                                                            <?php if( $value->student): ?>
                                                                <a href="<?php echo e('/admin/student_info/' . $value->student->id); ?>" class="btn btn-info" title="edit">Details</a>
                                                            <?php endif; ?>
                                                      </td>
                                                  </tr>
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                              <?php endif; ?>
                                              </tbody>
                        </table>
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
                    pageLength: 100,
                    buttons: ['csv'],
                    serverSide: false,
                }
            );
        });

        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>