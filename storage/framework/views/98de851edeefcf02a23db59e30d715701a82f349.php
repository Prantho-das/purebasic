<?php $__env->startSection('content'); ?>



<div class="row container">
    
    <div class="col-3">&nbsp</div>
    
    <div class="col-6">

        <div class="centerText">
            <div>
                <h3><?php echo e($modelTest->name); ?> </h3>
            </div>
            <div>
                <h3 id="totalQuestions">Total Questions <?php echo e($modelTestAnswer->total_mcq + $modelTestAnswer->total_sba); ?> <?php echo e($modelTestAnswer->total_mcq > 0 ? "- " . $modelTestAnswer->total_mcq . " mcq" : ""); ?> <?php echo e($modelTestAnswer->total_sba > 0 ? "- " . $modelTestAnswer->total_sba . " sba" : ""); ?></h3>
            </div>
            
            <?php if($modelTestAnswer->total_mcq > 0): ?>
                <div>
                    <h3 id="correctMcq">Correct MCQ : <?php echo e($modelTestAnswer->right_mcq); ?> of <?php echo e($modelTestAnswer->total_mcq * 5); ?> options</h3>
                </div>
            <?php endif; ?>
            
            <?php if($modelTestAnswer->total_sba > 0): ?>
                <div>
                    <h3 id="correctSba">Correct SBA : <?php echo e($modelTestAnswer->right_sba); ?> of <?php echo e($modelTestAnswer->total_sba); ?></h3>
                </div>
            <?php endif; ?>
            
            <?php if($modelTest->exam_pattern == "Regular exam"): ?>
                <div>
                    <h3>Obtained marks :-</h3>
                    <h3>FCPS Standard : <?php echo e($modelTestAnswer->point . " out of " . $modelTest->exam_in_minutes); ?> (<?php echo e($modelTestAnswer->percentage); ?>%) <span style="color:<?php echo e($modelTestAnswer->percentage < 70 ? 'red' : 'green'); ?>"><?php echo e($modelTestAnswer->pass_status); ?> </span> </h3>
                    
                    <h3>MS/MD/DDS Standard : <?php echo e($modelTestAnswer->point_1 . " out of " . $modelTest->exam_in_minutes / 2); ?></h3>
                </div>
            <?php endif; ?>
            
            <?php if($modelTest->exam_pattern != "Regular exam" && $modelTest->exam_pattern !== "Lecture"): ?>
                <div>
                    <h3> Obtained marks : <?php echo e($modelTestAnswer->point); ?> </h3>
                </div>
            <?php endif; ?>
           
            <div>
                <h3><span class="green">&#x2713</span> indicates your submitted answer is right while <span class="red">&#x274c</span> indicates your submitted answer is wrong</h3>
            </div>
        </div>
                <?php $__currentLoopData = $modelTest->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="answer">
                           <label><b><?php echo e($data->is_multi == 1 ? "MCQ" : "SBA"); ?></b></label> 
                           <label><h3><?php echo e($key+1); ?>. </b><?php echo e($data->question); ?></h3></label>

                            <?php
                            
                            
                            $options = App\Option::where('question_id',$data->id)->get();
                            
                            ?>
                        
                            <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyOpt => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                                <?php
                                    $mark = "";
                                    $markBg = "";
                                    $answerBg = "";
                                
                                    if (in_array($option->id, $answeredOptions)) {
                                        if ($option->correct_or_not == 1) {
                                            $mark = "\u{2713}";
                                            $markBg = "correctAnswer";
                                            $answerBg = "correctBg";
                                            
                                        } else {
                                            $mark = "\u{274c}";
                                            $markBg = "wrongAnswer";
                                            $answerBg = "wrongBg";
                                        }
                                        
                                    } elseif ($data->is_multi == 1) {
                                    
                                        if ($option->correct_or_not == 1) {
                                            $mark = "\u{274c}";
                                            $markBg = "wrongAnswer";
                                            $answerBg = "wrongBg";
                                            
                                            
                                        } else {
                                            $mark = "\u{2713}";
                                            $markBg = "correctAnswer";
                                            $answerBg = "correctBg";
                                            
                                        }                                 
                                        
                                    }
                            
                                    
                                ?>
                            
                                <?php if($data->is_multi == 1): ?>
                                    <p><span class="badge <?php echo e($option->correct_or_not == 1 ? 'greenBg' : 'whiteBg'); ?>">T</span>&nbsp&nbsp<span class="badge <?php echo e($option->correct_or_not == 1 ? 'whiteBg' : 'redBg'); ?>">F</span><span class="<?php echo e($answerBg); ?>"><?php echo e($option->option); ?></span><span class=<?php echo e($markBg); ?>>&nbsp<?php echo e($mark); ?></span></p>
                                    
                                <?php else: ?>
                                    <?php
                                        $split = explode(".", $option->option);
                                    ?>
                                    <p><span class="badge <?php echo e($option->correct_or_not == 1 ? 'greenBg' : ''); ?>"><?php echo e($split[0]); ?>.</span>
                                    <span class="<?php echo e($answerBg); ?>">&nbsp<?php echo e($split[1]); ?></span><span class=<?php echo e($markBg); ?>>&nbsp<?php echo e($mark); ?></span>
                                    </p>

                                <?php endif; ?>
                                
                                
                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
    
        
        </div>
        
    </div>
    
    <div class="col-3">&nbsp</div>

</div>

<script>

    
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

<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>