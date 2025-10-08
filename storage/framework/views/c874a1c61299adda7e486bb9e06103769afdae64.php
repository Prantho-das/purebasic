<?php $__env->startSection('content'); ?>


    <div class="container">
    
            <div class="row" style="margin: 3rem 1rem;">
                

                <div>
                    
                    <form action="<?php echo e(url('/admin/updateInformation/user/' . $studentId . '/batch/' . $batchId . '/batchSubscription/' . $enrollId)); ?>" method="post">
                        <?php echo csrf_field(); ?>

                        <div>
                            <label>Pure Basic ID : <?php echo e($profile["id"]); ?></label>
                        </div>
                        
                        <div>
                            <label>Name : <?php echo e($profile["name"] ? $profile["name"] : ''); ?></label>
                        </div>
                        
                        <div>
                            <label>Mobile Number : <?php echo e($profile["mobile"] ? $profile["mobile"] : ''); ?></label>
                        </div>
                        
                        <div>
                            <label>Email : <?php echo e($profile["email"] ? $profile["email"] : ''); ?></label>
                        </div>
                    
                        <div>
                            <label>Address : <?php echo e($profile["address"] ? $profile["address"] : ''); ?></label>
                        </div>
                        <div>
                            <label>Enrolled Batch : <b><?php echo e($batchInfo ? $batchInfo : ''); ?></b></label>
                        </div>                        
                        <div>
                            <label for="information">Current Information : <?php echo e($enrollInfo ? $enrollInfo : ''); ?></label>
                        </div>
                        
                        <div>
                            <input name="information" type="text" value="<?php echo e($enrollInfo ? $enrollInfo : ''); ?>">
                        </div>
                        
                        <button type="submit" class="btn btn-danger" style="margin: 1rem 0rem;">
                            Update Information
                        </button>
                        
                    </form>
                    
                    
                    <div>
                        <a class="btn btn-info" href="<?php echo e('/admin/batch_student/' . $batchId . '/enrolled'); ?>" style="margin: 1rem 0rem;"> Go Back To Enrolled List</a>
                    </div>
                    
                </div>
                
                


            <div>


    </div>
    


</script>
                

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>