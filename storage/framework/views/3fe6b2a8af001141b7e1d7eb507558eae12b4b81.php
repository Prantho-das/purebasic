<?php $__env->startSection('content'); ?>

    <div class="container">
    
            <div class="row" style="margin-top:3rem;">
                
                <div class="col-4">&nbsp</div>

                <div class="col-4">
                    
                    <?php if($profile["id"]): ?>
                        ID : <?php echo e($profile["id"]); ?><br>
                    <?php endif; ?>
                    
                    <?php if($profile["name"]): ?>
                        Name : <?php echo e($profile["name"]); ?><br>
                    <?php endif; ?>
                    
                    <?php if($profile["mobile"]): ?>
                        Mobile : <?php echo e($profile["mobile"]); ?><br>
                    <?php endif; ?>
                    
                    <?php if($profile["email"]): ?>
                        Email : <?php echo e($profile["email"]); ?><br>
                    <?php endif; ?>
                    
                    <?php if($profile["country"]): ?>
                        Country : <?php echo e($profile["country"]); ?><br>
                    <?php endif; ?>
                    
                    <?php if($profile["address"]): ?>
                        Address : <?php echo e($profile["address"]); ?><br>
                    <?php endif; ?>
                    
                    <?php if($profile["position"]): ?>
                        Title : <?php echo e($profile["position"]); ?><br>
                    <?php endif; ?>
                    
                    <?php if($profile["qualification"]): ?>
                        Degree : <?php echo e($profile["qualification"]); ?><br>
                    <?php endif; ?>
                    
                    <?php if($profile["BMDC"]): ?>
                        BMDC registration :  : <?php echo e($profile["BMDC"]); ?><br>
                    <?php endif; ?>
                    
                    <div style="margin-top: 1rem;"><a class ="loginButton" href="/student/logout"><b>লগআউট</b></a></div>    

                </div>
                
                
                <div class="col-4">&nbsp</div>


            <div>


    </div>
    


</script>
                

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>