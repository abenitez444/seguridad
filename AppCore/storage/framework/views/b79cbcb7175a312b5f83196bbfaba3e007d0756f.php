<!DOCTYPE html>
<html lang="en">

<head>
    <title>EZ</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="2WEB">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:image" content="<?php echo e(asset('images/logo.png')); ?>"/>

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('styles/bootstrap4/bootstrap.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('styles/main_styles.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('styles/responsive.css')); ?>">
    <link href="<?php echo e(asset('plugins/fontawesome-free-5.0.1/css/fontawesome-all.css')); ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/OwlCarousel2-2.2.1/owl.carousel.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/OwlCarousel2-2.2.1/owl.theme.default.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/OwlCarousel2-2.2.1/animate.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/slick-1.8.0/slick.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('styles/carrito.css')); ?>">

    <?php echo $__env->yieldPushContent('css'); ?>
</head>

<body>
    <div class="super_container" id="mainComponent">

        <!-- Header -->
        <?php echo $__env->make('layouts.website.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


        <?php echo $__env->yieldContent('content'); ?>


        <!-- Footer --> 
        <?php echo $__env->make('layouts.website.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    
    <script src="<?php echo e(asset('js/jquery-3.3.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('styles/bootstrap4/popper.js')); ?>"></script>
    <script src="<?php echo e(asset('styles/bootstrap4/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/greensock/TweenMax.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/greensock/TimelineMax.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/scrollmagic/ScrollMagic.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/greensock/animation.gsap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/greensock/ScrollToPlugin.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/OwlCarousel2-2.2.1/owl.carousel.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/slick-1.8.0/slick.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/easing/easing.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
    <script src="<?php echo e(asset('js/rocket-loader.min.js')); ?>"></script>
    <!--<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.3&appId=911162389010101&autoLogAppEvents=1"></script>-->

    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/vue.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/axios.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/v-money-master/dist/v-money.js')); ?>"></script>
    <script type="text/javascript">
        const APP_URL = "<?php echo e(url('/')); ?>";
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
    

</body>

</html>
<?php /**PATH /opt/lampp/htdocs/ez/AppGestorContenido/resources/views/layouts/website/main.blade.php ENDPATH**/ ?>