<?php $__env->startSection('content'); ?>



    <div class="row container" id="questionContainer">
        <div class="col-3">&nbsp</div>
        <div class="col-6">
            <div class="centerText"><?php echo e($modelTest->name); ?></div>

            <form method="post" id="question_paper" action="<?php echo e(url('/answerQuestionModeltest')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" value="<?php echo e($modelTest->id); ?>" name="modeltest_id">
                <input type="hidden" value="<?php echo e($modelTest->exam_pattern); ?>" name="modeltest_exam_pattern">
                <input type="hidden" value="<?php echo e($modelTest->exam_in_minutes); ?>" name="modeltest_total_mark">                
                <div class="row">

                    <?php $__currentLoopData = $modelTest->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="question">
                            <input type="text" hidden="" value="<?php echo e($data->id); ?>"
                                   name="questions[<?php echo e($key); ?>][questionId]">
                            <div id="<?php echo e($key); ?>">
                                <?php if($data->is_multi==1): ?>
                                    <label><h3><b>MCQ</b></h3></label>
                                    <label><h3><b><?php echo e($key+1); ?>. </b><?php echo e($data->question); ?>

                                        </h3></label>
                                <?php else: ?>
                                    <label><h3><b>SBA</b></h3></label>
                                    <label><h3><b><?php echo e($key+1); ?>. </b><?php echo e($data->question); ?>

                                        </h3></label>
                                <?php endif; ?>
    
                                <?php
                                    $options = App\Option::where('question_id',$data->id)->get();
                                ?>
                                <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyOpt => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="row">
                                        <div>
                                                <input type='<?php echo e($data->is_multi == 1 ? "checkbox" : "radio"); ?>'
                                                       name="questions[<?php echo e($key); ?>][option][<?php echo e($data->is_multi == 1 ? $keyOpt : $key); ?>]"
                                                       value="<?php echo e($option->id); ?>" id="option1" style="display: inline;">
                                                <label class="questionOption" style="display: inline;"><?php echo e($option->option); ?></label>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </form>
            
            <div>
                <button onclick="plusQuestion(-1)" class="previousButton">
                    Previous
                </button>

                <button class="finishButton" onclick="confirmSubmit()">
                    Finish
                </button>
                
                <button onclick="plusQuestion(1)" class="nextButton">
                    Next
                </button>
            </div>
                        
                
        </div>
    </div>

    <div class="row container">
        <div class="col-3">&nbsp</div>
        <div id="submitModal" class="modal col-6">
        
          <div class="modalContent">
            <p>Do you want to finish the exam ?</p>
            <button class="finishButton" onclick="submit()">
                Yes
            </button>
            <button class="finishButton" onclick="cancel()">
                No
            </button>
          </div>
        
        </div> 
    </div>


    <script>

        let questionIndex = 1;
        showQuestions(questionIndex);
        
        
        function plusQuestion(n) {
          showQuestions(questionIndex += n);
        }
        
        function showQuestions(n) {
          let i;
          let questions = document.getElementsByClassName("question");
        
          if (n > questions.length) {questionIndex = 1}
          if (n < 1) {questionIndex = questions.length}
          for (i = 0; i < questions.length; i++) {
            questions[i].style.display = "none";
          }
        
          questions[questionIndex-1].style.display = "block";
        }


        function confirmSubmit() {
            document.getElementById("questionContainer").style.display = "none";
            document.getElementById("submitModal").style.display = "block";
        }
        

        function cancel() {
            document.getElementById("questionContainer").style.display = "block";
            document.getElementById("submitModal").style.display = "none";
        }
        
        function submit() {
            document.getElementById("question_paper").submit();
        }        

    
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>