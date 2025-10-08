<?php $__env->startSection('content'); ?>

<div class="row" style="margin-top:8rem; padding: 1rem;">
    
        <div class="col-3">&nbsp</div>
        
        <div class="col-6">
            <div><h3 class="centerText"><?php echo e($sheet->title); ?></h3></div>
            <div class="plyr__video-embed" id="player">
                
                <div id="overlay" style="position: absolute; top: 0; left: 0; height: 100%; width: 100%; background-color: black; z-index: 2;">&nbsp</div>
                    <?php echo $sheet->video; ?>

            </div> 
        	
        </div>

                
        <div class="col-3">&nbsp</div>
    
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