<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">


    <title>Pure Basic</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css')); ?>/fontawesome/fontawesome-pro.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css')); ?>/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css')); ?>/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css')); ?>/nice-select.css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css')); ?>/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/scss/')); ?>/style.css">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/scss/')); ?>/responsive.css">

</head>

<body>
    <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>


    <?php echo $__env->yieldContent('content'); ?>


    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <script src="<?php echo e(asset('assets/js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery-3.7.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/magnific-popup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery.nice-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/swiper-bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>

    <?php echo $__env->yieldContent('js'); ?>



</body>

</html>
