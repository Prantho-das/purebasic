<?php $__env->startSection('content'); ?>
            <?php if(Session:: has('error')): ?>
                <div class="alert">
                  Please provide a valid email or mobile number
                </div>
             <?php endif; ?>

    <div class="row container" style="margin-top:1rem;">

        <div class="col-3">&nbsp</div>
  
        <div class="col-6 submitForm">
      
            <div class="progress">
                <span style='font-size:1.5rem; color: #0066ff;'>Step 1</span>
                <span  style='font-size:3rem; color: #39393a;'>&#x2192</span>
                <span style='font-size:1.5rem; color: #39393a;'>Step 2</span>
            </div>
            
            <form action="<?php echo e(url('/student/reset_otp')); ?>" method="post" id="searchForm">
                    <?php echo csrf_field(); ?>
                    
                <h3><label id ="loginOption" for="email"></label></h3>
                
                <input type="text" name="email" placeholder="Phone Number" id="mobile" required>
                
                <button type="submit" class="submitButton">
                    <h3>Next</h3>
                </button>
                
            </form>
        </div>
    </div>

    <!--script>

        var elem = document.getElementById("loginOption");
        
        if(Intl.DateTimeFormat().resolvedOptions().timeZone.split('/')[1]=="Dhaka"){ 
            
            elem.innerText = "To reset password, please enter your valid phone number and click Next";

        }
        else {
            
            elem.innerText = "To reset password, please enter your valid email address and click Next..";

        }
    </script-->
    

    <script>
    
        var searchForm = document.getElementById('searchForm');
        searchForm.onsubmit = function(){
            let mobile = document.getElementById('mobile');
            let newValue = mobile.value.replace(/\D/g,'');
            newValue = newValue.replace(/^(88)/,"");
            mobile.value = newValue;
            searchForm.submit();
        };
    
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>