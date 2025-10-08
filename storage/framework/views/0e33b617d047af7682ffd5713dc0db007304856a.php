<?php $__env->startSection('content'); ?>
    <div class="profileContainer">
        <div class="row batchCategories">
            
            <div class="col-3">&nbsp</div>
                
            <div class="col-6">
            
                    
                <a href="/batches/category/1" class="batchCategory"><h3>Medicine</h3></a>
                
                <a href="/batches/category/2" class="batchCategory" style="margin-right:2%; margin-left:2%;"><h3>Dentistry</h3></a>
                
                <a href="/batches/category/3" class="batchCategory"><h3>BCS</h3></a>
                
            </div>
            
            <div class="col-3">&nbsp</div>
            
        </div>


        <?php if(empty($courses)): ?>
    
            <div class="row">
            
                <div class="col-4">&nbsp</div>
                
                    <div class="col-4 alert">
                        
                        <div class="centerText">
                            <h3>No Enrollment</h3>
                            <p>You have not enrolled in any program. Meanwhile you can enjoy free lectures and free exams</p>
                        </div>
    
                        <div class="row">
                            
                            <div class="col-4 centerText contentLink">
                                <a href="/student/free_lecture"><h3>Free Lectures</h3></a>
    
                            </div>
                            
                            <div class="col-4">&nbsp</div>
                            
                            <div class="col-4 centerText contentLink">
                                <a href="/student/free_exam"><h3>Free Exams</h3></a>
                            </div>
                            
                        </div>
                    
                    </div>
                        
                <div class="col-4">&nbsp</div>
            </div>
    
        <?php endif; ?>
    
            
    
        <div class="row">
            
            <div class="col-4">&nbsp</div>
    
            <div class="col-4">
                
                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
                    
                    <?php $__currentLoopData = $sub_course; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                        <?php if(!empty($course->course)): ?>
                        
                            <div class="enrolledProgram">
                  
                                <h2 class="batchTitle"><?php echo e($course->course->plan); ?></h2>
            
                            
                                <h5>For <?php echo e($course->course->graduation); ?></h5>
                                
                                <div class="marginBelow">
                                    
                                    <?php if($course->enroll_status == 0): ?>
                                        <h5>Approval Status : <span class="red">Pending</span></h5>
                                        <a class="verifyLink centerText" href="<?php echo e(url('/payment/'.$course->batch_id)); ?>">Update Payment Info</a>

                                            
                                    <?php elseif($course->enroll_status == 1): ?>
                                        <h5>Approval Status : <span class = "green">Activated</span></h5>
                                    
                                        
                                        
                                    <?php else: ?>
                                        <h5>Approval Status : <span class="red">Deactivated/Rejected </span></h5>
                                    <?php endif; ?>
      
    
                                    
                                </div>
                                
                                <div>Fees : <?php echo e($course->fees); ?><span style="float:right">Paid : <?php echo e($course->paid); ?></span></div>

    
                                <?php if($course->enroll_status==1): ?>
                                
                                    <?php
                                        $endStr = substr($course->subscription_end,0,10);
                                        
                                        $endNum = (int) $endStr;
                                        
                                        $end = new DateTime($endStr);
    
                                        $current = new DateTime(date("Y-m-d"));
    
    
                                        $remaining = $end->diff($current)->format('%a');;
                                    
                                    ?>
                                
                                    <div>Subscription End : <?php echo e($endStr); ?></div>

                                    
                                    <div>
                                        Subscription remaining : <span class= <?php echo e((int)$remaining <= 15 ? "red" : "green"); ?>><?php echo e($remaining); ?> Days</span> 
                                    </div>

                                    <?php if($endNum > 0): ?>
                                        <div style="padding-top: 2rem; padding-bottom: 2rem;">
                                            <a class="centerText lectureLink linkCategory" href="<?php echo e(url('batch/'.$course->batch_id.'/subjects')); ?>">Lecture</a>

                                            <a class="centerText examLink linkCategory" href="<?php echo e(url('exam_by_batch',$course->batch_id)); ?>">Exam</a>
                                    
                                            <a class="centerText scheduleLink linkCategory" href="<?php echo e(url('schedule/batch/'.$course->batch_id)); ?>">Schedule</a>
                                            
                                        </div>

                                        <div style="padding-top: 2rem; padding-bottom: 2rem;">
                                                                                   <a class="centerText discussionLink linkCategory" href="<?php echo e(url('discussion/batch/'.$course->batch_id)); ?>">Discussion</a>
                                        
                                        </div>
                                        
                                        <div style="padding-top: 2rem; padding-bottom: 2rem;">
                                                                                   <a class="centerText liveLink linkCategory" href="<?php echo e(url('live/'.$course->batch_id)); ?>">Live Class</a>
                                        
                                        </div>

                                    <?php endif; ?>
                                    
                                    
                                    
                                    
                                <?php elseif($course->enroll_status == 0): ?>
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