<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- Favicons -->
    <link id="favicon_logo" rel="icon" href="<?php echo e(asset('AppResources/images/favicon.png')); ?>">
    <link id="favicon_logo_2" rel="apple-touch-icon" href="<?php echo e(asset('AppResources/images/favicon.png')); ?>">
    
    <title><?php echo $__env->yieldContent('title'); ?> | Administrador</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/fontawesome-free/css/all.min.css')); ?>">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/template_html/dist/css/adminlte.min.css')); ?>">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> 


    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/plugins/forms/validation/form-validation.css')); ?>">
    <!-- END: Page CSS-->
    
    
    <!-- Theme style -->
    <?php echo $__env->yieldPushContent('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/css/app.css')); ?>">
</head>
<body class="hold-transition sidebar-mini">
    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
    </form>
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#" style=" padding-top: 0px !important;">
                            <img src="<?php echo e(Auth::user()->getUrlImage()); ?>" class="img-circle elevation-2" alt="<?php echo e(Auth::user()->name); ?>" style="max-width: 35px; width: 35px;">
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header"><?php echo e(Auth::user()->email); ?></span>
                            <div class="dropdown-divider"></div>
                                <a href="<?php echo e(route('users.showProfile')); ?>" class="dropdown-item">
                                    <i class="fas fa-user mr-2"></i> Mi perfil
                                </a>
                                <div class="dropdown-divider"></div>
                                    <a href="javascript:void(0)" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt"></i> Cerrar sesi??n
                                    </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Cerrar sesi??n
                        </a>
                    </li>
                </ul>
            </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="brand-link">
                <img src="<?php echo e(asset('img/logo.jpg')); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo e(Auth::user()->getUrlImage()); ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="<?php echo e(route('users.showProfile')); ?>" class="d-block"><?php echo e(Auth::user()->email); ?></a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link <?php if(request()->routeIs('admin.dashboard') || request()->routeIs('admin.index')): ?> active <?php endif; ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('clients.index')); ?>" class="nav-link <?php if(request()->routeIs('clients.index')): ?> active <?php endif; ?>">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Puestos
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('watchmen.index')); ?>" class="nav-link <?php if(request()->routeIs('watchmen.index')): ?> active <?php endif; ?>">
                                <i class="nav-icon fas fa-user-secret"></i>
                                <p>
                                    Vigilantes
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.assignment')); ?>" class="nav-link <?php if(request()->routeIs('admin.assignment')): ?> active <?php endif; ?>">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>
                                    Programaci??n
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0
            </div>
            <strong>Copyright &copy; 2020 <a href="http://2web.us">2Web.us</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?php echo e(asset('AppResources/plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo e(asset('AppResources/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('AppResources/template_html/dist/js/adminlte.min.js')); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo e(asset('AppResources/template_html/dist/js/demo.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/vue.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/axios.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>


    <script type="text/javascript">const APP_URL = "<?php echo e(asset('/')); ?>";$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});axios.defaults.baseURL=APP_URL;const APP_ERRORS = "<?php echo e(session('errors') ? session('errors') : ''); ?>";</script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/main.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('vuejs'); ?>
    <?php echo $__env->yieldPushContent('js'); ?>
</body>
</html><?php /**PATH /opt/lampp/htdocs/SeguridadLogro/AppCore/resources/views/layouts/admin/main.blade.php ENDPATH**/ ?>