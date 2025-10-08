<?php $__env->startSection('content'); ?>

    <div class="container">

        <div class="centerText"><h3><?php echo e($modelTestName); ?></h3></div>
        <div class="centerText"><h3>Total marks <?php echo e($modelTestMarks / 2); ?></h3></div>

        
        <div class="row disciplineContainer">
            <div class="col-4">&nbsp</div>
            
            <div class="col-4 marginAbove round centerText disciplines">
                <a href="/exam/point/list/discipline/<?php echo e($id); ?>/Oral_&_Maxillofacial_Surgery"class="linkButton">Oral & Maxillofacial Surgery</a>
                    </a>
            </div>
        
        </div>
 
         <div class="row disciplineContainer">
            <div class="col-4">&nbsp</div>
           
            <div class="col-4 marginAbove round centerText disciplines">
                <a href="/exam/point/list/discipline/<?php echo e($id); ?>/Orthodontics"class="linkButton">Orthodontics</a>
                    </a>
            </div>
            
        </div>

        <div class="row disciplineContainer">
            <div class="col-4">&nbsp</div>
            
            <div class="col-4 marginAbove round centerText disciplines">
                <a href="/exam/point/list/discipline/<?php echo e($id); ?>/Prosthodontics"class="linkButton">Prosthodontics</a>
                    </a>
            </div>
        </div>

        <div class="row disciplineContainer">
            <div class="col-4">&nbsp</div>
            
            <div class="col-4 marginAbove round centerText disciplines">
                <a href="/exam/point/list/discipline/<?php echo e($id); ?>/Conservative_Dentistry_&_Endodontics"class="linkButton">Conservative Dentistry & Endodontics</a>
                    </a>
            </div>
        </div>
          
        <div class="row disciplineContainer">
            <div class="col-4">&nbsp</div>
  
            <div class="col-4 marginAbove round centerText disciplines">
                <a href="/exam/point/list/discipline/<?php echo e($id); ?>/Pedodontics"class="linkButton">Pedodontics</a>
                    </a>
            </div>
         </div>

        <div class="row disciplineContainer">
            <div class="col-4">&nbsp</div>
           
            <div class="col-4 marginAbove round centerText disciplines">
                <a href="/exam/point/list/discipline/<?php echo e($id); ?>/Oral_&_Maxillofacial_Pathology"class="linkButton">Oral & Maxillofacial Pathology</a>
                    </a>
            </div>
        </div>
          
        <div class="row disciplineContainer">
          
            <div class="col-4">&nbsp</div>
          
            <div class="col-4 marginAbove round centerText disciplines">
                <a href="/exam/point/list/discipline/<?php echo e($id); ?>/Periodontology"class="linkButton">Periodontology</a>
                    </a>
            </div>
        </div>
            
        <div class="row disciplineContainer">

            <div class="col-4">&nbsp</div>
            <div class="col-4 marginAbove round centerText disciplines">
                <a href="/exam/point/list/discipline/<?php echo e($id); ?>/Oral_Anatomy"class="linkButton">Oral Anatomy</a>
                    </a>
            </div>
        </div>

            
        <div class="row disciplineContainer">
            <div class="col-4">&nbsp</div>

            <div class="col-4 marginAbove round centerText disciplines">
                <a href="/exam/point/list/discipline/<?php echo e($id); ?>/Dental_Pharmacology"class="linkButton">Dental Pharmacology</a>
                    </a>
            </div>
        </div>
            
        <div class="row disciplineContainer">
            <div class="col-4">&nbsp</div>

            <div class="col-4 marginAbove round centerText disciplines">
                <a href="/exam/point/list/discipline/<?php echo e($id); ?>/Dental_Materials"class="linkButton">Dental Materials</a>
                    </a>
            </div>
        </div>
            
        
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>