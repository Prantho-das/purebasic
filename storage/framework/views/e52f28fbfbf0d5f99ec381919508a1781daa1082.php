
<?php $__env->startSection('content'); ?>
 



<div class="row container" style="margin-top:0.5rem;">

    <div class="col-3">&nbsp</div>
    
    <div class="col-6 submitForm">

        <div class="progress">
            <span style='font-size:1.5rem; color: #0066ff;'>Step 1</span>
            <span  style='font-size:3rem; color: #0066ff;'>&#x2192</span>
            <span style='font-size:1.5rem; color: #0066ff;'>Step 2</span>
            <span  style='font-size:3rem; color: #0066ff;'>&#x2192</span>
            <span style='font-size:1.5rem; color: #39393a;'>Step 3</span>
        </div>
        
        <div style="margin: 0.1rem;">&nbsp;</div>
        <h3 style="color: red;">WhatsApp <a style="color: green;" href="https://api.whatsapp.com/send?phone=%2B8801673652555">+8801673652555 </a> if you do not receive otp..</h3>
        <a id="resend" href="<?php echo e('/student/otp/' . $id . '/login'); ?>" style="font-size: 1.3rem; background: #3b93ef; color: white; padding: 0.5rem; border-radius: 0.3rem;">Resend OTP</a>

        <div id="otpSection">
                
            <form method="post" action="<?php echo e(url('student/otp/verify/'.$student->id.'/'.$is_login)); ?>">
              <?php echo csrf_field(); ?>
              
                    <h3><label>We have sent an OTP to <?php echo e($student->mobile); ?>; Please enter the OTP and click Next..</label></h3>
                    <h3><span>Time Remaining </span><label timer id='timer' class="timer"></label></h3>
                    
                    <input name="otp" type="text" placeholder="OTP" required value="<?php echo e($otpRequired == 0 ? $otp : ""); ?>">
                <?php if($errors->has('otp')): ?>
                  <span role="alert">
                      <strong><?php echo e($errors->first('otp')); ?></strong>
                  </span>
                <?php endif; ?>
    
    
              <?php if(Session:: has('error')): ?>
                <div class="alert alert-danger" role="alert">
                 Wrong OTP Please Enter Valid OTP 
                </div>
             <?php endif; ?>
             
                <button type="submit" class="submitButton"><h3>Next</h3></button>
                
            </form>
        </div>
        
  </div>
</div>

<script>
    var timeoutHandle;
    function countdown(minutes, seconds) {
        
        document.getElementById("resend").style.display = "none";
        
        function tick() {
            var counter = document.getElementById("timer");
            counter.innerText =
                minutes.toString() + ":" + (seconds < 10 ? "0" : "") + String(seconds);
            seconds--;
            if (seconds > 0) {
                timeoutHandle = setTimeout(tick, 1000);
            } else if (seconds == 0) {
                document.getElementById("otpSection").style.display = "none";
                document.getElementById("resend").style.display = "inline";                
            } else {
                if (minutes >= 1) {
                    setTimeout(function () {
                        countdown(minutes - 1, 59);
                    }, 1000);
                }
            }
        }
        tick();
            
    }
    
    countdown(2, 00);
    
    

    
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>