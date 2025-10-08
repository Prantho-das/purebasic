<?php $__env->startSection('content'); ?>
    <div id="content-wrapper">

        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <a href="<?php echo e(url('/admin/all/job')); ?>"></a>
                            Exam Uploads
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(url('/admin/upload/model')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>


                        
                        
                        
                        
                        
                        
                        
                        
                        

                        <div class="form-group">
                            <label for="nf-pattern" class=" form-control-label">Exam Pattern</label>
                            <select class="form-control" required name="exam_pattern" id="nf-pattern">
                                <option value="">Choice option</option>
                                <option value="BCS">BCS</option>
                                <option value="Regular exam">Regular exam</option>
                                <option value="Lecture">Lecture Wise</option>
                                <option value="Clinical Case">Clinical Case</option>

                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="nf-type" class=" form-control-label">Exam Type</label>
                            <select class="form-control" required name="exam_type" id="nf-type">
                                <option value="">Choice option</option>
                                <option value="Free">Free Exam</option>
                                <option value="Premium" selected>Premium Exam</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Admission Batch</label>
                            <select class="form-control" name="batch[]" id="batch_id" required>
                                <?php $__currentLoopData = $memberbatch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($data->id); ?>"><?php echo e($data->plan); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group" id="lecture-div">
                            <label for="nf-email" class=" form-control-label">Select Lecture</label>
                            <select class="form-control" name="lecture" id="lecture_id">
                                <option value="select_lecture">Select Lecture</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Exam Name</label>
                            <input type="text" name="name" class="form-control" required placeholder="Exam Name">
                        </div>

                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Total Marks</label>
                            <input type="number" name="exam_in_minutes" class="form-control" required
                                   placeholder="Total Marks">
                        </div>

                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Exam Time</label>
                            <input type="number" name="ex_time" class="form-control" required placeholder="Exam Time">
                        </div>

                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Solve Class</label>
                            <input type="text" name="solve_shet" class="form-control" required
                                   placeholder="Solve Sheet">
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                    </form>
                </div>
                <div class="card-footer small text-muted"></div>
            </div>

        </div>

    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script type="text/javascript">
        $(document).ready(function () {

            $('#nf-pattern').on('change', function (){
                if ($('#nf-pattern').val() == 'BCS' || $('#nf-pattern').val() == 'Regular exam')
                    $('#lecture-div').hide();

                if ($('#nf-type').val() == 'Lecture')
                    
            });
            

            /*$('#batch_id').on('change', function () {
                var batchId = this.value;
                $('#lecture_id').html('');
                $.ajax({
                    url: '<?php echo e(route('get.lectures')); ?>?batch_id=' + batchId,
                    type: 'get',
                    success: function (res) {
                        $('#lecture_id').html('<option value="">Select Lecture</option>');
                        $.each(res, function (key, value) {
                            $('#lecture_id').append('<option value="' + value
                                .id + '">' + value.title + '</option>');
                        });

                        // $('#city').html('<option value="">Select Lecture</option>');
                    }
                });*/
            });
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

        });


    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>