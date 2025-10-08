 <?php $__env->startSection('content'); ?>
<div id="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10"></div>
                </div>
            </div>
            <div class="card-body">
                <form action="<?php echo e(url('admin/chapter/edit/'.$data->id)); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <label for="nf-email" class="form-control-label">Chapter Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo e($data->name); ?>"/>
                    </div>
                    
                    <div class="form-group">
                        <label for="nf-email" class="form-control-label">Literature</label>
                        <input type="text" name="literature" class="form-control" value="<?php echo e($data->literature); ?>"/>
                    </div>
                    
                    <div class="form-group">
                        <label for="nf-email" class="form-control-label">Chapter Serial</label>
                        <input type="number" name="serial" class="form-control" value="<?php echo e($data->serial); ?>"/>
                    </div>
                    
                    <div class="form-group">
                        <label for="nf-email" class="form-control-label">Question Bank Chapter Serial</label>
                        <input type="number" name="qb_serial" class="form-control" value="<?php echo e($data->qb_serial); ?>"/>
                    </div>
                    
                    <div class="form-group">
                        <label for="nf-email" class="form-control-label">Price</label>
                        <input type="number" name="price" class="form-control" value="<?php echo e($data->price); ?>"/>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> Submit</button>
                </form>
            </div>
            
    </div>
	<div class="container-fluid">
		<div class="row">
			
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>