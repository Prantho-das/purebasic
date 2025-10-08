<?php $__env->startSection('content'); ?>



    <div class="row container" style="margin-top:1rem;">

        <div class="col-3">&nbsp</div>
  
        <div class="col-6 submitForm">
      
            <div class="progress">
                <span style='font-size:1.5rem; color: #0066ff;'>Step 1</span>
                <span  style='font-size:3rem; color: #0066ff;'>&#x2192</span>
                <span style='font-size:1.5rem; color: #39393a;'>Step 2</span>
            </div>
            
            <form action="<?php echo e(url('/student/'.$student->id.'/reset_pass_submit')); ?>"
                  method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <h3><label>We have sent an otp to <?php echo e($student->mobile); ?>. Please enter the otp here</label></h3>
                <input type="text" name="otp" placeholder="Enter OTP Code" style="margin-bottom:1rem;" required>
                    <?php if($errors->has('otp')): ?>
                        <span role="alert">
                        <strong><?php echo e($errors->first('otp')); ?></strong>
                    </span>
                    <?php endif; ?>
                
                      
                <h3><label>Choose a new password</label></h3>
                <input type="password" name="password" placeholder="New Password" required>
                    <?php if($errors->has('password')): ?>
                        <span role="alert">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>

                <input type="password" name="password_confirmation"
                       placeholder="Re-Type Password" style="margin-top:1rem;" required>

                <button type="submit" class="submitButton">
                    <h3>Next</h3>
                </button>


            </form>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>