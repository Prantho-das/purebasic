<?php $__env->startSection('content'); ?>

    <div class="w3-row">
        <div class="w3-quarter">&nbsp</div>
        <div class="w3-half">
            <div class="w3-card-4 w3-margin">
                <form class="w3-container" id="registration" action="<?php echo e(url('/student/register/submit')); ?>"
                      method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <h2>
                        Register Account
                    </h2>
                    <div class="w3-section">
                        <label><b>Name<b></label>
                        <input type="text" class="w3-input w3-border" name="name" value="<?php echo e(old('name')); ?>"
                               placeholder="Name as per NID" required>
                        <?php if($errors->has('name')): ?>
                            <span class="invalid-feedback" role="alert">
                            <strong class="w3-red"><?php echo e($errors->first('name')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                    <div class="w3-section">
                        <label><b>E-Mail<b></label>
                        <div>
                            <input type="email" class="w3-input w3-border" name="email"
                                   value="<?php echo e(old('email')); ?>" placeholder="Valid Email Address" required>
                            <?php if($errors->has('email')): ?>
                                <span class="invalid-feedback" role="alert">
                                <strong class="w3-red"><?php echo e($errors->first('email')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
    
    
                    <div class="w3-section">
                        <label><b>Phone Number<b></label>
                        <div>
                            <input name="mobile" data-parsley-type="number" maxlength="15" minlength="9"
                                   value="<?php echo e(old('mobile')); ?>" type="text" class="w3-input w3-border"
                                   placeholder="Valid Phone Number" minlength="9" maxlength="15" required>
                            <?php if($errors->has('mobile')): ?>
                                <span class="invalid-feedback" role="alert">
                                <strong class="w3-red"><?php echo e($errors->first('mobile')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
    
    
    				<div class="w3-section">
                        <label><b>Country<b></label>
                        <div>
    						<select name="country" class="w3-select">
    						  <option value="Bangladesh" >Bangladesh</option>
    						  <option value="Other">Other Country</option>
    						</select>
                            <?php if($errors->has('country')): ?>
                                <span class="invalid-feedback" role="alert">
                                <strong class="w3-red"><?php echo e($errors->first('country')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
    
    
                    <div class="w3-section">
                        <label><b>Choose a password<b></label>
                        <div>
                            <input type="password" name="password" class="w3-input w3-border"
                                   value="<?php echo e(old('password')); ?>" placeholder="Password" required>
                            <?php if($errors->has('password')): ?>
                                <span class="invalid-feedback" role="alert">
                                <strong class="w3-red"><?php echo e($errors->first('password')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                        <div class="w3-section">
                            <input type="password" class="w3-input w3-border" name="password_confirmation"
                                   placeholder="Re-Type Password" required>
                        </div>
                    </div>
    
                    <div class="w3-section">
                        <button type="submit" class="w3-btn w3-black">
                            Register
                        </button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function () {
            $("#datepicker").datepicker();
        });
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>