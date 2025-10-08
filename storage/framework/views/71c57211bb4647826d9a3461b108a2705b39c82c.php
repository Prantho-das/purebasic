<?php $__env->startSection('content'); ?>

      <!-- Section:about-->

    <div class="row batchInfoContainer">
    
        <div class="col-4">&nbsp</div>
        
            <div class="col-4">
                
                <?php $__currentLoopData = $batchpackages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batchpackage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             
                    <div class="batchInfo">
                     
                        <h2 class="centerText batchTitle"><?php echo e($batchpackage->title); ?></h2>
                        
                        <div class="marginAbove marginBelow">
                            
                            <div class="centerText"><b><?php echo e($batchpackage->fild_1); ?></b></div><br>
                            
                            <?php
                                $packages = explode('\n', $batchpackage->fild_2);
                            ?>
                            <div class="batchPackage centerText"><?php echo $batchpackage->fild_2; ?></div>
                    
                            <!--div class="centerText"><b><?php echo e(count($packages) > 1 ? 'Packages' : 'Package'); ?></b></div>
    
                            <div class="batchPackage centerText">
                                
                                <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
                                    <p><b><?php echo e($package); ?></b></p>
                                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            </div-->
                            
                        </div>
                        
                    
                        <div class="row">
                
                            
                            <!--a class="col-4 centerText batchInfoButton" href="<?php echo e($batchpackage->fild_4); ?>">Content</a>
                            
                            <div class="col-4 hide-on-med">&nbsp</div>
                            
                            
                            <a class="col-4 centerText batchInfoButton" href="<?php echo e($batchpackage->fild_5); ?>">Schedule</a>
                            
                            <div class="col-12 hide-on-med">&nbsp</div-->
                            
                            <a class="col-12 centerText batchDetailsButton" href="<?php echo e(url('/batch_details/'.$batchpackage->batch_id)); ?>">Batch Details</a>
                            
                            <?php if(!in_array($batchpackage->batch_id, $enrolledBatches)): ?>
                            
                                    <a class="col-12 centerText batchInfoButton" href="<?php echo e($batchpackage->module == 1 ? url('/batch/'.$batchpackage->batch_id.'/modules') : url('/student/batch/'.$batchpackage->batch_id.'/enroll')); ?>">Enroll Now</a>
                
                            <?php endif; ?>
                            
                        </div>
                      
                      </div>  
              
            	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        	
        </div>

                
        <div class="col-4">&nbsp</div>
    
    </div>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>