<?php $__env->startSection('content'); ?>


    <div class="container">
    
            <div class="row" style="margin-top:3rem;">
                
                <div class="col-4">&nbsp</div>

                <div class="col-4">
                    
                    <form action="<?php echo e(url('/admin/updateProfile/user/' . $profile["id"])); ?>" method="post">
                        <?php echo csrf_field(); ?>
                    
                        <div>
                            <label for="id" >ID : <?php echo e($profile["id"]); ?></label>
                        </div>
                        
                        <div>
                            <label for="name">Name : </label>
                            <input name="name" type="text" value="<?php echo e($profile["name"] ? $profile["name"] : ''); ?>">
                        </div>
                        
                        <div>
                            <label for="mobile">Mobile : </label>
                            <input name="mobile" type="text" value="<?php echo e($profile["mobile"] ? $profile["mobile"] : ''); ?>">                   
                        </div>
                        
                        <div>
                            <label for="email">Email : </label>
                            <input name="email" type="text" value="<?php echo e($profile["email"] ? $profile["email"] : ''); ?>">  
                        </div>
                    
                        <div>
                            <label for="address">Address : </label>
                            <input name="address" type="text" value="<?php echo e($profile["address"] ? $profile["address"] : ''); ?>">
                        </div>
                        
                        <div>
                            <label for="password">password : </label>
                            <input name="password" type="text" placeholder="Change Password"">                    
                        </div>
                        
                        <button type="submit" class="submitButton">
                            <h3>Update</h3>
                        </button>
                        
                    </form>
                    

                </div>
                
                
                <div class="col-4">&nbsp</div>


            <div>


    </div>
    


</script>
                

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>