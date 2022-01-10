<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>WOMAN Colors</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('images/favicon.ico')); ?>">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    

    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <!-- Owl Carousel main css -->
    <link rel="stylesheet" href="<?php echo e(asset('css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/owl.theme.default.min.css')); ?>">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="<?php echo e(asset('css/core.css')); ?>">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="<?php echo e(asset('css/shortcode/shortcodes.css')); ?>">
    <!-- Theme main style -->
    <link rel="stylesheet" href="<?php echo e(asset('style.css')); ?>">
    <!-- Responsive css -->
    <link rel="stylesheet" href="<?php echo e(asset('css/responsive.css')); ?>">
    <!-- User style -->
    <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>">


    <!-- Modernizr JS -->
    <script src="<?php echo e(asset('js/vendor/modernizr-2.8.3.min.js')); ?>"></script>

    <?php echo $__env->yieldPushContent('css'); ?>

    <!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="wrapper fixed__footer">

        <!-- Header -->
        <?php echo $__env->make('layouts.website.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


        <?php echo $__env->yieldContent('content'); ?>


        <!-- Footer --> 
        <?php echo $__env->make('layouts.website.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    
    <!-- jquery latest version -->
    <script src="<?php echo e(asset('js/vendor/jquery-1.12.0.min.js')); ?>"></script>
    <!-- Bootstrap framework js -->
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <!-- All js plugins included in this file. -->
    <script src="<?php echo e(asset('js/plugins.js')); ?>"></script>
    <script src="<?php echo e(asset('js/slick.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/owl.carousel.min.js')); ?>"></script>
    <!-- Waypoints.min.js. -->
    <script src="<?php echo e(asset('js/waypoints.min.js')); ?>"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="<?php echo e(asset('js/main.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/vue.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/axios.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/v-money-master/dist/v-money.js')); ?>"></script>
    <script type="text/javascript">
        const APP_URL = "<?php echo e(url('/')); ?>";
    </script>
    <script type="text/javascript" src="<?php echo e(asset('js/app/main.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('js'); ?>

</body>

</html>
<?php /**PATH /opt/lampp/htdocs/woman/AppGestorContenido/resources/views/layouts/website/main.blade.php ENDPATH**/ ?>