<?php $__env->startSection('content'); ?>
    <div id="content-wrapper">
        <div class="container-fluid">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <?php echo e($batchName); ?>

                        </div>
                        

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered yajra-datatable" width="100%">
                            <thead>
                            <tr role="row">

                                <th>Mobile</th>
                            </tr>
                            </thead>

                                              <tbody>
                                              <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              

                                                      
                                                      <td><?php echo e($value->student->mobile??''); ?></td>
                                                      
                                                  </tr>
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                              </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('admin_js'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.yajra-datatable').dataTable(
                {
                    ordering: false,
                    pageLength: 100,
                }
            );
        });


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>