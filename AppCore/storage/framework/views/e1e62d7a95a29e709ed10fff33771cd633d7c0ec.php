<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keywood</title>
    <link rel="stylesheet" href="<?php echo e(asset('bootstrap4.1.3/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/vista.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('fontawesome-5.3.1/css/all.min.css')); ?>">
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('bootstrap4.1.3/js/bootstrap.min.js')); ?>"></script>

    <?php echo $__env->yieldPushContent('css'); ?>

    <!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <?php echo $__env->make('layouts.website.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <!-- Header -->
    <?php echo $__env->make('layouts.website.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <?php echo $__env->yieldContent('content'); ?>


    <!-- Footer --> 
    <?php echo $__env->make('layouts.website.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/vue.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/axios.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/v-money-master/dist/v-money.js')); ?>"></script>
    <script type="text/javascript">
        const APP_URL = "<?php echo e(url('/')); ?>";
    </script>
    
    <?php echo $__env->yieldPushContent('js'); ?>

</body>

</html>
<?php /**PATH /opt/lampp/htdocs/keywood/AppGestorContenido/resources/views/layouts/website/main.blade.php ENDPATH**/ ?>