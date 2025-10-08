<?php $__env->startSection('content'); ?>

    <div class="container" id="container">
    
    

    </div>
    

<script>

document. addEventListener("DOMContentLoaded", showWatchHistory);


function showWatchHistory() {

    var dataObject = localStorage.getItem('watchHistory') ? JSON.parse(localStorage.getItem('watchHistory')) : [];

    if (dataObject.length > 0) {

        for (var i =0; i< dataObject.length; i++) {
            
            const row = document.createElement("div");
            row.classList.add("row", "lectureContainer", "marginBelow");
            
            const col4 = document.createElement("div");
            col4.classList.add("col-4");
            col4.innerText = String.fromCharCode(160);
            row.appendChild(col4);
            
            const lecture = document.createElement("div");
            lecture.id = dataObject[i].classId;
            lecture.classList.add("col-4", "marginAbove", "round", "lecture");
            row.appendChild(lecture);
            
            const bookmarkContainer = document.createElement("p");
            lecture.appendChild(bookmarkContainer);
            
            
            
            const bookmark = document.createElement("a");
            bookmark.addEventListener("click", function() {removeWatchHistory( lecture.id);}, false);
            bookmark.classList.add("tag");
            bookmark.innerText = "Remove";
            bookmarkContainer.appendChild(bookmark);
            
            const videoButtonContainer = document.createElement("div");
            videoButtonContainer.classList.add("videoButtonContainer");
            lecture.appendChild(videoButtonContainer);
            
            const title = document.createElement("p");
            title.style.margin = "0";
            title.style.textAlign = "center";
            title.innerText = dataObject[i].title;
            videoButtonContainer.appendChild(title);
            
            const link = document.createElement("a");
            link.href = "/batch/" + dataObject[i].batchId + "/class/" + dataObject[i].classId;
            link.classList.add("videoButton");
            link.innerText = "\u25B6";
            videoButtonContainer.appendChild(link);
            
            const linkButtonContainer = document.createElement("div");
            lecture.appendChild(linkButtonContainer);
            
            if (dataObject[i].note1) {
                
                const link = document.createElement("a");
                link.href = "/batch/" + dataObject[i].batchId + "/class/" + dataObject[i].classId + "/note1";
                link.classList.add("note1Button");
                link.innerText = "Note 1";
                linkButtonContainer.appendChild(link);
            
            }
            
            if (dataObject[i].note2) {
                
                const link = document.createElement("a");
                link.href = "/batch/" + dataObject[i].batchId + "/class/" + dataObject[i].classId + "/note2";
                link.classList.add("note2Button");
                link.innerText = "Note 2";
                linkButtonContainer.appendChild(link);
            
            }
            
            if (dataObject[i].pdf) {
                
                const link = document.createElement("a");
                link.href = "/batch/" + dataObject[i].batchId + "/class/" + dataObject[i].classId + "/pdf";
                link.classList.add("pdfButton");
                link.innerText = "PDF";
                linkButtonContainer.appendChild(link);
            
            }
            
            document.getElementById("container").appendChild(row);
            
        } //for        
        
        
    } // if
    
    
} // showBookmark



function removeWatchHistory(classId) {
    
    var dataObject = JSON.parse(localStorage.getItem('watchHistory'));

        
    for (var i =0; i< dataObject.length; i++) {
        var items = dataObject[i];
        if (items.classId == classId) {
            dataObject.splice(i, 1);
        }
    }
    
    localStorage.setItem('watchHistory', JSON.stringify(dataObject));
    
    document.getElementById(classId).remove();

}


</script>
                

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.register', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>