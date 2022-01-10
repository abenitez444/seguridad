<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dr. Fernando Bulla | Medicina Dermatológica Oncológica</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="img/favicon.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="<?php echo e(asset('lib/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="<?php echo e(asset('lib/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('lib/animate/animate.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('lib/ionicons/css/ionicons.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('lib/owlcarousel/assets/owl.carousel.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('lib/lightbox/css/lightbox.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/plugins/floating-whatsapp/floating-wpp.css')); ?>">

    <!-- Main Stylesheet File -->
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
    <style type="text/css">
      #accordion .card-body {
        background: #1d1c1c;
      }

      #accordion .card-body p {
        color: white;
        font-weight: 300;
      }

       .card-header .mb-0 .btn-link {
        color: #4D4D4D;
        font-weight: 500;
      }

      .card-header .mb-0 .btn-link i{
        color: #156A9B;
        padding-right: 10px;
      }

       .card-header .mb-0 .btn-link:hover {
        color: #156A9B;
        font-weight: 500;
        text-decoration: none;
      }

      .card {
        -webkit-box-shadow: 10px 13px 26px -6px rgba(0,0,0,0.35);
        -moz-box-shadow: 10px 13px 26px -6px rgba(0,0,0,0.35);
        box-shadow: 10px 13px 26px -6px rgba(0,0,0,0.35);      
      }

      .pa {
        padding: 20px;
        background: white;
        border-radius: 20px;
        -webkit-box-shadow: 10px 13px 26px -6px rgba(0,0,0,0.35);
        -moz-box-shadow: 10px 13px 26px -6px rgba(0,0,0,0.35);
        box-shadow: 10px 13px 26px -6px rgba(0,0,0,0.35);
      }

      .pa p,h3 {
        color: #666666;
        text-align: left;
        font-weight: 200;
      }
    </style>
    <?php echo $__env->yieldPushContent('css'); ?>
</head>

<body>
    <div id="mainComponent">
        <?php echo $__env->make('layouts.website.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


        <?php echo $__env->yieldContent('content'); ?>

        <?php /* @include('layouts.website.modals') */ ?>

        <!-- Footer --> 
        <?php echo $__env->make('layouts.website.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <whatsapp-floating></whatsapp-floating>

    </div>   
    
    <!-- JavaScript Libraries -->
    <script src="<?php echo e(asset('lib/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/jquery/jquery-migrate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/easing/easing.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/superfish/hoverIntent.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/superfish/superfish.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/wow/wow.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/waypoints/waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/counterup/counterup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/owlcarousel/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/isotope/isotope.pkgd.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/lightbox/js/lightbox.min.js')); ?>"></script>
    <script src="<?php echo e(asset('lib/touchSwipe/jquery.touchSwipe.min.js')); ?>"></script>
    

    <!-- Template Main Javascript File -->
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/floating-whatsapp/floating-wpp.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/vue.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/axios.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/v-money-master/dist/v-money.js')); ?>"></script>
    <script type="text/javascript">
        const APP_URL = "<?php echo e(url('/')); ?>";
        const STORAGE_URL = "<?php echo e(url('storage')); ?>/";
        <?php if(auth()->guard()->check()): ?>
        APP_USER = {
            id: "<?php echo e(Auth::user()->id); ?>",
            name: "<?php echo e(Auth::user()->name); ?>",
            email: "<?php echo e(Auth::user()->email); ?>",
            phone: "<?php echo e(Auth::user()->phone); ?>",
        };
        <?php else: ?>
        APP_USER = null;
        <?php endif; ?>
    </script>
    <?php echo $__env->yieldPushContent('js'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/app/main.js')); ?>"></script>
    <!-- Contact Form JavaScript File -->
    <script src="<?php echo e(asset('contactform/contactform.js')); ?>"></script>
</body>
</html>
<?php /**PATH /opt/lampp/htdocs/AppSistemasIntegrados/AppCore/resources/views/layouts/website/main.blade.php ENDPATH**/ ?>