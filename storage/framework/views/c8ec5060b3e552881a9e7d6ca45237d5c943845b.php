<?php $__env->startSection('content'); ?>



    <div class="row container" id="questionContainer">
        <div class="col-3">&nbsp</div>
        <div class="col-6">
            <div class="centerText"><?php echo e($modelTest->name); ?></div>
            <div class="centerText">Total Marks : <?php echo e($modelTest->exam_in_minutes); ?></div>            
            <div class="centerText">Time : <?php echo e($modelTest->ex_time); ?> minutes</div>
            <div class="centerText"><h3 id="counter" class="red"></h3></div>            
            
            <form method="post" id="question_paper" action="<?php echo e(url('/answerQuestionModeltest')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <input type="hidden" value="<?php echo e($modelTest->id); ?>" name="modeltest_id">
                <input type="hidden" value="<?php echo e($modelTest->exam_pattern); ?>" name="modeltest_exam_pattern">
                <input type="hidden" value="<?php echo e($modelTest->exam_in_minutes); ?>" name="modeltest_total_mark">                
                <div class="row">

                    <?php $__currentLoopData = $modelTest->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    
                        <?php
                            $question_segment = explode('\n', $data->question);
                        ?>
                        
                        <div class="question">
                            <input type="text" hidden="" value="<?php echo e($data->id); ?>"
                                   name="questions[<?php echo e($key); ?>][questionId]">
                            <div id="<?php echo e($key); ?>">
                                
                                <?php if($data->is_multi==1): ?>
                                    <label><h3><b>MCQ</b></h3></label>
                                
                                <?php else: ?>
                                    <label><h3><b>SBA</b></h3></label>
                                <?php endif; ?>

                                <label><b><?php echo e($key+1); ?>. </b></label>
                                
                                <label style="display: inline;">
                                    <?php $__currentLoopData = $question_segment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(str_starts_with($label, 'src:')): ?>
                                                    <p><img src="/<?php echo e(str_replace('src:', '', $label)); ?>" width="50%"></p>
                                                
                                                <?php else: ?>
                                                    <span><b><?php echo e($label); ?></b></span><br>
                                                
                                                <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </label>
    
                                <?php
                                    $options = App\Option::where('question_id',$data->id)->get();
                                ?>
                                <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyOpt => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                
                                    <?php
                                        $option_segment = explode('\n', $option->option);
                                    ?>
                                    

                                    
                                    <div class="row">
                                        <div>
                                                <input type='<?php echo e($data->is_multi == 1 ? "checkbox" : "radio"); ?>'
                                                       name="questions[<?php echo e($key); ?>][option][<?php echo e($data->is_multi == 1 ? $keyOpt : $key); ?>]"
                                                       value="<?php echo e($option->id); ?>" id="option1" style="display: inline;">
                                                       
                                            <label style="display: inline;">                                       <?php $__currentLoopData = $option_segment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(str_starts_with($label, 'src:')): ?>
                                                    <p><img src="/<?php echo e(str_replace('src:', '', $label)); ?>" width="50%"></p>
                                                
                                                <?php else: ?>
                                                    <span class="questionOption"><?php echo e($label); ?></span><br>
                                                
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </label>

                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php if($modelTest->exam_pattern == "Regular exam"): ?>
                        <div class="question">
                            <label>
                                <h3>
                                    <b>
                                        Select Candidate Type:
                                    </b>
                                </h3>
                            </label>
                            <div class="row">
                                        <input type="radio"
                                               name="candidate"
                                               value="Government" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Government</label>
                            </div>
                            
                            <div class="row">
                                <div>
                                        <input type="radio"
                                               name="candidate"
                                               value="Private" style="display: inline;">
                                        <label class="questionOption" style="display: inline;">Private</label>
                                </div>
                            </div>
                            
                        </div>
                        <div class="question">
                            <label>
                                <h3>
                                    <b>
                                        Select Discipline:
                                    </b>
                                </h3>
                            </label>
                            <div class="row">
                                        <input type="radio"
                                               name="discipline"
                                               value="Oral & Maxillofacial Surgery" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Oral & Maxillofacial Surgery</label>
                            </div>
                            <div class="row">
                                        <input type="radio"
                                               name="discipline"
                                               value="Orthodontics" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Orthodontics</label>
                            </div>
                            <div class="row">
                                        <input type="radio"
                                               name="discipline"
                                               value="Prosthodontics" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Prosthodontics</label>
                            </div>
                            <div class="row">
                                        <input type="radio"
                                               name="discipline"
                                               value="Conservative Dentistry & Endodontics" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Conservative Dentistry & Endodontics</label>
                            </div>

                            <div class="row">
                                        <input type="radio"
                                               name="discipline"
                                               value="Pedodontics" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Pedodontics</label>
                            </div>
                            <div class="row">
                                        <input type="radio"
                                               name="discipline"
                                               value="Oral & Maxillofacial Pathology" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Oral & Maxillofacial Pathology</label>
                            </div>
                            <div class="row">
                                        <input type="radio"
                                               name="discipline"
                                               value="Periodontology" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Periodontology</label>
                            </div>
                            <div class="row">
                                        <input type="radio"
                                               name="discipline"
                                               value="Oral Anatomy" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Oral Anatomy</label>
                            </div>
                            <div class="row">
                                        <input type="radio"
                                               name="discipline"
                                               value="Dental Pharmacology" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Dental Pharmacology</label>
                            </div>
                            <div class="row">
                                        <input type="radio"
                                               name="discipline"
                                               value="Dental Materials" style="display: inline;" required>
                                        <label class="questionOption" style="display: inline;">Dental Materials</label>
                            </div>
                        </div>
                    <?php endif; ?>

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
        
          <div class="modal-content">
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

        let exam_length = <?php echo e($modelTest->ex_time); ?>;
        let exam_length_in_micro = exam_length * 60 * 1000;
        
        setTimeout(function () {

            document.getElementById("question_paper").submit();
        }, exam_length_in_micro);
        
        let timer2 = "<?php echo e($modelTest->ex_time); ?>:00";
        let interval = setInterval(function () {
            let timer = timer2.split(':');
            console.log(timer);
            if (timer[0] == '0' && timer[1] == '01') {
                clearInterval(interval);
            }

            let minutes = parseInt(timer[0], 10);
            let seconds = parseInt(timer[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            if (minutes < 0) clearInterval(interval);
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;

            document.getElementById("counter").innerText = "Time Left - " + minutes + ':' + seconds;
            timer2 = minutes + ':' + seconds;
        }, 1000);


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