<?php $__env->startSection('content'); ?>

    <div class="container">
    
    
        <?php $__currentLoopData = $info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="row lectureContainer marginBelow">
                
                <div class="col-4">&nbsp</div>

                <div class="col-4 marginAbove round lecture">

                    
                    <p>
                        <a href="/batch/<?php echo e($batch_id . '/' . 'subjects'); ?>" class="tag"><?php echo e($data->category); ?></a>&nbsp

                        <?php
                        
                            $chapterName = $data->chapter->name;
                            if (substr($chapterName,0,4) == "Week" && $startsFrom != "null") {
                            
                                $from = (int) $startsFrom;
                                
                                $weekNumber = (int) substr($chapterName,5);
                                
                                if ($weekNumber >= $from) {
                                    $chapterName = "Week " . ($weekNumber + 1 - $from);
                                
                                } else {
                                
                                    $chapterName = "Week " . (20 + $weekNumber - $from);                                    
                                }
                                
                            
                            }
                            
                            $dataInfo = array(
                                "title" => $data->title,
                                "batchId" => $batch_id,
                                "classId" => $data->id,
                            );
                            
                            if(!empty($data->links)) {
                                $dataInfo["note1"] = "note1";
                            }
                            
                            if(!empty($data->pdf)) {
                                $dataInfo["note2"] = "note2";
                            }

                            
                            if(!empty($data->v_link)) {
                                $dataInfo["pdf"] = "pdf";
                            }
                            
                            
                            
                        ?>
                        <a href="/batch/<?php echo e($batch_id . '/' . 'subject/' . $subject_id . '/chapter'); ?>" class="tag"><?php echo e($chapterName); ?></a>
                        
                        
                        
                        <a class="bookmark" id="<?php echo e($data->id); ?>" onclick="toggleBookmark(<?php echo e(json_encode($dataInfo)); ?>)">&#x2730</a>
                    </p>
                    

                    <?php if(!empty($data->video || $data->youtube_video_id)): ?>
                    
                        <div class="videoButtonContainer">
                            <p id ="<?php echo e($data->id); ?>" style="margin: 0; text-align: center"><?php echo e(($key + 1) . ". " . $data->title); ?></p>
                            <a href="<?php echo e(route('lecture_video',['batch_id'=>$batch_id,'id'=>$data->id])); ?>" class="videoButton" onclick="watchHistory(<?php echo e(json_encode($dataInfo)); ?>)">&#x25B6</a>
                        </div>
                    <?php endif; ?>

                    <div>
                        <?php if(!empty($data->links)): ?><a href="<?php echo e($data->links); ?>"  class="note1Button">Note 1</a> <?php endif; ?>
                        <?php if(!empty($data->pdf)): ?><a href="<?php echo e($data->pdf); ?>" class="note2Button">Note 2</a> <?php endif; ?>
                        <?php if(!empty($data->v_link)): ?> <a href="<?php echo e($data->v_link); ?>" class="pdfButton">PDF</a> <?php endif; ?>
                        <?php if(!empty($data->isExam)): ?> <a href="<?php echo e('/batch/' . $batch_id . '/class/' . $data->id . '/quiz/' . $data->isExam); ?>" class="quizButton" >Quiz</a><?php endif; ?>
                    </div>
                    
                </div>
                
                <div class="col-4">&nbsp</div>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    </div>
    

<script>

document. addEventListener("DOMContentLoaded", showBookmark);

function showBookmark() {

    var dataObject = localStorage.getItem('videoBookmark') ? JSON.parse(localStorage.getItem('videoBookmark')) : [];
    
    if (dataObject.length > 0) {

        for (var i =0; i< dataObject.length; i++) {

            var elem = document.getElementById(dataObject[i].classId);
            if (elem) {
                elem.innerText = "\u2B50";
            } // if
            
        } //for        
        
        
    } // if
    
    
} // showBookmark




function addVideoBookmark(dataInfo) {
    var dataObject = [];

    if(typeof(Storage) !== "undefined") {
        if (localStorage.getItem('videoBookmark') && localStorage.getItem('videoBookmark').length > 0)
            dataObject = JSON.parse(localStorage.getItem('videoBookmark'));
        dataObj = dataInfo;
        dataObject.unshift(dataObj);

        localStorage.setItem('videoBookmark', JSON.stringify(dataObject));
        

    } else {
        console.log("Error: Localstorage not supported");
    }
}


function removeVideoBookmark(classId) {
    
    var dataObject = JSON.parse(localStorage.getItem('videoBookmark'));

        
    for (var i =0; i< dataObject.length; i++) {
        var items = dataObject[i];
        if (items.classId == classId) {
            dataObject.splice(i, 1);
        }
    }
    
    localStorage.setItem('videoBookmark', JSON.stringify(dataObject));

}






    
 function toggleBookmark(dataInfo) {

     var bookmarkElem = document.getElementById(dataInfo["classId"]);

     if (bookmarkElem.innerText === "\u2730") {
         addVideoBookmark(dataInfo);
         bookmarkElem.innerText = "\u2B50";
     } else {
         removeVideoBookmark(dataInfo["classId"]);
         bookmarkElem.innerText = "\u2730";
     }

 }
 
 
  function watchHistory(dataInfo) {

    var dataObject = [];

    if(typeof(Storage) !== "undefined") {
        if (localStorage.getItem('watchHistory') && localStorage.getItem('watchHistory').length > 0)
            dataObject = JSON.parse(localStorage.getItem('watchHistory'));
            
        let isExist = false;
        if (dataObject.length > 0) {
    
            for (var i =0; i< dataObject.length; i++) {
                if(dataObject[i].classId == dataInfo.classId) {
                
                    isExist = true;
                    break;
                }  
            }
        }
            
        if (!isExist) {
            dataObj = dataInfo;
            dataObject.unshift(dataObj);
    
            localStorage.setItem('watchHistory', JSON.stringify(dataObject));
        }
        
    } else {
        console.log("Error: Localstorage not supported");
    }

 }
 
</script>
                

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>