<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="La E.S.E. Hospital San Martín de Porres de Armenia - Antioquia es una institución de primer nivel de complejidad que ofrece sus servicios de salud, con énfasis, en la promoción de la salud y prevención de la enfermedad.">
    <meta name="author" content="">
    <meta name="keywords" content="hospital San Martín de Porres, servicios de salud, prevención en salud">

    <title><?php echo $__env->yieldContent('title'); ?> | <?php echo e($company['info']->name); ?></title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/open-iconic-bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/animate.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/intlTelInput.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/owl.theme.default.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/magnific-popup.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('css/aos.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('css/ionicons.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-datepicker.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/jquery.timepicker.css')); ?>">


    <link rel="stylesheet" href="<?php echo e(asset('css/flaticon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/icomoon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/responsive.css')); ?>">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('resourcesApp/fonts/font-awesome/css/font-awesome.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('resourcesApp/plugins/Ionicons/css/ionicons.min.css')); ?>">

    <?php echo $__env->yieldPushContent('css'); ?>
</head>
<body >
        <?php echo $__env->make('layouts.website.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->yieldContent('content'); ?>


        <?php echo $__env->make('layouts.website.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- loader
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div> -->


    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/vue/vue.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/vue/axios.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/app2.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('js'); ?>
    
    

    <script src="<?php echo e(asset('js/jquery-migrate-3.0.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.easing.1.3.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.stellar.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.magnific-popup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/aos.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.animateNumber.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap-datepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.timepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/scrollax.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/intlTelInput.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>

    

</body>
</html><?php /**PATH /media/th3khan/Disco de respaldo/Anthony/trabajos/proyectos laravel/GestorContenido/resources/views/layouts/website/main.blade.php ENDPATH**/ ?>