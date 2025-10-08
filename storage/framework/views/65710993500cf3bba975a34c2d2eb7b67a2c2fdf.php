
<?php $__env->startSection('content'); ?>

        <?php
           $subjects=App\Category::where('qb_serial', '!=', 'null')->orderBy('qb_serial','asc')->get();
        ?>

              <ul style="margin: 5em;">
                      <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                            <li><?php echo e($subject->name); ?></li>
                            
                            <ul>
                                
                                <?php
                                   $chapters=App\Chapter::where('cat_id', $subject->id)->where('qb_serial', '!=', 'null')->orderBy('qb_serial','asc')->get();
                                ?>
                                
                                <?php $__currentLoopData = $chapters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($chapter->name); ?></li>
                                    
                                    <ul>
                                        
                                        <?php
                                           $topics=App\QuestionBank::where('subject_id', $subject->id)->where('chapter_id', $chapter->id)->orderBy('serial','asc')->get();
                                           
                                        ?>
                                        
                                        <?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        
                                            <li><a href="/question_bank_topic/<?php echo e($topic->id); ?>"><?php echo e($topic->name); ?></a></li>
                                        
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                                    </ul>
                                
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            </ul>
                            
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>