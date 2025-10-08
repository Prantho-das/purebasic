<?php $__env->startSection('content'); ?>

    <div class="container">
    
            <div class="row" style="margin-top:3rem;">
                
                <div class="col-4">&nbsp</div>

                <div class="col-4">
                    <?php
                        
                        if ($otpRequired == 1) {
                        
                            $otpStatus = '/admin/disable/otpRequired/' . $studentId;
                        
                        } else {
                        
                             $otpStatus = '/admin/enable/otpRequired/' . $studentId;
                           
                        }
                        
                    ?>

                    <div style="margin: 1rem;"><a class ="loginButton" href="<?php echo e('/admin/profile/user/' . $studentId); ?>">Profile</a></div>
                    <div style="margin: 1rem;"><a class ="loginButton" href="<?php echo e('/admin/updateProfile/user/' . $studentId); ?>">Update Profile</a></div>
                    <div style="margin: 1rem;"><a class ="loginButton" href="<?php echo e('/admin/payment/user/' . $studentId); ?>">Payment History</a></div>    
                    <div style="margin: 1rem;"><a class ="loginButton" href="<?php echo e('/admin/lecture/user/' . $studentId); ?>">Lecture</a></div>    
                    <div style="margin: 1rem;"><a class ="loginButton" href="<?php echo e('/admin/live_class/user/' . $studentId); ?>">Live Class</a></div>    
                    <div style="margin: 1rem;"><a class ="loginButton" href="<?php echo e('/admin/discussion/user/' . $studentId); ?>">Discussion</a></div>    
                    <div style="margin: 1rem;"><a class ="loginButton" href="<?php echo e('/admin/exam/user/' . $studentId); ?>">Model Test</a></div>    
                    <div style="margin: 1rem;"><a class ="loginButton" href="<?php echo e('/admin/modeltest/user/' . $studentId); ?>">Model Test History</a></div>
                    <div style="margin: 1rem;"><a class ="loginButton" href="<?php echo e($otpStatus); ?>"><?php echo e($otpRequired == 1 ? 'Disable OTP' : 'Enable OTP'); ?></a></div>    



                </div>
                
                
                <div class="col-4">&nbsp</div>


            <div>


    </div>
    


</script>
                

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>