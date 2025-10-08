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
                <form action="<?php echo e(url('admin/chapter/create')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <label for="nf-email" class="form-control-label">Subject</label>
                        <select name="cat_id" class="form-control">
                        <?php
                           $chapter=App\Category::where('status',1)->latest('id')->get();
                        ?>
                        <?php $__currentLoopData = $chapter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($chap->id); ?>"><?php echo e($chap->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
                    </div>

                    <div class="form-group">
                        <label for="nf-email" class="form-control-label">Create a new chapter</label>
                    </div>

                    <div class="form-group">
                        <label for="nf-email" class="form-control-label">Chapter Name</label>
                        <input type="text" name="name" class="form-control" />
                    </div>
                    
                    <div class="form-group">
                        <label for="nf-email" class="form-control-label">Literature</label>
                        <input type="text" name="literature" class="form-control" />
                    </div>
                    
                    <div class="form-group">
                        <label for="nf-email" class="form-control-label">Chapter Serial</label>
                        <input type="number" name="serial" class="form-control" />
                    </div>
                    
                    <div class="form-group">
                        <label for="nf-email" class="form-control-label">Question Bank Chapter Serial</label>
                        <input type="number" name="qb_serial" class="form-control" />
                    </div>


                    <div class="form-group">
                        <label for="nf-email" class="form-control-label">Price</label>
                        <input type="number" name="price" class="form-control" />
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-dot-circle-o"></i> Create Chapter</button>
                </form>
            </div>
            <div class="card-footer small text-muted"></div>
            <div class="table-responsive">
    			<table class="table table-bordered dataTable" width="100%">
    				<thead>
    					<tr role="row">
    						<th>Chapter Name</th>
    						<th>Subject Id</th>
    						<th>Subject Name</th>
    						<th>Serial</th>
    						<th>Question Bank Serial</th>
    						<th>Price</th>
    						<th>Manage</th>
    					</tr>
    				</thead>
    				<tbody>
    					<?php
    						$chap=App\Chapter:: where('status',1)->latest('id')->get();
    					?>
    					<?php $__currentLoopData = $chap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    					<tr>
    						<td><?php echo e($dataa->name); ?></td>
    						<td><?php echo e($dataa->cat_id); ?></td>
    						<td><?php echo e($dataa->subject); ?></td>
    						<td><?php echo e($dataa->serial); ?></td>
    						<td><?php echo e($dataa->qb_serial); ?></td>
    						<td><?php echo e($dataa->price); ?></td>
    
    						<td>
    							<a href="<?php echo e(url('admin/chapter/edit/'.$dataa->id)); ?>" title="edit" class="btn btn-info">Edit</a>
    							<a href="<?php echo e(url('admin/chapter/delete/'.$dataa->id)); ?>" title="off"><i class="fa fa-trash-alt btn btn-danger"></i></a>
    						</td>
    					</tr>
    					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    				</tbody>
    			</table>
			</div>
        </div>
    </div>
	<div class="container-fluid">
		<div class="row">
			
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>