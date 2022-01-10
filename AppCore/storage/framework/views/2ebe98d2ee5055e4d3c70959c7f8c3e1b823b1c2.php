<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- Favicons -->
    <link id="favicon_logo" href="<?php echo e(asset('AppResources/login/img/icg-logo.png')); ?>" rel="icon">
    <link id="favicon_logo_2" href="<?php echo e(asset('AppResources/login/img/icg-logo.png')); ?>" rel="apple-touch-icon">
    
    <title><?php echo $__env->yieldContent('title'); ?> | Administrador</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <!-- <link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/bootstrap/dist/css/bootstrap.min.css')); ?>">-->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/fonts/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/plugins/fontawesome-free/css/all.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/Ionicons/css/ionicons.min.css')); ?>">
    
    <!-- Google Font: Source Sans Pro -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
    
    <!-- Theme style -->
    <?php echo $__env->yieldPushContent('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/css/adminlte.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/css/app.css')); ?>">
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
            <?php echo csrf_field(); ?>
        </form>

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
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('users.showProfile')); ?>">
                        <i class="fa fa-user"></i> Perfil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out-alt"></i> Salir
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="brand-link">
                <img src="<?php echo e(asset('AppResources/images/logo.jpg')); ?>" alt="Logo"  class="brand-image" style="opacity: .8">
                <span class="brand-text font-weight-light">ICG</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo e(Auth::user()->getUrlImage()); ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="<?php echo e(route('users.showProfile')); ?>" class="d-block"><?php echo e(Auth::user()->name); ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-map-marked-alt"></i>
                                <p>
                                    Geocalización
                                </p>
                            </a>
                        </li>
                        <?php if(Auth::user()->is_admin): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('station.index')); ?>" class="nav-link <?php echo e(request()->routeIs('station.index') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-street-view"></i>
                                <p>
                                    Estaciones
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('users.index')); ?>" class="nav-link <?php echo e(request()->routeIs('users.index') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Usuarios
                                </p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-header">REPORTES</li>
                        <?php if(auth()->user()->type == 1): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('client.reports.concentration')); ?>" class="nav-link <?php echo e(request()->routeIs('client.reports.concentration') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Concentración
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('client.reports.airQuality')); ?>" class="nav-link <?php echo e(request()->routeIs('client.reports.airQuality') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Calidad de Aire
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('client.reports.meteorology')); ?>" class="nav-link <?php echo e(request()->routeIs('client.reports.meteorology') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Meteorología
                                </p>
                            </a>
                        </li>
                        <?php else: ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('reports.concentration')); ?>" class="nav-link <?php echo e(request()->routeIs('reports.concentration') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Concentración
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('reports.airQuality')); ?>" class="nav-link <?php echo e(request()->routeIs('reports.airQuality') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Calidad de Aire
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('reports.meteorology')); ?>" class="nav-link <?php echo e(request()->routeIs('reports.meteorology') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Meteorología
                                </p>
                            </a>
                        </li>
                        <?php endif; ?>
                        
                        <?php if(Auth::user()->is_admin || Auth::user()->type == 2): ?>
                        <li class="nav-header">HISTÓRICOS</li>
                        
                        <li class="nav-item">
                            <a href="<?php echo e(route('data.index')); ?>" class="nav-link <?php echo e(request()->routeIs('data.index') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    Datos
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('monthly_average.index')); ?>" class="nav-link <?php echo e(request()->routeIs('monthly_average.index') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-percent"></i>
                                <p>
                                    Medias Mensuales
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('wind-roses.index')); ?>" class="nav-link <?php echo e(request()->routeIs('wind-roses.index') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-wind"></i>
                                <p>
                                    Rosas de Vientos
                                </p>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div id="app-main" class="content-wrapper">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
              <b>Version</b> 1.0.0
          </div>
          <strong>Copyright &copy; 2019 <a href="http://2web.us">2Web</a>.</strong> All rights
          reserved.
      </footer>
    </div>
    <!-- ./wrapper -->





<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="<?php echo e(asset('AppResources/js/jquery.min.js')); ?>"></script>
<!-- Bootstrap 3.3.7 -->
<!-- <script src="<?php echo e(asset('AppResources/plugins/bootstrap/dist/js/bootstrap.min.js')); ?>"></script> -->

<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/vue.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/axios.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>
<!-- App -->
<script src="<?php echo e(asset('AppResources/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/js/adminlte.min.js')); ?>"></script>


<script type="text/javascript">const APP_URL = "<?php echo e(asset('/')); ?>";$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});axios.defaults.baseURL=APP_URL;const APP_ERRORS = "<?php echo e(session('errors') ? session('errors') : ''); ?>";</script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/main.js')); ?>"></script>
<?php echo $__env->yieldPushContent('vuejs'); ?>
<?php echo $__env->yieldPushContent('js'); ?>
</body>
</html><?php /**PATH /opt/lampp/htdocs/icg/AppCore/resources/views/layouts/admin/main.blade.php ENDPATH**/ ?>