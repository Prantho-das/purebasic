<?php $__env->startSection('content'); ?>

    <div class="container" id="chaptersContainer">

    <?php $i=0; ?>
        <?php $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_chapters): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php $__currentLoopData = $sub_chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
                <?php
                    $chapterName = $chapter->name;
                    $serial = $key;
                    
                    if (substr($chapterName,0,4) == "Week" && $startsFrom != "null") {
                    
                        $from = (int) $startsFrom;
                        
                        $weekNumber = (int) substr($chapterName,5);
                        
                        if ($weekNumber >= $from) {
                            $weekNumber  = ($weekNumber + 1 - $from);
                        
                        } else {
                        
                            $weekNumber = (21 + $weekNumber - $from);                                    
                        }
                        
                        $chapterName = "Week " . $weekNumber;
                        $serial = $weekNumber;

                    }
                ?>
           
                <div class="row chapterContainer" id="<?php echo e($startsFrom != 'null' ? $serial : $key + 1); ?>">

                    <div class="col-4">&nbsp</div>
                    
                    <div class="col-4 marginAbove round chapter">

                        <?php if($chapter->literature): ?>
                            <div style="float:right; margin-top: 0.5rem;"><a href="<?php echo e($chapter->literature); ?>" class="literatureLink">Literature</a></div>
                            <div>&nbsp</div>
                        <?php endif; ?>   
                        
                        
                        <div class="centerText">
                        

                        
                            <p>Subject : </span><a href="/batch/<?php echo e($batch_id . '/' . 'subjects'); ?>"><?php echo e($subject_info->name); ?></a></p>
                            
                            <p><a href="<?php echo e(route('chapter_classes',['batch_id'=>$batch_id,'subject_id'=>$subject_id,'chapter_id'=>$chapter->id])); ?>" class="linkButton"><?php echo e($chapterName); ?></a></p>
                        
                        </div>
                    </div>
                    <div class="col-4">&nbsp</div>
                
                </div>
    
            <?php $i++; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <script>

        var chaptersContainer = document.getElementById( 'chaptersContainer' );
        
        [].map.call( chaptersContainer.children, Object ).sort( function ( a, b ) {
            return +a.id.match( /\d+/ ) - +b.id.match( /\d+/ );
        }).forEach( function ( elem ) { 
            chaptersContainer.appendChild( elem );
        });
    
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>