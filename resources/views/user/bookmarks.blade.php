@extends('layouts.register')
@section('content')

    <div class="container" id="container">
    
    

    </div>
    

<script>

document. addEventListener("DOMContentLoaded", showBookmark);


function showBookmark() {

    var dataObject = localStorage.getItem('videoBookmark') ? JSON.parse(localStorage.getItem('videoBookmark')) : [];

    if (dataObject.length > 0) {

        for (var i =0; i< dataObject.length; i++) {
            
            const dataInfo = dataObject[i];
            
            const row = document.createElement("div");
            row.classList.add("row", "lectureContainer", "marginBelow");
            
            const col4 = document.createElement("div");
            col4.classList.add("col-4");
            col4.innerText = String.fromCharCode(160);
            row.appendChild(col4);
            
            const lecture = document.createElement("div");
            lecture.id = dataInfo.classId;
            lecture.classList.add("col-4", "marginAbove", "round", "lecture");
            row.appendChild(lecture);
            
            const bookmarkContainer = document.createElement("p");
            lecture.appendChild(bookmarkContainer);
            
            
            
            const bookmark = document.createElement("a");
            bookmark.addEventListener("click", function() {removeVideoBookmark( lecture.id);}, false);
            bookmark.classList.add("bookmark");
            bookmark.innerText = "\u2B50";
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
            link.addEventListener("click", function() {watchHistory(dataInfo);}, false);
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



function removeVideoBookmark(classId) {
    
    var dataObject = JSON.parse(localStorage.getItem('videoBookmark'));

        
    for (var i =0; i< dataObject.length; i++) {
        var items = dataObject[i];
        if (items.classId == classId) {
            dataObject.splice(i, 1);
        }
    }
    
    localStorage.setItem('videoBookmark', JSON.stringify(dataObject));
    
    document.getElementById(classId).remove();

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
                

@endsection

