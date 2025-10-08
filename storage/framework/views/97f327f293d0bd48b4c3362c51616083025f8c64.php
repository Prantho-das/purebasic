<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title>Pure Basic</title>
 <!-- Favicon and Touch Icons -->
        <link href="<?php echo e(asset('contents/website')); ?>/tak/images/favicon.png" rel="shortcut icon" type="image/png">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
        <link rel="stylesheet" href="<?php echo e(asset('contents/website')); ?>/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo e(asset('contents/website')); ?>/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="<?php echo e(asset('contents/website')); ?>/css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo e(asset('contents/website')); ?>/css/style.css">
        <link rel="stylesheet" href="<?php echo e(asset('contents/website')); ?>plyr.css" />
        <link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

		<!-- Load Faceb`ook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v7.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="101570048245910"
  logged_in_greeting="Hi! How can we help you?"
  logged_out_greeting="Hi! How can we help you?">
      </div>

        <?php echo $__env->yieldPushContent('css'); ?>
    </head>
    <style>


.video iframe{
       width: 189px !important;
    height: 54px !important;
}
.tab_hed {
    height: auto!important;
}
</style>
    <body>

		<?php if(session()->has('success')): ?>
		  <script>
		   swal({
			  title: "Good job!",
			  text: "Yor Account Create Success Please Wait For Approve",
			  icon: "success",
			  button: "Aww yiss!",
			});
		  </script>
		 <?php endif; ?>


<section id="menu_bar">
<div class="container">
<div class="row">
    <div class="col-md-12">
        <nav class="navbar navbar-expand-lg">
          <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
              <img src="<?php echo e(asset('contents/website')); ?>/tak/images/re.png" style="width: 150px">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="background: #fff;">
            <span class="navbar-toggler-icon" style="color:#000"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto color_white">
              <li class="nav-item active">
                <a class="nav-link" href="<?php echo e(url('/')); ?>">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('/')); ?>">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('/')); ?>">Courses</a>
              </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('free_class')); ?>">Free Class</a>
                </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('/')); ?>">Gallery</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('/')); ?>">Contact</a>
              </li>
               <?php
                $id=Session:: get('id');
                $profile=App\Student:: where('id',$id)->first();
                ?>
              <?php if($id): ?>


              <?php else: ?>
              <div style="margin-left: 125px"></div>
              <?php endif; ?>


                <?php if($id): ?>
              <div class="profile text-right" style=" margin-left: 125px;">
                  <li class="nav-item dropdown taaaaa">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo e($profile->name); ?>

                </a>
                <div class="dropdown-menu menu_dp_color" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="<?php echo e(url('/student/profile/'.$profile->id)); ?>">Profile</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="<?php echo e(url('/student/logout')); ?>">Logout</a>
                </div>
              </li>
              </div>
               <?php endif; ?>

            </ul>
          </div>
        </nav>
    </div>
</div>
</div>
</section>

        <?php echo $__env->make('website.success_error', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php echo $__env->yieldContent('content'); ?>
<section >
        <div class="container">
        <div class="footer">
          <div class="row">
          <div class="col-md-4">
          <div class="footer_right">
            <h5>Follow Me</h5>
            <ul>
              <a href="#" style="color: #000"><i class="fab fa-facebook-square"></i></a>
              <a href="#" style="color: #000"><i class="fab fa-twitter"></i></a>
              <a href="#" style="color: #000"><i class="fab fa-google"></i></a>
              <a href="#" style="color: #000"><i class="fab fa-skype"></i></a>
            </ul>
          </div>
          </div>
          <div class="col-md-4">
            <div class="footer_madle">
              <h5>Contact us</h5>
              <p><i class="fas fa-envelope"></i> Email: support@purebasic.com.bd</p>
              <p><i class="fas fa-phone"></i> Mobile: 01638-885050</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="footer_madle">
              <h5>Development</h5>
              <a href="https://codeforsoft.com/"><img src="https://codeforsoft.com/wp-content/uploads/2020/04/logo-for-website.png" style="    width: 44%;"></a>
            </div>
          </div>



        </div>
        </div>
      </div>
</section>

        <script src="<?php echo e(asset('contents/website')); ?>/js/vendor/modernizr-3.5.0.min.js"></script>
        <script src="<?php echo e(asset('contents/website')); ?>/js/vendor/jquery-3.2.1.min.js"></script>
        <script src="<?php echo e(asset('contents/website')); ?>/js/popper.min.js"></script>
        <script src="<?php echo e(asset('contents/website')); ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo e(asset('contents/website')); ?>/js/owl.carousel.min.js"></script>
        <script src="<?php echo e(asset('contents/website')); ?>/js/plugins.js"></script>
        <script src="<?php echo e(asset('contents/website')); ?>/js/main.js"></script>

        <script src="https://cdn.plyr.io/3.6.2/plyr.js"></script>
        <script src="<?php echo e(asset('contents/website')); ?>/plyr.js"></script>
        <script>
          const player = new Plyr('#player');
        </script>

        <script>
          $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
            startDate: '-3d'
          });
        </script>
        <?php echo $__env->yieldContent('down_jquery'); ?>
        <?php echo $__env->yieldPushContent('js'); ?>
    </body>
</html>
