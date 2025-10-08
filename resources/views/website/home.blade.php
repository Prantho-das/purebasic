@extends('layouts.register')
@section('content')

<div class="homeContainer">
    <div class="row batchCategories" style="margin-top:5rem;">
        
        <div class="col-3 hide-on-medium">&nbsp</div>
            
        <div class="col-6">
        
                
            <a href="#" class="batchCategory"><h3>Medicine</h3></a>
            
            <a href="/batches/category/2" class="batchCategory" style="margin-right:2%; margin-left:2%;"><h3>Dentistry</h3></a>
            
            <a href="#" class="batchCategory"><h3>BCS</h3></a>
            
        </div>
        
        <div class="col-3 hide-on-medium">&nbsp</div>
        
    </div>
    
    <div class="row batchCategories">
        
        <div class="col-3 hide-on-medium">&nbsp</div>
            
        <div class="col-6">
        
                
            <a href="/batches" class="activeCategory"><b>Ongoing Batches</b></a>
            
        </div>
        
        <div class="col-3 hide-on-medium">&nbsp</div>
        
    </div>
    
    
    <div class="row">
        
        <div class="col-3 hide-on-medium">&nbsp</div>
        
        <div class="col-6" id="banner">
    
            @foreach ($banners as $banner)
                <div class="bannerSlides" id="{{$banner->batch_id}}">
                    
                    @if($banner->batch_id)
                        <a href="/batch_details/{{$banner->batch_id}}">
             	            <img class="picture" src="{{asset('uploads/banner/'.$banner->image)}}">                           
                        </a>
                        
                    @else
                    
            	        <img class="picture" src="{{asset('uploads/banner/'.$banner->image)}}">
            	    @endif

            	</div>
            @endforeach
            
                <div class="centerText" style="margin-top: 0.8rem;"><a id="batch_details">Details</a></div>
            
            <!--div style="display: table-cell; vertical-align: middle;">
                <button class="moveButton" onclick="moveToBanner(-1)"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--la" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32" data-icon="la:angle-left"><path fill="currentColor" d="m19.031 4.281l-11 11l-.687.719l.687.719l11 11l1.438-1.438L10.187 16L20.47 5.719z"></path></svg></button>
                <button style="float:right" class="moveButton" onclick="moveToBanner(1)"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--la" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32" data-icon="la:angle-right"><path fill="currentColor" d="M12.969 4.281L11.53 5.72L21.812 16l-10.28 10.281l1.437 1.438l11-11l.687-.719l-.687-.719z"></path></svg></button>
            </div-->
            
        </div>
        
        <div class="col-3 hide-on-medium">&nbsp</div>
    
    </div>
    
    
    <div class="row">
        
        <div class="col-3 hide-on-medium">&nbsp</div>
            
        <div class="col-6 marginAbove">
        
                
            <a href="/student/free_lecture" class="freeCategory"><h3>Free Lecture</h3></a>
            
            <a href="/student/free_exam" class="freeCategory" style="margin-left:2%;"><h3>Free Exam</h3></a>
        </div>
        
        <div class="col-3 hide-on-medium">&nbsp</div>
        
    </div>
    
    
    <div class="row">
        
        <div class="col-3">&nbsp</div>
            
        <div class="col-6 noticeSlide" id="noticeSlide">
        
            <h3>Notice</h3>  
            <a href="https://bsmmu.edu.bd/notice-category/1/academic" class="noticeCategory"><h3>BSMMU</h3></a>
            
            <a href="https://www.bcps.edu.bd/notice.php" class="noticeCategory" style="margin-right:2%; margin-left:2%;"><h3>BCPS</h3></a>
            
            <a href="http://www.bpsc.gov.bd/site/view/psc_exam/BCS%20Examination/%E0%A6%AC%E0%A6%BF%E0%A6%B8%E0%A6%BF%E0%A6%8F%E0%A6%B8-%E0%A6%AA%E0%A6%B0%E0%A7%80%E0%A6%95%E0%A7%8D%E0%A6%B7%E0%A6%BE" class="noticeCategory"><h3>BCS</h3></a>
            
        </div>
        
        <div class="col-3">&nbsp</div>
        
    </div>
    
    
    
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
                
                <!--div>
                    <button class="moveButton" onclick="moveToReview(-1)"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--la" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32" data-icon="la:angle-left"><path fill="currentColor" d="m19.031 4.281l-11 11l-.687.719l.687.719l11 11l1.438-1.438L10.187 16L20.47 5.719z"></path></svg></button>
                    
                    <button style="float:right" class="moveButton" onclick="moveToReview(1)"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--la" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32" data-icon="la:angle-right"><path fill="currentColor" d="M12.969 4.281L11.53 5.72L21.812 16l-10.28 10.281l1.437 1.438l11-11l.687-.719l-.687-.719z"></path></svg></button>
                </div-->
            
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
                
                <!--div>
                    <button class="moveButton" onclick="moveToMentor(-1)"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--la" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32" data-icon="la:angle-left"><path fill="currentColor" d="m19.031 4.281l-11 11l-.687.719l.687.719l11 11l1.438-1.438L10.187 16L20.47 5.719z"></path></svg></button>
    
                    <button style="float:right" class="moveButton" onclick="moveToMentor(1)"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--la" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32" data-icon="la:angle-right"><path fill="currentColor" d="M12.969 4.281L11.53 5.72L21.812 16l-10.28 10.281l1.437 1.438l11-11l.687-.719l-.687-.719z"></path></svg></button>
                </div-->
                
            </div>
            
    
            
        </div>
        
        <div class="col-3">&nbsp</div>
    
    </div>
    
    
    <div class="row">
        
        <div class="col-3">&nbsp</div>
        
        <div class="col-6 marginAbove paddingBelow round" id="contact">
           
           <div id="contactSlide"> 
            
                <h2>Contact</h2>
                <h3>Pure Basic</h3>
                <p>
                    RH Home Center
                    <br>1st Floor
                    <br>Room 108-109
                    <br>Beside Asia Pacific University
                    <br>Opposite of Green Super Market
                    <br>Green Road, Dhaka
                    <br>Whatsapp +8801673652555
                    <br>Whatsapp +8801638885050
                </p>
                        
            </div>
            
        </div>
        
        <div class="col-3">&nbsp</div>
    
    </div>
    
    
    <div class="row">
        
        <div class="col-3">&nbsp</div>
        
        <div class="col-6 marginAbove paddingBelow round" id="map">
           
           <div id="mapSlide">
               
               <h3>Google Map</h3>
            
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1290.8908468430811!2d90.35912356698203!3d23.776223125699996!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8a386403aa5%3A0xb63766ad4b92bad6!2s74%2C%20R%20H%20Home%20Centre%2C%20B%2F1%20Green%20Rd%2C%20Dhaka%201215!5e0!3m2!1sen!2sbd!4v1678276726744!5m2!1sen!2sbd" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        
            </div>
            
        </div>
        
        <div class="col-3">&nbsp</div>
    
    </div>

