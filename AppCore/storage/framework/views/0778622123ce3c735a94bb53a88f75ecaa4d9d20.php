<!DOCTYPE html>
<html>
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="owner" content="CAPPSERITO">
    <title>CAPPSERITO</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo e(asset('assets/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?php echo e(asset('assets/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/simple-line-icons/css/simple-line-icons.css')); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/favicon.png')); ?>"/>

    <!-- Custom styles for this template -->
    <link href="<?php echo e(asset('css/landing-page.css')); ?>" rel="stylesheet">
    <style type="text/css">
        .help-block {
            color: #dc3545;
        }
    </style>
    <?php echo $__env->yieldPushContent('css'); ?>
</head>
<body>
    <?php if(!request()->routeIs('website.registroChef') && !request()->routeIs('website.establecimientos') && !request()->routeIs('website.cooksProducts') && !request()->routeIs('website.checking')): ?>
        <?php echo $__env->make('layouts.website.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php elseif(request()->routeIs('website.checking')): ?>

    <?php else: ?>
        <?php echo $__env->make('layouts.website.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('layouts.website.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- REQUIRED JS SCRIPTS -->
<script src="<?php echo e(asset('AppResources/app-assets/vendors/js/vendors.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/vue.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/axios.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>


<script type="text/javascript">const APP_URL = "<?php echo e(asset('/')); ?>";$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});axios.defaults.baseURL=APP_URL;const APP_ERRORS = "<?php echo e(session('errors') ? session('errors') : ''); ?>";</script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/main.js')); ?>"></script>
<?php echo $__env->yieldPushContent('vuejs'); ?>
<?php echo $__env->yieldPushContent('js'); ?>

<script>
    

    var navbar = document.getElementById("navbar");
    console.log(navbar);
    if (navbar) {
        window.onscroll = function() {myFunction()};
        var sticky = navbar.offsetTop;

        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }
    }
    
</script>

<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
          panel.style.display = "none";
      } else {
          panel.style.display = "block";
      }
  });
  }
</script>

</body>
</html><?php /**PATH /opt/lampp/htdocs/SeguridadLogro/AppCore/resources/views/layouts/website/main.blade.php ENDPATH**/ ?>