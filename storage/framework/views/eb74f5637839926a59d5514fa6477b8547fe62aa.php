<?php $__env->startSection('content'); ?>

    <div class="homeContainer">
    
    
        <div class="row">
            
            <div class="col-3">&nbsp</div>
            
            <div class="col-6 marginAbove paddingBelow round" id="founder">
                
                <div id="founderSlide">
                
                    <h2>Founder</h2>
                
                
                	<h3>Dr Sarwer Biplob</h3>
                	<p>BMDC Reg. No. 5379
                	<br>BDS, MCPS (Dental Surgery)
                	<br>FCPS (Final), MS Resident (Phase B) OMFS
                	<br>MSc (Course) Craniofacial Imaging, USM
                	<br>Member, American Academy of Oral Medicine (AAOM)
                	<br>Medical Officer
                	<br>Oral & Maxillofacial Surgery
                	<br>BSMMU</p>
                </div>
            
            </div>
            
            <div class="col-6">&nbsp</div>
        
        </div>
        
        
        
        <div class="row">
            
            <div class="col-3">&nbsp</div>
            
            <div class="col-6 marginAbove paddingBelow round centerText" id="mentors">
               
               <div id="mentorSlides"> 
                
                    <h2>Mentors</h2>
                
                
                
                
                    <?php $__currentLoopData = $mentors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mentor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                            
                            <div class="mentorSlide">
                                
                                <h3 class="w3-center"><?php echo e($mentor->name); ?></h3>
                                <p class="w3-large"><?php echo e($mentor->designation); ?></p>
                                
                            </div>
                            
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    <!--div>
                        <button class="moveButton" onclick="moveToMentor(-1)"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--la" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32" data-icon="la:angle-left"><path fill="currentColor" d="m19.031 4.281l-11 11l-.687.719l.687.719l11 11l1.438-1.438L10.187 16L20.47 5.719z"></path></svg></button>
        
                        <button style="float:right" class="moveButton" onclick="moveToMentor(1)"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--la" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32" data-icon="la:angle-right"><path fill="currentColor" d="M12.969 4.281L11.53 5.72L21.812 16l-10.28 10.281l1.437 1.438l11-11l.687-.719l-.687-.719z"></path></svg></button>
                    </div-->
                    
                </div>
                
        
                
            </div>
            
            <div class="col-3">&nbsp</div>
        
        </div>
    </div>
    
    
    
    <script>
    

    var mentorIndex = 0;
    

    mentorCarousel();
    
    

    
    
    
    function mentorCarousel() {
      var i;
      var elem = document.getElementsByClassName("mentorSlide");
      for (i = 0; i < elem.length; i++) {
        elem[i].style.display = "none";  
      }
      mentorIndex++;
      if (mentorIndex > elem.length) {mentorIndex = 1}    
      elem[mentorIndex-1].style.display = "block";  
      setTimeout(mentorCarousel, 4000); // Change image every 6 seconds
    }
    
    
    </script>


   

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>