<?php $__env->startSection('content'); ?>

    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            Batch Duration & Fees
                        </div>
                        <div class="col-md-2 align-right btn btn-primary">
                            <i class="fas fa-plus"></i>
                            <a href="<?php echo e(route('add.duration')); ?>" style="color: #fff;">Add Batch Duration</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <?php if(session()->has('success')): ?>
                        <script>
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Batch Duration Created',
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
                                title: 'Batch Duration Updateed',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        </script>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-bordered durationTable yajra-datatable" style="width: 98%">
                            <thead>
                            <tr role="row">
                                <th>ID</th>
                                <th>Batch Name</th>
                                <th>Batch Duration</th>
                                <th>Fees</th>
                                <th>Information</th>
                                <th style="width:136px;">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $allBatchDuration; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($data->bd_id); ?></td>
                                    <td><?php echo e($data->plan); ?></td>
                                    <td><?php echo e($data->bd_duration); ?> Days</td>
                                    <td><?php echo e($data->bd_fee); ?> Taka</td>
                                    <td><?php echo e($data->information); ?></td>
                                    <td align="center">
                                        <a href="<?php echo e(url('/admin/admission/editbatchduration/'.$data->bd_id)); ?>"
                                           class="btn btn-info" title="edit"><i class="fas fa-pencil-alt"></i></a>
                                    <!--                                     <a href="<?php echo e(url('/admin/addmition/batch/delete/'.$data->bd_id)); ?>" class="btn btn-danger" title="trash"><i class="fas fa-trash"></i></a>-->
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
    </div>


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