<?php $__env->startSection('content'); ?>


    <!--div class="row">
        
        <div class="col-3">&nbsp</div>
        
        <div class="col-6 centerText batchDetails">
            <h3>Total Enrolled <?php echo e($totalEnrolled); ?> </h3>
            
            <h3><?php echo e($totalLectures); ?> Lectures</h3>
            
        </div>
        
        <div class="col-3">&nbsp</di>
        
    </div-->

    <div class="row container">
    
        <div class="col-4">&nbsp</div>
        
        <div class="col-4">
                
            <div class="batchDetailsInfo">
             
                <h2 class="centerText batchTitle"><?php echo e($batchpackage->title); ?></h2>
                
                
                <?php if(isset($batchpackage->promotion_video)): ?>
                        
                    
                    <div class="plyr__video-embed" id="player">
                        
                        <div id="overlay" style="position: absolute; top: 0; left: 0; height: 100%; width: 100%; background-color: black; z-index: 2;">&nbsp</div>
                        
                            <iframe width="560" height="315"
                        src="<?php echo e($batchpackage->promotion_video); ?>" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                        
                        </div> 
                    
                    </div>            
                
        
                <?php endif; ?>
                
                <div class="marginAbove marginBelow">
                    
                    <div class="centerText"><b><?php echo e($batchpackage->fild_1); ?></b></div><br>
                    <div class="batchPackage centerText"><?php echo $batchpackage->fild_2; ?></div>
                    <?php
                        $packages = explode('\n', $batchpackage->fild_2);
                    ?>

                    <!--div class="centerText"><b><?php echo e(count($packages) > 1 ? 'Packages' : 'Package'); ?></b></div>                    

                    <div class="batchPackage centerText">
                        
                        <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
                            <p><b><?php echo e($package); ?></b></p>
                            
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </div-->
                    
                </div>
                
            
                <div class="row">
        
                    <?php if($batchpackage->fild_4 != "null"): ?>
                        <a class="col-4 centerText batchContentButton" href="<?php echo e($batchpackage->fild_4); ?>">Content</a>
                        
                        <div class="col-4 hide-on-med">&nbsp</div>

                    <?php endif; ?>
                    

                    <?php if($batchpackage->fild_5 != "null"): ?>
                    
                        <a class="col-4 centerText batchScheduleButton" href="<?php echo e($batchpackage->fild_5); ?>">Schedule</a>
                    
                        <div class="col-4 hide-on-med">&nbsp</div>
                    
                    <?php endif; ?>
                    <?php if(!$enrolled): ?>
                        <a class="col-12 centerText batchInfoButton" href="<?php echo e($batchpackage->module == 1 ? url('/batch/'.$batchpackage->batch_id.'/modules') : url('/student/batch/'.$batchpackage->batch_id.'/enroll')); ?>">Enroll Now</a>
                    <?php endif; ?>
                </div>
              
              </div>  
            
        
        
        </div>
        
    
    
    
    </div>
    
    
        
        

        
    
    

                               
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
    <script>
    
        const player = new Plyr('#player', { controls : [
          'play-large', // The large play button in the center
          'rewind', // Rewind by the seek time (default 10 seconds)
          'play', // Play/pause playback
          'fast-forward', // Fast forward by the seek time (default 10 seconds)
          'progress', // The progress bar and scrubber for playback and buffering
          'current-time', // The current time of playback
          'duration', // The full duration of the media
          'mute', // Toggle mute
          'volume', // Volume control
          'captions', // Toggle captions
          'settings', // Settings menu
          'fullscreen', // Toggle fullscreen
        ], settings : ['captions', 'quality', 'speed', 'loop'], quality : [4320, 2880, 2160, 1440, 1080, 720, 576, 480, 360, 240], noCookie: false, rel: 0, showinfo: 0, iv_load_policy: 3, modestbranding: 1, disableContextMenu : 'true', });

        player.on('playing', (event) => {
          document.getElementById('overlay').style.opacity = "0.0";
        });
        
        player.on('pause', (event) => {
          document.getElementById('overlay').style.opacity = "1.0";
        });
        

        


        
        
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>