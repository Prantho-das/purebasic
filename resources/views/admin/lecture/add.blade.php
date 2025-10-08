@extends('layouts.admin')
@section('content')
<div id="content-wrapper">
<div class="container-fluid">
   <div class="card mb-3">
      <div class="card-header">
         <div class="row">
            <div class="col-md-10">
               <a href="{{url('/admin/lecture-sheet')}}"></a></i>
               Lecture-Sheet</a>
            </div>
         </div>
      </div>
      <div class="card-body">
         <form action="{{url('/admin/upload/lecture-sheet')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                
              <div class="col-md-12">
                 <button type="submit" class="btn btn-primary btn-sm">
                 <i class="fa fa-dot-circle-o"></i> Submit
                 </button>
              </div>
              
              
               <div class="col-md-12">
                  <div class="form-group{{ $errors->has('title') ? ' is-invalid' : '' }}">
                     <label for="nf-email" class=" form-control-label"></label>
                     <input type="text" name="title" class="form-control" id="title"
                        placeholder="Topic">
                     @if ($errors->has('title'))
                     <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('title') }}</strong>
                     </span>
                     @endif
                  </div>
               </div>
               
                 <div class="col-md-12">
                     <div class="form-group">
                         <label for="nf-email" class=" form-control-label">Youtube video Id</label>
                         <input type="text" name="youtube_video_id" class="form-control" placeholder="Youtube video ID">
                     </div>
                 </div>

               <div class="col-md-6">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">Subject</label>
                     <select name="category" class="form-control">
                        <option value="Anatomy">Anatomy</option>
                        <option value="Physiology">Physiology</option>
                        <option value="Oral_Anatomy"> Oral Anatomy</option>
                        <option value="Oral_Physiology"> Oral Physiology</option>
                        <option value="General_Pathology"> General Pathology</option>
                        <option value="Microbiology"> Microbiology</option>
                        <option value="Immunology"> Immunology</option>
                        <option value="Oral_Pathology"> Oral Pathology</option>
                        <option value="Periodontology"> Periodontology</option>
                        <option value="Biochemistry"> Biochemistry</option>
                        <option value="Pharmacology"> Pharmacology</option>
                        <option value="Dentistry"> Dentistry</option>
                        <option value="Workshop"> Workshop</option>
                        <option value="Clinical"> Clinical</option>
                        <option value="INBDE"> INBDE</option>
                        <option value="NDBE"> NDBE</option>
                        <option value="ADC"> ADC</option>
                        <option value="Overseas"> Overseas</option>
                        <option value="Prometric_HAAD"> Prometric & HAAD</option>
                        <option value="Research"> Research</option>
                        <option value="ORE">ORE</option>
                        <option value="Batch" selected>Batch</option>
                     </select>
                  </div>
               </div>



               <div class="col-md-6">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">Chapter</label>
                     <select name="cp_id" class="form-control">
                        @php
                           $chapter=App\Chapter::where('status',1)->get();
                        @endphp
                        @foreach($chapter as $chap)
                        <option value="{{$chap->id}}">{{$chap->name}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               
                <div class="col-md-6">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">Admission Batch</label>
                     <select class="form-control" name="batch[]" multiple="">
                        @foreach($data as $data)
                        <option value="{{$data->id}}" {{$data->id == 49 ? 'selected' : ''}}>{{$data->plan}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">Serial</label>
                     <input type="text" name="video_id" class="form-control" value="{{$lastSerial + 1}}">
                  </div>
               </div>

            </div>
            

          

            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Position</label>
                     <div>
                        <input type="radio" name="position" value="Doctor" id="doctor_radio_btn"
                           class="doctor"> Doctor<br>
                        <input type="radio" name="position" value="Student" id="student_radio_btn"
                           class="student"> Student<br>
						 <input type="radio" name="position" value="Overseas" id="overseas_radio_btn"
                                                   class="overseas"> Overseas<br>

                        @if ($errors->has('position'))
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('position') }}</strong>
                        </span>
                        @endif
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div id="doctor" style="display: none;">
                     <div class="form-group">
                        <label>Qualification</label>
                        <div>
                           <input type="radio" name="levell" value="MBBS"> MBBS<br>
                           <input type="radio" name="levell" value="BDS"> BDS<br>
                        </div>
                     </div>
                  </div>
                  <div class="form-group" id="student" style="display:none;">
                     <label>Graduate level ( If Student )</label>
                     <div>
                        <input type="radio" name="levell" value="1st Prof"> 1st Prof<br>
                        <input type="radio" name="levell" value="2nd Prof"> 2nd Prof<br>
                        <input type="radio" name="levell" value="3rd Prof"> 3rd Prof<br>
                        <input type="radio" name="levell" value="4th Prof"> 4th Prof<br>
                        <input type="radio" name="levell" value="Final Prof"> Final Prof<br>
                     </div>
                  </div>
				   <div class="form-group" id="overseas" style="display:none;">
					   <label>Overseas</label>
					   <div>
						   <input type="radio" name="levell" value="ADC ( Australia)"> ADC ( Australia) <br>
						   <input type="radio" name="levell" value="INBDE ( USA) "> INBDE ( USA) <br>
						   <input type="radio" name="levell" value="NBDE ( Canada) "> NBDE ( Canada) <br>
						   <input type="radio" name="levell" value="ORE ( UK) "> ORE ( UK) <br>
						   <input type="radio" name="levell" value="MFDS ( UK) ">MFDS ( UK) <br>
						   <input type="radio" name="levell" value="HAAD / DHA / MOH ( Middle East)">HAAD / DHA / MOH ( Middle East)<br>
					   </div>
				   </div>

               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">Date & Time</label>
                     <input type="text" name="dateTime" class="form-control" value="{{old('dateTime')}}"
                        placeholder="DD/MM/YY">
                  </div>
               </div>
               
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">Lecture Video</label>
                     <input type="text" name="video" class="form-control" placeholder="Lecture Video">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">Lecture Note</label>
                     <input type="text" name="links" class="form-control" placeholder="Lacture Note">
                  </div>
               </div>
            </div>



            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">Lecture Pdf</label>
                     <input type="text" name="v_link" class="form-control" placeholder="Lacture Pdf">
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">Necessary Extra Pdf</label>
                     <input type="text" name="pdf" class="form-control">
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">For Clinical Case, Enter 1</label>
                     <input type="text" name="clinical_case" class="form-control">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">Price</label>
                     <input type="text" name="price" class="form-control">
                  </div>
               </div>
                <div class="col-md-6">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">Quiz Id</label>
                     <input type="text" name="isExam" class="form-control">
                  </div>
               </div>
            </div>

            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <input type="checkbox" name="member_type"> Free User
                  </div>

                   <div class="form-group">
                       <input type="checkbox" name="lecture_exam"> Allow Lecture Wise Quiz
                   </div>
               </div>
			 </div>


         </form>
         </div>
         <div class="card-footer small text-muted">www.purebasic.com.bd</div>
      </div>
   </div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
@endsection
@section('admin_js')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>

    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    let currentDate = new Date();
    
    document.getElementById('title').value = 'Live Class ( ' + currentDate.getDate() + " " + months[currentDate.getMonth()] + ", " + currentDate.getFullYear() + " ) ";
    
   $('#doctor_radio_btn').on('click', function () {
       $('#student').hide();
       $('#doctor').show();
   })

   $('#student_radio_btn').on('click', function () {
       $('#doctor').hide();
       $('#student').show();
   })

	$('#overseas_radio_btn').on('click', function () {
		$('#doctor').hide();
		$('#student').hide();
		$('#overseas').show();
	})


</script>
@endsection
