<?php $__env->startSection('content'); ?>



<div class="row container">
    
    <div class="col-3">&nbsp</div>
    
    <div class="col-6">


        <div class="centerText">
            
            <div><h3>You are watching a free version of question bank. Buy it to view all questions..</h3></div>
            <a class="detailsButton" href="/student/batch/87/enroll">Buy Question Bank</a>
            <div>
                <h3>Subject : <?php echo e($modelTest->subject); ?></h3>
                <h3>Chapter : <?php echo e($modelTest->chapter); ?></h3>
                <h3>Topic : <?php echo e($modelTest->name); ?> </h3>
            </div>
            
        </div>
                <?php $__currentLoopData = $modelTest->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                    <?php if($data->is_free == 1): ?>
                        <div class="answer">
                               <label><b>Free Question - <?php echo e($data->is_multi == 1 ? "MCQ" : "SBA"); ?></b></label> 
                               <label><h3><?php echo e($key+1); ?>. </b><?php echo e($data->question); ?></h3></label>
    
                                <?php
                                
                                
                                $options = App\QuestionBankOption::where('question_id',$data->id)->get();
                                
                                ?>
                            
                                <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyOpt => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                
                                    <?php if($data->is_multi == 1): ?>
                                        <p><span class="<?php echo e($data->id); ?>" style="display: none;"><span class="badge <?php echo e($option->correct_or_not == 1 ? 'greenBg' : 'whiteBg'); ?>">T</span>&nbsp&nbsp<span class="badge <?php echo e($option->correct_or_not == 1 ? 'whiteBg' : 'redBg'); ?>">F</span></span><span><?php echo e($option->option); ?></span></p>
                                        
                                    <?php else: ?>
    
                                        <p><span class="<?php echo e($data->id); ?>" style="display: none;"><span class="badge <?php echo e($option->correct_or_not == 1 ? 'greenBg' : ''); ?>"><?php echo e($option->correct_or_not == 1 ? 'T' : 'F'); ?></span> </span>
                                        <span>&nbsp&nbsp<?php echo e($option->option); ?></span>
                                        </p>
    
                                    <?php endif; ?>
                                    
                                    
                                    
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                                <button class="detailsButton" onclick="toggleAnswer(<?php echo e($data->id); ?>)">Answer</button>
                                
                                <button class="detailsButton" onclick="toggleDetails(<?php echo e($key); ?>)">Details</button>
    
                                
                                <?php if($data->solve_link): ?>
                                    <a class="detailsButton" href="/solve_video/<?php echo e($modelTest->id); ?>/<?php echo e($data->id); ?>">Video</a>
                                <?php endif; ?>
    
                                <div class="answerDetails" id="<?php echo e($key); ?>">
                                    <?php
                                        $details = explode('\n', $data->detailss);
                                    ?>
                                    
                                    <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(str_starts_with($label, 'src:')): ?>
                                            <p><img src="/<?php echo e(str_replace('src:', '', $label)); ?>" width="50%"></p>
                                        
                                        <?php else: ?>
                                            <label><?php echo e($label); ?></label><br>
                                        
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                
                        </div>
                        
                    <?php endif; ?>
                
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
    
        
        </div>
        
    </div>
    
    <div class="col-3">&nbsp</div>

</div>

<script>


 function toggleAnswer(answerId) {
     
    var answerElems = document.getElementsByClassName(answerId);

    var len =  answerElems.length;
    
    for(var i=0 ; i<len; i++){
        
        if (answerElems[i].style.display === "inline") {
                 answerElems[i].style.display = "none";
             } else {
                 answerElems[i].style.display = "inline";
             }
    }


 }
 

    
 function toggleDetails(detailsId) {
     var detailsElem = document.getElementById(detailsId)

     if (detailsElem.style.display === "block") {
         detailsElem.style.display = "none";
     } else {
         detailsElem.style.display = "block";
     }
 }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.question_bank', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>