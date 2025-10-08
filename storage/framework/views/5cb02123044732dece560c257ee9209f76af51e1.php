<?php $__env->startSection('content'); ?>
 

<div class="container">
    
    <?php $key=($point->perPage() * ($point->currentPage()-1))+1; ?>
    <?php $__currentLoopData = $point; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php $modeltest = App\Modeltest:: where('id',$data->modeltest_id)->first(); ?> <?php if($modeltest): ?>
    
        <div class="row resultContainer">
            <div class="col-4">&nbsp</div>
            
            <div class="col-4 round result">
                <h3><?php echo e($modeltest->name); ?></h3>

                <div style="margin-top: 1rem;">

                    <a href="/seeQuizResult/<?php echo e($data->modeltest_id); ?>" class="resultButton">Solve
                            Sheet</a>
                    <?php if($modeltest->solve_shet != "null"): ?>
                        <a href="/solve_class/<?php echo e($data->modeltest_id); ?>" class="resultButton">Solve
                            class</a>
                    <?php endif; ?>
                </div>
            </div>      
        </div>
    <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    <?php echo e($point->links()); ?>

</div>
                        

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>