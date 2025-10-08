<?php $__env->startSection('content'); ?>

      <!-- Section:about-->

    <div class="row helpContainer">
    
        <div class="col-4">&nbsp</div>
        
        <div class="col-4">
            
            <div class="centerText frequentQuestions"><a><b>Frequently asked questions</a></b></div>
            
            <?php $__currentLoopData = $tutorials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tutorial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         
                <div class="tutorial">
                 
                    <h2 class="centerText tutorialTitle"><?php echo e($tutorial->title); ?></h2>
                    
                    <div class="plyr__video-embed">
                        
                        <iframe width="560" height="315"
                    src="<?php echo e($tutorial->details); ?>" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
                    
                    </div> 
                    
                
                   
                  
                  </div>  
          
        	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        	
        </div>

                
        <div class="col-4">&nbsp</div>
    
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
    <script src="https://cdn.plyr.io/3.6.2/plyr.js"></script>
    <script>
        const players = Plyr.setup('.plyr__video-embed');
    </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>