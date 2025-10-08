<?php $__env->startSection('content'); ?>
    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <?php echo e($batchName); ?>

                        </div>
                        

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
                                <th>WhatsApp</th>
                                <th>Address</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Reference</th>
                                <th>Subs. Remaining</th>
                                <th>Information</th>
                                <th style="width:136px;">Manage</th>
                            </tr>
                            </thead>

                                              <tbody>
                                              <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              
                                                  <?php
                                                    $due = $value->payable - $value->paid;
                                                  ?>
                                                  <tr style="background: <?php echo e($due != 0 ? 'red' : ''); ?>; color: <?php echo e($due != 0 ? 'white' : ''); ?>">
                                                      <td><a href="<?php echo e('/admin/student_info/' . $value->student->id . ''); ?>"><?php echo e($value->student->id??''); ?></a></td>
                                                      <td><?php echo e($value->student->name??''); ?></td>
                                                      <td><?php echo e($value->student->mobile??''); ?></td>
                                                      <td><?php echo e($value->student->whatsapp_number??''); ?></td>
                                                      <td><?php echo e($value->student->address??''); ?></td>
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
                                                      <td><?php echo e($value->information??''); ?></td>
                                                      <td>
                                                            <?php if( $value->student): ?>
                                                                <a href="<?php echo e('/admin/updateInformation/user/' . $value->student->id . '/batch/' . $batchId . '/batchSubscription/' . $value->id); ?>" class="btn btn-info" title="edit">Update</a>
                                                            <?php endif; ?>
                                                      </td>
                                                  </tr>
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                }
            );
        });


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>