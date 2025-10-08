<?php $__env->startSection('content'); ?>
    <div class="profileContainer">


        <div class="row">
            
            <div class="col-4">&nbsp</div>
                
            <div class="col-4">
            
                    
                <button class="centerText lectureLink linkCategory" style="color:white; margin: 0.5rem; border: 0rem;" onclick="onClicked()" >Watch Free Lectures</button>
                
                
            </div>
            
            <div class="col-4">&nbsp</div>
            
        </div>
        
        
        <div id="facultyModal" class="modal">
        
          <!-- Modal content -->
          <div class="modal-content">
            <p>Choose Faculty</p>
            
            <form>
                <input type="radio" id="Medicine" name="faculty" value="1">
                <label for="Medicine">Medicine</label><br>
                <input type="radio" id="Dentistry" name="faculty" value="2">
                <label for="Dentistry">Dentistry</label><br>
                <input type="radio" id="BCS" name="faculty" value="3">
                <label for="BCS">BCS</label>
                
                <div style="margin-top: 1rem; width: 20%;"><a id="goButton" class="goButton">Go</a></div>
                
            </form>
            
          </div>
        
        </div>
        
    
        <div class="row">
            
            <div class="col-4">&nbsp</div>
    
            <div class="col-4">
                <?php $__currentLoopData = $enrolledBatches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
                        <?php
                            $endStr = substr($batch->subscription_end,0,10);
                            

                            $end = new DateTime($endStr);

                            $current = new DateTime(date("Y-m-d"));


                            $remaining = $end->diff($current)->format('%a');
                        
                        ?>

                        <div class="enrolledProgram">
      
                            <h2 class="batchTitle"><?php echo e($batch->title); ?></h2>


                    

                            <div>
                                Subscription remaining : <span class= <?php echo e((int)$remaining <= 15 ? "red" : "green"); ?>><?php echo e($remaining); ?> Days</span> 
                            </div>

                        
                            <div style="padding-top: 2rem; padding-bottom: 2rem;">
                                
                                <a class="centerText lectureLink linkCategory" href="<?php echo e(url('batch/'.$batch->batch_id.'/subjects')); ?>">Go To Lecture</a>
                                
                                <?php if($batch->fild_5): ?>
                                
                                    <a class="centerText scheduleLink linkCategory" href="<?php echo e($batch->fild_5); ?>">Schedule</a>
                                <?php endif; ?>
                                
                            </div>




                        </div>
                		  


                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
            </div>
            
            <div class="col-4">&nbsp</div>
            
          </div>
    </div>
    
    
    <script>
    
    
        let facultyModal = document.getElementById("facultyModal");
        

        let goButton = document.getElementById("goButton");
        
        document.querySelector('form').addEventListener("click", (event) => {
            const checkedRadioInput = document.querySelector('input[name="faculty"]:checked');
            
            if(checkedRadioInput) {
                goButton.href="/free_lectures/batch/" + checkedRadioInput.value;
                goButton.style.backgroundColor = "#0066ff";
            } else {
                goButton.style.backgroundColor = "#aeb1b7";
                
            }
            //document.getElementById("ButtonId").removeAttribute("disabled");
        });

        function onClicked() {
            facultyModal.style.display = "block";
        }
        
        window.onclick = function(event) {
            if (event.target == facultyModal) {
                facultyModal.style.display = "none";
                goButton.style.backgroundColor = "#aeb1b7";
                document.querySelector('input[name="enrollCategory"]:checked').checked = false;
            }
        }
      
      
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>