@extends('layouts.register')
@section('content')
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
                @foreach($enrolledBatches as $batch)
            
                        @php
                            $endStr = substr($batch->subscription_end,0,10);
                            

                            $end = new DateTime($endStr);

                            $current = new DateTime(date("Y-m-d"));


                            $remaining = $end->diff($current)->format('%a');
                        
                        @endphp

                        <div class="enrolledProgram">
      
                            <h2 class="batchTitle">{{$batch->title}}</h2>


                    

                            <div>
                                Subscription remaining : <span class= {{(int)$remaining <= 15 ? "red" : "green"}}>{{$remaining}} Days</span> 
                            </div>

                        
                            <div style="padding-top: 2rem; padding-bottom: 2rem;">
                                
                                <a class="centerText lectureLink linkCategory" href="{{url('batch/'.$batch->batch_id.'/subjects')}}">Go To Lecture</a>
                                
                                @if ($batch->fild_5)
                                
                                    <a class="centerText scheduleLink linkCategory" href="{{$batch->fild_5}}">Schedule</a>
                                @endif
                                
                            </div>




                        </div>
                		  


                @endforeach
    
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

@endsection
