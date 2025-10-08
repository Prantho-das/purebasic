@extends('layouts.admin')
@section('content')
    <div id="content-wrapper">

        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <a href="{{url('/admin/lecture-sheet')}}">
                            Lecture-Sheet</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/update/lecture-sheet')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Topic </label>
                                    <input type="hidden" name="id" value="{{$tak->id}}">
                                    <input type="text" name="title" class="form-control" value="{{$tak->title}}"
                                           placeholder="Topic">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Category</label>

                                    <select name="category" class="form-control">
                                        <option value="{{$tak->category}}">Select Category</option>
                                        <option value="Anatomy" {{$tak->category == 'Anatomy' ? 'selected' : '' }}>Anatomy</option>
                                        <option value="Physiology" {{$tak->category == 'Physiology' ? 'selected' : '' }}>Physiology</option>
                                        <option value="Oral_Anatomy" {{$tak->category == 'Oral_Anatomy' ? 'selected' : '' }}> Oral Anatomy</option>
                                        <option value="Oral_Physiology" {{$tak->category == 'Oral_Physiology' ? 'selected' : '' }}> Oral Physiology</option>
                                        <option value="General_Pathology" {{$tak->category == 'General_Pathology' ? 'selected' : '' }}> General Pathology</option>
                                        <option value="Microbiology" {{$tak->category == 'Microbiology' ? 'selected' : '' }}> Microbiology</option>
                                        <option value="Immunology" {{$tak->category == 'Immunology' ? 'selected' : '' }}> Immunology</option>
                                        <option value="Oral_Pathology" {{$tak->category == 'Oral_Pathology' ? 'selected' : '' }}> Oral Pathology</option>
                                        <option value="Periodontology" {{$tak->category == 'Periodontology' ? 'selected' : '' }}> Periodontology</option>
                                        <option value="Biochemistry" {{$tak->category == 'Biochemistry' ? 'selected' : '' }}> Biochemistry</option>
                                        <option value="Pharmacology" {{$tak->category == 'Pharmacology' ? 'selected' : '' }}> Pharmacology</option>
                                        <option value="Dentistry" {{$tak->category == 'Dentistry' ? 'selected' : '' }}> Dentistry </option>
                                        <option value="Workshop" {{$tak->category == 'Workshop' ? 'selected' : '' }}> Workshop</option>
                                        <option value="Clinical" {{$tak->category == 'Clinical' ? 'selected' : '' }}> Clinical</option>
                                        <option value="INBDE" {{$tak->category == 'INBDE' ? 'selected' : '' }}> INBDE</option>
                                        <option value="NDBE" {{$tak->category == 'NDBE' ? 'selected' : '' }}> NDBE</option>
                                        <option value="ADC" {{$tak->category == 'ADC' ? 'selected' : '' }}> ADC</option>
                                        <option value="Overseas" {{$tak->category == 'Overseas' ? 'selected' : '' }}> Overseas</option>
                                        <option value="Prometric_HAAD" {{$tak->category == 'Prometric_HAAD' ? 'selected' : '' }}> Prometric & HAAD</option>
                                        <option value="Research" {{$tak->category == 'Research' ? 'selected' : '' }}> Research</option>
                                        <option value="ORE" {{$tak->category == 'ORE' ? 'selected' : '' }}>ORE</option>
                                        <option value="Batch" {{$tak->category == 'Batch' ? 'selected' : '' }}>Batch</option>
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
                        <option value="{{$chap->id}}" {{$tak->cp_id == $chap->id ? 'selected' : '' }} >{{$chap->name}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>

                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Position</label>
                                    <div>
                                        <input {{ $tak->position == "Doctor" ? "checked" : "" }} type="radio" name="position" value="Doctor" id="doctor_radio_btn"
                                               class="doctor"> Doctor<br>
                                        <input {{ $tak->position == "Student" ? "checked" : "" }} type="radio" name="position" value="Student" id="student_radio_btn"
                                               class="student"> Student<br>

                                        @if ($errors->has('position'))
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('position') }}</strong>
                                                    </span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="doctor" style="{{ $tak->position == "Doctor" ? 'display:block;': 'display:none;' }}">
                                    <div class="form-group">
                                        <label>Qualification</label>
                                        <div>
                                            <input {{ $tak->levell == "MBBS" ? "checked" : "" }} type="radio" name="levell" value="MBBS"> MBBS<br>
                                            <input {{ $tak->levell == "BDS" ? "checked" : "" }} type="radio" name="levell" value="BDS"> BDS<br>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="student" style="{{ $tak->position == "Student" ? 'display:block;': 'display:none;' }}">
                                    <label>Graduate level ( If Student )</label>
                                    <div>
                                        <input {{ $tak->levell == "1st Prof" ? "checked" : "" }} type="radio" name="levell" value="1st Prof"> 1st Prof<br>
                                        <input {{ $tak->levell == "2nd Prof" ? "checked" : "" }} type="radio" name="levell" value="2nd Prof"> 2nd Prof<br>
                                        <input {{ $tak->levell == "3nd Prof" ? "checked" : "" }} type="radio" name="levell" value="3nd Prof"> 3rd Prof<br>
                                        <input {{ $tak->levell == "4th Prof" ? "checked" : "" }} type="radio" name="levell" value="4th Prof"> 4th Prof<br>
                                        <input {{ $tak->levell == "Final Prof" ? "checked" : "" }} type="radio" name="levell" value="Final Prof"> Final Prof<br>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Date & Time</label>
                                    <input type="text" name="dateTime" class="form-control" value="{{$tak->date_time}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Admission Batch</label>
                                    <select class="form-control" name="batch[]" multiple="">
                                        @foreach($datas as $data)
                                            @php
                                                $batch_id = App\LectureBatch::where('lecture_id',$tak->id)->where('membershipe_id',$data->id)->first();
                                            @endphp
                                            <option
                                                value="{{$data->id}}" {{ $data->id == ($batch_id->membershipe_id ?? 0) ? 'selected' : '' }}>{{$data->plan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                        </div>


                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Lecture Video</label>
                                    <input type="text" name="video" class="form-control" value="{{$tak->video}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Lacture Note</label>
                                    <input type="text" name="links" class="form-control" value="{{$tak->links}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Youtube video ID for app lecture</label>
                                    <input type="text" name="youtube_video_id" class="form-control" value="{{$tak->youtube_video_id}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Lacture Pdf</label>
                                    <input type="text" name="v_link" class="form-control" value="{{$tak->v_link}}">
                                </div>
                            </div>
                        </div>


                        <!--

                                          <div class="row">

                                            <div class="col-md-6">
                                              <div class="form-group">
                                            <label for="nf-email" class=" form-control-label">Thumb-Image</label>
                                            <input type="file" name="lc_image" class="form-control">
                                          </div>
                                           </div>

                                           <div class="col-md-6">
                                              <div class="form-group">
                                            <label for="nf-email" class=" form-control-label">Local Video</label>
                                            <input type="file" name="lc_video" class="form-control">
                                          </div>
                                           </div>
                                         </div> -->


                        <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">Necessary Extra Pdf</label>
                     <input type="text" name="pdf" class="form-control" value="{{$tak->pdf}}">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">Serial</label>
                     <input type="text" name="video_id" class="form-control" value="{{$tak->video_id}}">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">For Clinical Case, Enter 1</label>
                     <input type="text" name="clinical_case" class="form-control" value="{{$tak->clinical_case}}">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">Price</label>
                     <input type="text" name="price" class="form-control" value="{{$tak->price}}">
                  </div>
               </div>
                <div class="col-md-6">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">Quiz Id</label>
                     <input type="text" name="isExam" class="form-control" value="{{$tak->isExam}}">
                  </div>
               </div>
            </div>


					<div class="row">
					   <div class="col-md-6">
						  <div class="form-group">
							 <input type="checkbox" name="member_type" {{$tak->member_type == 'free' ? 'checked' : '' }}> Free User
						  </div>

                           <div class="form-group">
                               <input type="checkbox" name="lecture_exam" {{$tak->isExam == 'Yes' ? 'checked' : '' }} > Allow Lecture Wise Quiz
                           </div>
					   </div>
					 </div>


                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer small text-muted">www.purebasic.com.bd</div>
            </div>

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

        $('#doctor_radio_btn').on('click', function () {
            $('#student').hide();
            $('#doctor').show();
        })

        $('#student_radio_btn').on('click', function () {
            $('#doctor').hide();
            $('#student').show();
        })

    </script>
@endsection


