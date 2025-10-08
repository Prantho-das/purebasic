<?php $__env->startSection('content'); ?>


    <div class="container">
    
            <div class="row" style="margin:3rem 1rem;">
                

                <div>
                    
                    <form name="searchForm" id="searchForm" action="<?php echo e(url('/admin/findUserByMobile/')); ?>" method="post">
                        <?php echo csrf_field(); ?>
                    

                        
                        <div>
                            <label for="mobile">Find By Mobile Number : </label>
                            <input name="mobile" id="mobile" type="text" style="margin: 1.5rem 0rem;">
                        </div>
                        
                        
                        <button type="submit" class="submitButton">
                            Search
                        </button>
                        
                    </form>
                    

                </div>
                
                


            <div>


    </div>
    

<script>

    var searchForm = document.getElementById('searchForm');
    searchForm.onsubmit = function(){
        let mobile = document.getElementById('mobile');
        let newValue = mobile.value.replace(/\D/g,'');
        newValue = newValue.replace(/^(880)/,"");
        newValue = parseInt(newValue);
        mobile.value = newValue;
        searchForm.submit();
    };

</script>
                

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>