@extends('layouts.register')
@section('content')

    <div class="container">
    
    
        @foreach($info as $key=>$data)

            <div class="row lectureContainer marginBelow">
                
                <div class="col-4">&nbsp</div>

                <div class="col-4 marginAbove round lecture">

                    
                    <p>
                        <a href="/batch/{{$batch_id . '/' . 'subjects'}}" class="tag">{{$data->category}}</a>&nbsp

                        @php
                        
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
                            
                            
                            
                        @endphp
                        <a href="/batch/{{$batch_id . '/' . 'subject/' . $subject_id . '/chapter'}}" class="tag">{{$chapterName}}</a>
                        
                        
                        
                        <a class="bookmark" id="{{$data->id}}" onclick="toggleBookmark({{json_encode($dataInfo)}})">&#x2730</a>
                    </p>
                    

                    @if(!empty($data->video || $data->youtube_video_id))
                    
                        <div class="videoButtonContainer">
                            <p id ="{{$data->id}}" style="margin: 0; text-align: center">{{($key + 1) . ". " . $data->title}}</p>
                            <a href="{{route('lecture_video',['batch_id'=>$batch_id,'id'=>$data->id])}}" class="videoButton" onclick="watchHistory({{json_encode($dataInfo)}})">&#x25B6</a>
                        </div>
                    @endif

                    <div>
                        @if(!empty($data->links))<a href="{{$data->links}}"  class="note1Button">Note 1</a> @endif
                        @if(!empty($data->pdf))<a href="{{$data->pdf}}" class="note2Button">Note 2</a> @endif
                        @if(!empty($data->v_link)) <a href="{{$data->v_link}}" class="pdfButton">PDF</a> @endif
                        @if(!empty($data->isExam)) <a href="{{'/batch/' . $batch_id . '/class/' . $data->id . '/quiz/' . $data->isExam}}" class="quizButton" >Quiz</a>@endif
                    </div>
                    
                </div>
                
                <div class="col-4">&nbsp</div>

            </div>
        @endforeach
    
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
                

@endsection

