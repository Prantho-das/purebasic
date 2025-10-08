<?php $__env->startSection('content'); ?>
    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <a href="<?php echo e(url('/admin/addmition/batch')); ?>"></a>
                            Create New Batch</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(url('admin/addmition/batch/add')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>


                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Batch Name</label>
                            <input type="text" name="plan" class="form-control" value=" th Online Batch">
                        </div>
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Batch Type</label>
                            <select name="type" class="form-control">
                                <option value="medicine">Medicine</option>
                                <option value="dentistry" selected>Dentistry </option>
                                <option value="bcs">BCS </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Post Graduation Coverage</label>
                            <input type="text" name="graduation" class="form-control" value="FCPS Part 1, MS, MD, DDS">
                        </div>
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Duration</label>
                            <input type="text" name="duration" class="form-control" value="7 months">
                        </div>

                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Admission fee</label>
                            <input type="text" name="ammount" class="form-control" value="9500 Taka">
                        </div>

                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Batch Id</label>
                            <input type="text" name="batch_id" class="form-control" value="<?php echo e($lastId->id + 1); ?>">
                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="show" checked> Show in home page
                        </div>


                        <div class="form-group">
                            <input type="checkbox" name="courier" checked> Courier Address Needed
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                    </form>
                </div>
                <div class="card-footer small text-muted">Update</div>
            </div>

        </div>

    </div>

    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>