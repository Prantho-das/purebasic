<?php $__env->startSection('content'); ?>
    <div class="profileContainer">
    
        <div class="row">
            
            <div class="col-4">&nbsp</div>
    
            <div class="col-4">
                
                <?php $__currentLoopData = $enrolledBatches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
                    
                    <?php $__currentLoopData = $sub_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                        <?php if(!empty($batch->course)): ?>
                        
                            <div class="enrolledProgram">
                  
                                <h2 class="batchTitle"><?php echo e($batch->course->plan); ?></h2>
            
                            
                                <h5>For <?php echo e($batch->course->graduation); ?></h5>
                                
                                <div class="marginBelow">
                                    
                                    <?php if($batch->enroll_status == 0): ?>
                                        <h5>Approval Status : <span class="red">Pending</span></h5>
                                        <a class="verifyLink centerText" href="<?php echo e(url('/updateInfo/' . $id . '/batch/' .$batch->batch_id)); ?>">Update Payment Info</a>

                                            
                                    <?php elseif($batch->enroll_status == 1): ?>
                                        <h5>Approval Status : <span class = "green">Activated</span></h5>
                                    
                                        
                                        
                                    <?php else: ?>
                                        <h5>Approval Status : <span class="red">Deactivated/Rejected </span></h5>
                                    <?php endif; ?>
      
    
                                    
                                </div>
                                
                                <div>Fees : <?php echo e($batch->fees); ?><span style="float:right">Paid : <?php echo e($batch->paid); ?></span></div>

    
                                <?php if($batch->enroll_status==1): ?>
                                
                                    <?php
                                        $endStr = substr($batch->subscription_end,0,10);
                                        

                                        $end = new DateTime($endStr);
    
                                        $current = new DateTime(date("Y-m-d"));
    
    
                                        $remaining = $end->diff($current)->format('%a');;
                                    
                                    ?>
                                    
                                    <?php if($current <= $end): ?>
                                    
                                        <div>Subscription End : <?php echo e($endStr); ?></div>
    
                                        
                                        <div>
                                            Subscription remaining : <span class= <?php echo e((int)$remaining <= 15 ? "red" : "green"); ?>><?php echo e($remaining); ?> Days</span> 
                                        </div>
                                        
                                    <?php else: ?>
                                        <div class="red">Subscription Over</div>                                    
                                    
                                    <?php endif; ?>
                                    
                                    
                                    
                                    
                                <?php elseif($batch->enroll_status == 0): ?>
                                    <h5 class="red">Please wait 24 hours for approval</h5>                                
                                <?php else: ?>
                                    <h5 class="red">Please whatsapp us</h5>
                                <?php endif; ?>
                                
                            </div>
                		  
                        <?php endif; ?>
              
        		    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        		    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
            </div>
            
            <div class="col-4">&nbsp</div>
            
          </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>