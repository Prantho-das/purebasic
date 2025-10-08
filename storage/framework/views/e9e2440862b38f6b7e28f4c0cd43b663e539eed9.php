<?php $__env->startSection('content'); ?>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="register_bg">
                      <div class="row">
                      <div class="col-md-2"></div>
                      <div class="col-md-8">
                        <img src="<?php echo e(asset('contents/website')); ?>/img/aaaa1.jpg" width="100%" style="margin-bottom: 20px;">
                          <div class="register_form">
                              <form class="" id="registration" action="<?php echo e(url('/demo/student/submit')); ?>" method="post" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="form-group<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" placeholder="Full Name">
                                    <?php if($errors->has('name')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('name')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>">
                                    <label>E-Mail</label>
                                    <div>
                                        <input type="email" class="form-control"  name="email" value="<?php echo e(old('email')); ?>" placeholder="Enter a valid e-mail">
                                        <?php if($errors->has('email')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('email')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                

                                <div class="form-group<?php echo e($errors->has('mobile') ? ' is-invalid' : ''); ?>">
                                    <label>Phone Number</label>
                                    <div>
                                        <input name="mobile" data-parsley-type="number" maxlength="11" minlength="11" value="<?php echo e(old('mobile')); ?>" type="text" class="form-control"  placeholder="Mobile Number" minlength="11" maxlength="11">
                                        <?php if($errors->has('mobile')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('mobile')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>



                                <div class="form-group<?php echo e($errors->has('medical') ? ' is-invalid' : ''); ?>">
                                    <label>Medical / Dental college</label>
                                    <div>
                                        <input name="medical" value="<?php echo e(old('medical')); ?>" type="text" class="form-control"  placeholder="Your answer">
                                        <?php if($errors->has('medical')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('medical')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
								  
								   <div class="form-group" style="display:none">
                                         <div>
                                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                 <input type="hidden" name="group" value="6" >
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>



                                <div class="form-group<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>">
                                    <label>Pasword</label>
                                    <div>
                                        <input type="password" name="password" class="form-control" value="<?php echo e(old('password')); ?>"  placeholder="Password">
                                        <?php if($errors->has('password')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('password')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="m-t-10">
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Re-Type Password">
                                    </div>
                                </div>

                                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                                            Registration
                                        </button>


                            </form>
                          </div>
                      </div>
                      <div class="col-md-2"></div>
                  </div>
                    </div>
                </div>
            </div>
        </div>


  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>


<script>
$(function(){
    $('#doctor').hide();

    $('.doctor').on('click',function(){
        $('#doctor').toggle();
    })

})

$(function(){
    $('#student').hide();

    $('.student').on('click',function(){
        $('#student').toggle();
    })

})

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>