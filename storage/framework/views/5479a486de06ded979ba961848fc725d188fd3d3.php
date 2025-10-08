<?php $__env->startSection('content'); ?>

<div class="row container">

    <div class="centerText"><h3><?php echo e($modelTestName); ?></h3></div>
    <div class="centerText"><h3>Total marks <?php echo e($modelTestMarks); ?></h3></div>
    <div class="centerText"><h3>This merit list follows FCPS standard</h3></div>
    <div class="centerText"><h3>Your Rank : <?php echo e($userRank + 1); ?></h3></div>   
    

    <table class="table">
        <thead>
        <tr>
            <th>Serial</th>
            <th>Name</th>
            <th>Marks</th>
            <th>Percentage</th>
            <th>Remark</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        
            $key=($modeltest->perPage() * ($modeltest->currentPage()-1))+1;

        ?>
        <?php $__currentLoopData = $modeltest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                
            <tr>
                <td><?php echo e($key++); ?></td>
        
                <td><?php echo e($data->students->name??'-'); ?></td>
                <td><?php echo e($data->point); ?></td>
                <td><?php echo e($data->percentage ? $data->percentage . "%" : ""); ?></td>
                <td><span style="color:<?php echo e($data->percentage < 70 ? 'red' : 'green'); ?>"><?php echo e($data->pass_status); ?></span></td>
            </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</div>


<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>