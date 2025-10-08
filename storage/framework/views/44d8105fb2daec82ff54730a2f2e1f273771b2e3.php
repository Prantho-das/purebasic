<?php $__env->startSection('content'); ?>


<div class="row container">

    <div class="centerText"><h3><?php echo e($modelTestName); ?></h3></div>
    <div class="centerText"><h3>Total marks <?php echo e($modelTestMarks / 2); ?></h3></div>
    <div class="centerText"><h3>This merit list follows MS/MD/DDS standard</h3></div>

    <div class="centerText"><h3>Discipline : <?php echo e($discipline_modified); ?></h3></div>
    <div class="centerText"><h3>Candidate Type : </h3></div>
   
    
    <div class="centerText">
        <label><input type="radio" name="candidate" value="Private" onclick='return onRadioSelect(this);' checked><b>Private</b></label>
        <label><input type="radio" name="candidate" value="Government" onclick='return onRadioSelect(this);'><b>Government</b></label>   
    </div>
    
    
    <div id="Private">
        
        <?php if($userRank != null && $candidate == "Private"): ?>
            <div class="centerText"><h3>Your Rank : <?php echo e($userRank + 1); ?></h3></div>   
        <?php endif; ?>
        <table class="table">
            <thead>
            <tr>
                <th>Serial</th>
                <th>Name</th>
                <th>Marks</th>
                <th>Candidate Type</th>
                <th>Discipline</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            
                $key=($privateCandidate->perPage() * ($privateCandidate->currentPage()-1))+1;
    
            ?>
            <?php $__currentLoopData = $privateCandidate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
            
                <?php if(!empty($data->students)): ?>
                
                    <tr>
                            <td><?php echo e($key++); ?></td>
                    
                            <td><?php echo e($data->students->name??'-'); ?></td>
                            <td><?php echo e($data->point_1); ?></td>
                            <td><?php echo e($data->candidate_type); ?></td>
                            <td><?php echo e($data->discipline); ?></td>
                    </tr>
                <?php endif; ?>
        
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    
    
    <div id="Government" style="display:none;"> 
        <?php if($userRank != null && $candidate == "Government"): ?>
            <div class="centerText"><h3>Your Rank : <?php echo e($userRank + 1); ?></h3></div>   
        <?php endif; ?>
        <table class="table">
            <thead>
            <tr>
                <th>Serial</th>
                <th>Name</th>
                <th>Marks</th>
                <th>Candidate Type</th>
                <th>Discipline</th>
            </tr>
            </thead>
            <tbody>
            <?php 
            
                $key=($governmentCandidate->perPage() * ($governmentCandidate->currentPage()-1))+1;
    
            ?>
            <?php $__currentLoopData = $governmentCandidate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
            
                <?php if(!empty($data->students)): ?>
                
                    <tr>
                            <td><?php echo e($key++); ?></td>
                    
                            <td><?php echo e($data->students->name??'-'); ?></td>
                            <td><?php echo e($data->point_1); ?></td>
                            <td><?php echo e($data->candidate_type); ?></td>
                            <td><?php echo e($data->discipline); ?></td>
                    </tr>
                <?php endif; ?>
        
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

</div>

<script>
    function onRadioSelect(obj) {
        var selectedValue = obj.value;
        if (selectedValue == "Private") {
            document.getElementById("Private").style.display = 'block';
            document.getElementById("Government").style.display = 'none';
        }
        else if (selectedValue == "Government") {
            document.getElementById("Private").style.display = 'none';
            document.getElementById("Government").style.display = 'block';
        }        
    }
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>