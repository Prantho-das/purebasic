<?php $__env->startSection('content'); ?>


    <div class="container">
    
            <div class="row" style="margin:3rem 1rem;">
                


                    <form action="<?php echo e(url('/admin/findUserById/')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                    

                        
                        <div>
                            <label for="id">Find By Pure Basic Id : </label>
                            <input style="margin: 1.5rem 0rem;" name="id" type="number">
                        </div>
                        
                        
                        <button type="submit" class="submitButton">
                            Search
                        </button>
                        
                    </form>
                    

                </div>
                
                


            <div>


    </div>
    


</script>
                

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>