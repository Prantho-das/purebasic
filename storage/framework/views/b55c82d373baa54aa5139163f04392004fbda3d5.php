<?php $__env->startSection('content'); ?>
    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            Student List
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered yajra-datatable" style="text-transform: capitalize;" width="100%">
                                        <thead>
                                        <tr role="row">
                                            <th>Student ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>otp</th>
                                            <th>Country</th>
                                            <th>status</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(!empty($items)): ?>
                                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="takbir">
                                                    <td><a href="/admin/student_info/<?php echo e($data->id); ?>"><h3><?php echo e($data->id); ?></h3></a></td>
                                                    <td><?php echo e($data->name); ?></td>

                                                    <td style="text-transform: lowercase;"><?php echo e($data->email); ?></td>
                                                    <td> <?php echo e($data->mobile); ?></td>
                                                    <td><?php echo e($data->otp); ?></td>
                                                    <td><?php echo e($data->country); ?></td>
                                                    <td>
                                                        <?php if($data->status==1): ?>
                                                            <?php echo e('Active'); ?>

                                                        <?php else: ?>
                                                            <?php echo e('Inactive'); ?>

                                                       <?php endif; ?>












                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer small text-muted">
                        <?php echo e($items->links()); ?>

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
                }
            );
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>