<?php $__env->startSection('content'); ?>
    <div class="profileContainer">
            
    
        <div class="row">
            
            <div class="col-4">&nbsp</div>
    
            <div class="col-4">
                
                <?php $__currentLoopData = $enrolledBatches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
 
                    <?php if($batch->fild_9): ?>
                    
                    
                        <?php
                            $endStr = substr($batch->subscription_end,0,10);
                            
        
                            $end = new DateTime($endStr);
        
                            $current = new DateTime(date("Y-m-d"));
        
        
                            $remaining = $end->diff($current)->format('%a');
                        
                        ?>
                        
                        <div class="enrolledProgram">
      
                            <h2 class="batchTitle"><?php echo e($batch->title); ?></h2>


                            <div>
                                Subscription remaining : <span class= <?php echo e((int)$remaining <= 15 ? "red" : "green"); ?>><?php echo e($remaining); ?> Days</span> 
                            </div>

                        
                            
                            <div style="padding-top: 2rem; padding-bottom: 2rem;">
                                                                       <a class="centerText liveLink linkCategory" href="<?php echo e($batch->fild_9); ?>">Join Live Class</a>
                            
                            </div>
                        
                        </div>

                    <?php endif; ?>

        		    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
            </div>
            
            <div class="col-4">&nbsp</div>
            
          </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>