</div>



<script>

var bannerIndex = 0;
var reviewIndex = 0;
var mentorIndex = 0;


bannerCarousel();
reviewCarousel();
mentorCarousel();



function bannerCarousel() {

  var i;
  var elem = document.getElementsByClassName("bannerSlides");
  for (i = 0; i < elem.length; i++) {
    elem[i].style.display = "none";  
  }
  bannerIndex++;
  if (bannerIndex > elem.length) {bannerIndex = 1}
  var banner = elem[bannerIndex-1];
  banner.style.display = "block";
  
  if (banner.id) {
    
    document.getElementById("batch_details").href = "/batch_details/" + elem[bannerIndex-1].id;
    document.getElementById("batch_details").style.visibility = "visible"; 

  } else {
    document.getElementById("batch_details").style.visibility = "hidden"; 
  }
  

  setTimeout(bannerCarousel, 5000); // Change image every 5 seconds
}




function reviewCarousel() {
  var i;
  var elem = document.getElementsByClassName("reviewSlide");
  for (i = 0; i < elem.length; i++) {
    elem[i].style.display = "none";  
  }
  reviewIndex++;
  if (reviewIndex > elem.length) {reviewIndex = 1}    
  elem[reviewIndex-1].style.display = "block";  
  setTimeout(reviewCarousel, 6000); // Change image every 6 seconds
}



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


   

@endsection
