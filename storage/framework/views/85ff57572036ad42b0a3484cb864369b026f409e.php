<?php $__env->startSection('content'); ?>
 

<div class="container">
    
    <?php $key=($point->perPage() * ($point->currentPage()-1))+1; ?>
    <?php $__currentLoopData = $point; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php $modeltest = App\Modeltest:: where('id',$data->modeltest_id)->first(); ?> <?php if($modeltest): ?>
    
        <div class="row resultContainer">
            <div class="col-4">&nbsp</div>
            
            <div class="col-4 round result">
                <h3><?php echo e($modeltest->name); ?></h3>
                <?php if($modeltest->exam_pattern == "Regular exam"): ?>
                    <div>
                        <p>Obtained Marks</p>
                        <p>FCPS Standard :  <b><?php echo e($data->point . " out of " . $modeltest->exam_in_minutes . " (" . $data->percentage . "%)"); ?></b>
                        </p>
                        <p>MS/MD/DDS Standard : <b><?php echo e($data->point_1 . " out of " . $modeltest->exam_in_minutes / 2); ?></b>
                        </p>
                    </div>
                <?php else: ?>
                     <span>
                        Total Marks <b><?php echo e($modeltest->exam_in_minutes); ?></b> <br>
                        Obtained Marks <b><?php echo e($data->point . " out of " . $modeltest->exam_in_minutes . "(" . $data->percentage . "%)"); ?></b>
                    </span>               
                <?php endif; ?>
                
                <div style="margin-top: 1rem;">
                    <?php if($modeltest->exam_pattern == "Regular exam"): ?>
                        <div style="margin-bottom: 1rem;">
                            <a href="/exam/point/list/fcps/<?php echo e($data->modeltest_id); ?>" class="resultButton">FCPS merit list</a>
                            <a href="/exam/point/list/ms_md_dds/<?php echo e($data->modeltest_id); ?>" class="resultButton" >MS/MD/DDS merit list</a>
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <a href="/exam/point/list/discipline/<?php echo e($data->modeltest_id); ?>" class="resultButton">Discipline wise merit list</a>
                        </div>

                    <?php else: ?>
                    
                        <a href="/exam/point/list/<?php echo e($data->modeltest_id); ?>" class="resultButton">Merit List</a>                   
                    <?php endif; ?>

                    <a href="/spacialmodeltest-examm/<?php echo e($data->modeltest_id); ?>" class="resultButton">Solve
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