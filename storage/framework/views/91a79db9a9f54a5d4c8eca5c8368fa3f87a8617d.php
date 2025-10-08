<?php $__env->startSection('content'); ?>
    <div id="content-wrapper">

        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <a href="<?php echo e(url('/admin/lecture-sheet')); ?>">
                            Lecture-Sheet</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(url('/admin/update/lecture-sheet')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Topic </label>
                                    <input type="hidden" name="id" value="<?php echo e($tak->id); ?>">
                                    <input type="text" name="title" class="form-control" value="<?php echo e($tak->title); ?>"
                                           placeholder="Topic">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Category</label>

                                    <select name="category" class="form-control">
                                        <option value="<?php echo e($tak->category); ?>">Select Category</option>
                                        <option value="Anatomy" <?php echo e($tak->category == 'Anatomy' ? 'selected' : ''); ?>>Anatomy</option>
                                        <option value="Physiology" <?php echo e($tak->category == 'Physiology' ? 'selected' : ''); ?>>Physiology</option>
                                        <option value="Oral_Anatomy" <?php echo e($tak->category == 'Oral_Anatomy' ? 'selected' : ''); ?>> Oral Anatomy</option>
                                        <option value="Oral_Physiology" <?php echo e($tak->category == 'Oral_Physiology' ? 'selected' : ''); ?>> Oral Physiology</option>
                                        <option value="General_Pathology" <?php echo e($tak->category == 'General_Pathology' ? 'selected' : ''); ?>> General Pathology</option>
                                        <option value="Microbiology" <?php echo e($tak->category == 'Microbiology' ? 'selected' : ''); ?>> Microbiology</option>
                                        <option value="Immunology" <?php echo e($tak->category == 'Immunology' ? 'selected' : ''); ?>> Immunology</option>
                                        <option value="Oral_Pathology" <?php echo e($tak->category == 'Oral_Pathology' ? 'selected' : ''); ?>> Oral Pathology</option>
                                        <option value="Periodontology" <?php echo e($tak->category == 'Periodontology' ? 'selected' : ''); ?>> Periodontology</option>
                                        <option value="Biochemistry" <?php echo e($tak->category == 'Biochemistry' ? 'selected' : ''); ?>> Biochemistry</option>
                                        <option value="Pharmacology" <?php echo e($tak->category == 'Pharmacology' ? 'selected' : ''); ?>> Pharmacology</option>
                                        <option value="Dentistry" <?php echo e($tak->category == 'Dentistry' ? 'selected' : ''); ?>> Dentistry </option>
                                        <option value="Workshop" <?php echo e($tak->category == 'Workshop' ? 'selected' : ''); ?>> Workshop</option>
                                        <option value="Clinical" <?php echo e($tak->category == 'Clinical' ? 'selected' : ''); ?>> Clinical</option>
                                        <option value="INBDE" <?php echo e($tak->category == 'INBDE' ? 'selected' : ''); ?>> INBDE</option>
                                        <option value="NDBE" <?php echo e($tak->category == 'NDBE' ? 'selected' : ''); ?>> NDBE</option>
                                        <option value="ADC" <?php echo e($tak->category == 'ADC' ? 'selected' : ''); ?>> ADC</option>
                                        <option value="Overseas" <?php echo e($tak->category == 'Overseas' ? 'selected' : ''); ?>> Overseas</option>
                                        <option value="Prometric_HAAD" <?php echo e($tak->category == 'Prometric_HAAD' ? 'selected' : ''); ?>> Prometric & HAAD</option>
                                        <option value="Research" <?php echo e($tak->category == 'Research' ? 'selected' : ''); ?>> Research</option>
                                        <option value="ORE" <?php echo e($tak->category == 'ORE' ? 'selected' : ''); ?>>ORE</option>
                                        <option value="Batch" <?php echo e($tak->category == 'Batch' ? 'selected' : ''); ?>>Batch</option>
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-6">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">Chapter</label>
                     <select name="cp_id" class="form-control">
                        <?php
                           $chapter=App\Chapter::where('status',1)->get();
                        ?>
                        <?php $__currentLoopData = $chapter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($chap->id); ?>" <?php echo e($tak->cp_id == $chap->id ? 'selected' : ''); ?> ><?php echo e($chap->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </select>
                  </div>
               </div>

                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Position</label>
                                    <div>
                                        <input <?php echo e($tak->position == "Doctor" ? "checked" : ""); ?> type="radio" name="position" value="Doctor" id="doctor_radio_btn"
                                               class="doctor"> Doctor<br>
                                        <input <?php echo e($tak->position == "Student" ? "checked" : ""); ?> type="radio" name="position" value="Student" id="student_radio_btn"
                                               class="student"> Student<br>

                                        <?php if($errors->has('position')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('position')); ?></strong>
                                                    </span>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="doctor" style="<?php echo e($tak->position == "Doctor" ? 'display:block;': 'display:none;'); ?>">
                                    <div class="form-group">
                                        <label>Qualification</label>
                                        <div>
                                            <input <?php echo e($tak->levell == "MBBS" ? "checked" : ""); ?> type="radio" name="levell" value="MBBS"> MBBS<br>
                                            <input <?php echo e($tak->levell == "BDS" ? "checked" : ""); ?> type="radio" name="levell" value="BDS"> BDS<br>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="student" style="<?php echo e($tak->position == "Student" ? 'display:block;': 'display:none;'); ?>">
                                    <label>Graduate level ( If Student )</label>
                                    <div>
                                        <input <?php echo e($tak->levell == "1st Prof" ? "checked" : ""); ?> type="radio" name="levell" value="1st Prof"> 1st Prof<br>
                                        <input <?php echo e($tak->levell == "2nd Prof" ? "checked" : ""); ?> type="radio" name="levell" value="2nd Prof"> 2nd Prof<br>
                                        <input <?php echo e($tak->levell == "3nd Prof" ? "checked" : ""); ?> type="radio" name="levell" value="3nd Prof"> 3rd Prof<br>
                                        <input <?php echo e($tak->levell == "4th Prof" ? "checked" : ""); ?> type="radio" name="levell" value="4th Prof"> 4th Prof<br>
                                        <input <?php echo e($tak->levell == "Final Prof" ? "checked" : ""); ?> type="radio" name="levell" value="Final Prof"> Final Prof<br>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Date & Time</label>
                                    <input type="text" name="dateTime" class="form-control" value="<?php echo e($tak->date_time); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Admission Batch</label>
                                    <select class="form-control" name="batch[]" multiple="">
                                        <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $batch_id = App\LectureBatch::where('lecture_id',$tak->id)->where('membershipe_id',$data->id)->first();
                                            ?>
                                            <option
                                                value="<?php echo e($data->id); ?>" <?php echo e($data->id == ($batch_id->membershipe_id ?? 0) ? 'selected' : ''); ?>><?php echo e($data->plan); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>


                        </div>


                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Lecture Video</label>
                                    <input type="text" name="video" class="form-control" value="<?php echo e($tak->video); ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Lacture Note</label>
                                    <input type="text" name="links" class="form-control" value="<?php echo e($tak->links); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Youtube video ID for app lecture</label>
                                    <input type="text" name="youtube_video_id" class="form-control" value="<?php echo e($tak->youtube_video_id); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Lacture Pdf</label>
                                    <input type="text" name="v_link" class="form-control" value="<?php echo e($tak->v_link); ?>">
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
                     <input type="text" name="pdf" class="form-control" value="<?php echo e($tak->pdf); ?>">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">Serial</label>
                     <input type="text" name="video_id" class="form-control" value="<?php echo e($tak->video_id); ?>">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">For Clinical Case, Enter 1</label>
                     <input type="text" name="clinical_case" class="form-control" value="<?php echo e($tak->clinical_case); ?>">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">Price</label>
                     <input type="text" name="price" class="form-control" value="<?php echo e($tak->price); ?>">
                  </div>
               </div>
                <div class="col-md-6">
                  <div class="form-group">
                     <label for="nf-email" class=" form-control-label">Quiz Id</label>
                     <input type="text" name="isExam" class="form-control" value="<?php echo e($tak->isExam); ?>">
                  </div>
               </div>
            </div>


					<div class="row">
					   <div class="col-md-6">
						  <div class="form-group">
							 <input type="checkbox" name="member_type" <?php echo e($tak->member_type == 'free' ? 'checked' : ''); ?>> Free User
						  </div>

                           <div class="form-group">
                               <input type="checkbox" name="lecture_exam" <?php echo e($tak->isExam == 'Yes' ? 'checked' : ''); ?> > Allow Lecture Wise Quiz
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
<?php $__env->stopSection(); ?>


<?php $__env->startSection('admin_js'); ?>
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
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>