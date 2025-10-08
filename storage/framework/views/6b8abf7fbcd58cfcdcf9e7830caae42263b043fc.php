<?php $__env->startSection('content'); ?>
    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            Payment Transaction List
                        </div>

                        <form action="<?php echo e(route('payment_data_load')); ?>" method="post" enctype="multipart/form-data"
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
                                    <select name="app_status" class="col-md-3 form-control-sm">
                                        <option value=""><?php echo e('select'); ?></option>
                                        <option value="0">Pending</option>
                                        <option value="1">Approved</option>
                                        <option value="2">Rejected</option>
                                    </select>

                                    <button type="submit" class="btn btn-primary btn-sm form-control col-md-2">
                                        <i class="fa fa-dot-circle-o"></i> Submit
                                    </button>

                                </div>
                            </div>

                        </form>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered yajra-datatable"
                                           style="text-transform: capitalize;"
                                           width="100%">
                                        <thead>
                                        <tr role="row">
                                            <th>Date</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>Due</th>
                                            <th>Batchpackage</th>
                                            <th>Paid</th>
                                            <th>Plan</th>
                                            <th>Subscription</th>
                                            <th>payment</th>
                                            <th>Taka</th>
                                            <th>transaction</th>
                                            <th>status</th>
                                            <th>Manage</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if($showReport != 0 && count($paidmember) > 0): ?>
                                        <?php $__currentLoopData = $paidmember; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($data->id): ?>
                                                <tr class="takbir">
                                                    <td><?php echo e(date("d, F, Y", strtotime($data->created_at))); ?></td>
                                                    <td><?php echo e($data->student_id); ?></td>
                                                    <td><?php echo e($data->name); ?></td>
                                                    
                                                    <td style="text-transform: lowercase;"><?php echo e($data->mobile); ?></td>
                                                    <td><?php echo e($data->address); ?></td>
                                                    <td><?php echo e($data->payable - $data->paid); ?></td>
                                                    <td><?php echo e($data->payable); ?></td>
                                                    <td><?php echo e($data->paid); ?></td>
                                                    <td><?php echo e($data->plan??'-'); ?></td>
                                                    <td><?php echo e($data->bd_duration ??'-'); ?> Days</td>
                                                    <td> <?php echo e($data->mar); ?></td>
                                                    <td> <?php echo e($data->amount??'-'); ?></td>
                                                    <td><?php echo e($data->transaction); ?></td>
                                                    <?php if($data->is_approve ==1): ?>
                                                        <td style="color:green">Approved</td>
                                                    <?php elseif($data->is_approve ==2): ?>
                                                        <td style="color:red">Rejected</td>
                                                    <?php else: ?>
                                                        <td style="color:red">Pending</td>
                                                    <?php endif; ?>

                                                    <td>
                                                        <?php if($data->is_approve ==0): ?>

                                                            <a href="<?php echo e(route('payment_approval',$data->id)); ?>"
                                                               class="btn btn-success" title="approve"><i
                                                                    class="fas fa-check"></i></a>

                                                            <a href="<?php echo e(route('payment_reject',$data->id)); ?>"
                                                               class="btn btn-warning" title="Reject"><i
                                                                    class="fas fa-minus"></i></a>

                                                        <?php endif; ?>
                                                        <form method="post"
                                                              action="<?php echo e(route('payment.destroy',$data->id)); ?>">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('delete'); ?>
                                                            <button
                                                                type="submit" onclick="return confirm('Are you sure?')"
                                                                class="btn btn-dange" title="Delete"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script>
        function showDeleteConfirm() {
            var ask = confirm("Do you want to delete?");
            if (ask) {
                console.log('Click YES');
                window.location.replace("<?php echo e(route('payment.destroy',$data->id)); ?>");
            } else {
                console.log('Click NO');
                window.location.replace("<?php echo e(url('admin/payment')); ?>");

            }

        }
    </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin_js'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.yajra-datatable').dataTable(
                {
                    ordering: false,
                }
            );
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>