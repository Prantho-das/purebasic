@extends('layouts.register')
@section('content')

<div class="homeContainer" style="margin-top: 5rem; margin-bottom: 15rem;">

    
    <div class="row">
        
        <div class="col-3">&nbsp</div>
        
        <div class="col-6 marginAbove paddingBelow round centerText" id="studentsReview">
            
            <div id="reviewSlides">
                <h2>What our students say</h2>
        
                
                        
                @foreach ($review as $key => $value)
            
                        
                    <div class="reviewSlide">
                        
                        <h3 class="">{{$value->name}}</h3>
                        <p class="">{{$value->review}}</p>
                        
                    </div>
                        
                @endforeach
                
            
            </div>
    
            
        </div>
        
        <div class="col-3">&nbsp</div>
    
    </div>
    
    
    
    
    
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
            
            
            
            
                @foreach($mentors as $mentor)
            
                        
                        <div class="mentorSlide">
                            
                            <h3 class="w3-center">{{$mentor->name}}</h3>
                            <p class="w3-large">{{$mentor->designation}}</p>
                            
                        </div>
                        
                @endforeach
                
                
            </div>
            
    
            
        </div>
        
        <div class="col-3">&nbsp</div>
    
    </div>
    
    


</div>



<script>

let reviewIndex = 0;
let mentorIndex = 0;



reviewCarousel();
mentorCarousel();







function reviewCarousel() {
  let i;
  let elem = document.getElementsByClassName("reviewSlide");
  for (i = 0; i < elem.length; i++) {
    elem[i].style.display = "none";  
  }
  reviewIndex++;
  if (reviewIndex > elem.length) {reviewIndex = 1}    
  elem[reviewIndex-1].style.display = "block";  
  setTimeout(reviewCarousel, 6000); // Change image every 6 seconds
}



function mentorCarousel() {
  let i;
  let elem = document.getElementsByClassName("mentorSlide");
  for (i = 0; i < elem.length; i++) {
    elem[i].style.display = "none";  
  }
  mentorIndex++;
  if (mentorIndex > elem.length) {mentorIndex = 1}    
  elem[mentorIndex-1].style.display = "block";  
  setTimeout(mentorCarousel, 4000); // Change image every 6 seconds
}


</script>


   

@endsection
