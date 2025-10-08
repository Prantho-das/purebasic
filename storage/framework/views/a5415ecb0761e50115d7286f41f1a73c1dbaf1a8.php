<?php $__env->startSection('content'); ?>
    <div id="content-wrapper">
        <?php if(session()->has('success')): ?>
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Questions Create Success',
                    showConfirmButton: false,
                    timer: 1500
                })
            </script>
        <?php endif; ?>
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <a href="<?php echo e(url('/admin/all/job')); ?>"></a></i>
                            Questions Uploads
                        </div>
                        <div class="col-md-2">
                            <a href="<?php echo e(url('admin/question_bank_questions/'.$model->id)); ?>" class="btn btn-primary"><i
                                    class="fas fa-book"></i> All Questions</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(url('/admin/add/question_bank_questions/'.$model->id)); ?>" method="post"
                          enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="text" name="type" hidden value="<?php echo e($model["type"]); ?>">
                        <input type="number" name="subject_id" hidden value="<?php echo e($model["subject_id"]); ?>">
                        <input type="text" name="subject" hidden value="<?php echo e($model["subject"]); ?>">
                        <input type="number" name="chapter_id" hidden value="<?php echo e($model["chapter_id"]); ?>">
                        <input type="text" name="chapter" hidden value="<?php echo e($model["chapter"]); ?>">


                        <h3 class="bg-secondary" style="padding: 5px 15px;">Add Questions</h3>
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Questions name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                            <div class="form-group">
                                <input type="checkbox" name="is_multi" class="">
                                <label for="nf-email" class=" form-control-label">MCQ</label><br>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="is_free" class="">
                                <label for="nf-email" class=" form-control-label">Free</label><br>
                            </div>
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Questions Details</label>
                            <input type="text" name="detailss" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="nf-email" class=" form-control-label">Solve link</label>
                            <input type="text" name="solve_link" class="form-control">
                        </div>
                        
                        
                        <h3 class="bg-secondary" style="padding: 5px 15px;">Add Option</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Option A</label>
                                    <input type="text" name="option[1][option]" class="form-control" required
                                           value='A. '>
                                    <input type="checkbox" name="option[1][correct]" class="">
                                    <label for="nf-email" class=" form-control-label">Correct Ans ?</label><br>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Option B</label>
                                    <input type="text" name="option[2][option]" class="form-control" required
                                           value='B. '>
                                    <input type="checkbox" name="option[2][correct]" class="">
                                    <label for="nf-email" class=" form-control-label">Correct Ans ?</label><br>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Option C</label>
                                    <input type="text" name="option[3][option]" class="form-control" required
                                           value='C. '>
                                    <input type="checkbox" name="option[3][correct]" class="">
                                    <label for="nf-email" class=" form-control-label">Correct Ans ?</label><br>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Option D</label>
                                    <input type="text" name="option[4][option]" class="form-control" required
                                           value='D. '>
                                    <input type="checkbox" name="option[4][correct]" class="">
                                    <label for="nf-email" class=" form-control-label">Correct Ans ?</label><br>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nf-email" class=" form-control-label">Option E</label>
                                    <input type="text" name="option[5][option]" class="form-control" 
                                           value='E. '>
                                    <input type="checkbox" name="option[5][correct]" class="">
                                    <label for="nf-email" class=" form-control-label">Correct Ans ?</label><br>
                                </div>
                            </div>
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

    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>