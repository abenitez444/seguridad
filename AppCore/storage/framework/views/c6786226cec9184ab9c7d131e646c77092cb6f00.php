<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- Favicons -->
    <link id="favicon_logo" href="<?php echo e(asset('AppResources/login/img/logo-sidg.png')); ?>" rel="icon">
    <link id="favicon_logo_2" href="<?php echo e(asset('AppResources/login/img/logo-sidg.png')); ?>" rel="apple-touch-icon">
    
    <title><?php echo $__env->yieldContent('title'); ?> | Administrador</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <!-- <link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/bootstrap/dist/css/bootstrap.min.css')); ?>"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/fonts/font-awesome/css/font-awesome.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/Ionicons/css/ionicons.min.css')); ?>">


    <!-- Theme style -->
    <link href="<?php echo e(asset('AppResources/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('AppResources/css/metismenu.min.css')); ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/css/icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/css/app.css')); ?>">

<?php echo $__env->yieldPushContent('css'); ?>
</head>
<body>
    <div id="wrapper">
        <!-- Main Header -->
        <header>

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="<?php echo e(route('admin.dashboard')); ?>/" class="logo">
                        <?php if(Auth::user()->is_admin): ?>
                        <span class="logo-light">
                            <img width="70" src="<?php echo e(asset('AppResources/images/logo3.png')); ?>">
                        </span>
                        <span class="logo-sm">
                            <img width="70" src="<?php echo e(asset('AppResources/images/logo3.png')); ?>">
                        </span>
                        <?php else: ?>
                            <span class="logo-light">
                                <img style="width: 67px; max-width: 67px;" src="<?php echo e(Auth::user()->getUrlImage()); ?>">
                            </span>
                            <span class="logo-sm">
                                <img style="width: 67px; max-width: 67px;" src="<?php echo e(Auth::user()->getUrlImage()); ?>">
                            </span>
                        <?php endif; ?>
                    </a>
                </div>

                <nav class="navbar-custom">
                    <div class="row">
                        <div class="col-2 col-sm-2 col-md-2 col-lg-2">
                            <ul class="list-inline menu-left mb-0">
                                <li class="float-left">
                                    <button class="button-menu-mobile open-left waves-effect">
                                        <i class="mdi mdi-menu"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <?php if(!Auth::user()->is_admin): ?>
                            <!-- <ul class="list-inline menu-center mb-0 title-residential">
                                <li></li>
                            </ul> -->
                            
                            <div class="col-7 col-sm-7 col-md-7 col-lg-7">
                                <h5 class="title-residential"><?php echo e(Auth::user()->name); ?></h5>
                            </div>
                        <?php else: ?>
                            <div class="col-7 col-sm-7 col-md-7 col-lg-7 title-residential">
                                
                            </div>
                        <?php endif; ?>
                        <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                            <ul class="navbar-right list-inline float-right mb-0">
                            
                                <!-- full screen -->
                                <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
                                    <a class="nav-link waves-effect" href="#" id="btn-fullscreen">
                                        <i class="mdi mdi-arrow-expand-all noti-icon"></i>
                                    </a>
                                </li>

                                <li class="dropdown notification-list list-inline-item">
                                    <div class="dropdown notification-list nav-pro-img">
                                        <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                            <img src="<?php echo e(Auth::user()->getUrlImage()); ?>" alt="user" class="rounded-circle">
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                            <!-- item-->
                                            <a class="dropdown-item" href="<?php echo e(route('showProfile')); ?>"><i class="mdi mdi-account-circle"></i> Perfil</a>
                                            
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="mdi mdi-power text-danger"></i> Salir</a>
                                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                                <?php echo csrf_field(); ?>
                                            </form>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    
                    </div>

                </nav>

            </div>
            <!-- Top Bar End -->
        </header>

        

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Menu</li>
                            <li>
                                <a href="<?php echo e(route('admin.dashboard')); ?>/" class="waves-effect">
                                    <i class="icon-accelerator"></i> <span> Estadísticas </span>
                                </a>
                            </li>
                            <?php if(Auth::user()->is_admin): ?>
                                <li>
                                    <a href="<?php echo e(route('conjuntos-residenciales.index')); ?>" class="waves-effect">
                                        <i class="icon-paper-pencil"></i> <span> Conjuntos Residenciales </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('listElementsByZoneName')); ?>/?element_name=Zona Propietarios&element_type=zones&element_slug=zona-propietarios" class="waves-effect <?php echo e(request()->routeIs('listElementsByZoneName') && request()->has('element_slug') && request()->get('element_slug') == 'zona-propietarios' ? 'mm-active' : ''); ?> ">
                                        <i class="mdi mdi-account-badge-horizontal-outline"></i> <span> Zona Propietarios </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('listElementsByZoneName')); ?>/?element_name=Zona Residente&element_type=zones&element_slug=zona-residente" class="waves-effect <?php echo e(request()->routeIs('listElementsByZoneName') && request()->has('element_slug') && request()->get('element_slug') == 'zona-residente' ? 'mm-active' : ''); ?> ">
                                        <i class="mdi mdi-account-badge-outline"></i> <span> Zonas Residente </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('listElementsByZoneName')); ?>/?element_name=Zona Vehículo&element_type=zones&element_slug=zona-vehiculo" class="waves-effect <?php echo e(request()->routeIs('listElementsByZoneName') && request()->has('element_slug') && request()->get('element_slug') == 'zona-vehiculo' ? 'mm-active' : ''); ?> ">
                                        <i class="mdi mdi-car-back"></i> <span> Zona Vehículo </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('listElementsByZoneName')); ?>/?element_name=Zona Proveedores&element_type=zones&element_slug=zona-proveedores" class="waves-effect <?php echo e(request()->routeIs('listElementsByZoneName') && request()->has('element_slug') && request()->get('element_slug') == 'zona-proveedores' ? 'mm-active' : ''); ?> ">
                                        <i class="mdi mdi-car-pickup"></i> <span> Zona Proveedores </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('listElementsByZoneName')); ?>/?element_name=Zona SST&element_type=zones&element_slug=zona-visitante" class="waves-effect <?php echo e(request()->routeIs('listElementsByZoneName') && request()->has('element_slug') && request()->get('element_slug') == 'zona-visitante' ? 'mm-active' : ''); ?> ">
                                        <i class="mdi mdi-account-multiple-outline"></i> <span> Zona SST </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('task.index')); ?>" class="waves-effect <?php echo e(request()->routeIs('task.index') ? 'mm-active' : ''); ?> ">
                                        <i class="icon-paper-sheet"></i> <span> Alertas </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('viewElementByZoneName')); ?>/?element_name=Políticas Habeas Data&element_type=politicas&element_slug=politicas-habeas-data" class="waves-effect <?php echo e(request()->routeIs('viewElementByZoneName') && request()->has('element_slug') && request()->get('element_slug') == 'politicas-habeas-data' ? 'mm-active' : ''); ?> ">
                                        <i class="icon-paper-sheet"></i> <span> Politicas Habeas Data </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('manuals.index')); ?>" class="waves-effect <?php echo e(request()->routeIs('manuals.index') ? 'mm-active' : ''); ?> ">
                                        <i class="icon-paper-sheet"></i> <span> Manuales </span>
                                    </a>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a href="<?php echo e(route('departament.index')); ?>" class="waves-effect">
                                        <i class="mdi mdi-home-group"></i> <span> Registro de Apartamentos </span>
                                    </a>
                                </li>
                                <?php
                                 $zones = \App\User::find(Auth::user()->id)->residential()->first()->zones()->get();
                                 // dd($zones);
                                ?>
                                <?php $__currentLoopData = $zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('listDataByZoneName')); ?>/?element_name=<?php echo e($zone->element_name); ?>&element_type=<?php echo e($zone->element_type); ?>&element_slug=<?php echo e($zone->element_slug); ?>" class="waves-effect <?php echo e(request()->routeIs('listDataByZoneName') && request()->has('element_slug') && request()->get('element_slug') == $zone->element_slug ? 'mm-active' : ''); ?> ">
                                            <?php if($zone->element_slug == 'zona-propietarios'): ?>
                                                <i class="mdi mdi-account-badge-horizontal-outline"></i> 
                                            <?php elseif($zone->element_slug == 'zona-residente'): ?>
                                                <i class="mdi mdi-account-badge-outline"></i> 
                                            <?php elseif($zone->element_slug == 'zona-vehiculo'): ?>
                                                <i class="mdi mdi-car-back"></i>
                                            <?php elseif($zone->element_slug == 'zona-proveedores'): ?>
                                                <i class="mdi mdi-car-pickup"></i>
                                            <?php elseif($zone->element_slug == 'zona-visitante'): ?>
                                                <i class="mdi mdi-account-multiple-outline"></i>
                                            <?php endif; ?>
                                            <span> <?php echo e($zone->element_name); ?> </span>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a href="<?php echo e(route('task.index')); ?>" class="waves-effect <?php echo e(request()->routeIs('task.index') ? 'mm-active' : ''); ?> ">
                                        <i class="icon-paper-sheet"></i> <span> Alertas </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('showPolitics')); ?>" class="waves-effect">
                                        <i class="icon-paper-sheet"></i> <span> Politicas Habeas Data </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('ListManuales')); ?>" class="waves-effect">
                                        <i class="icon-paper-sheet"></i> <span> Manuales </span>
                                    </a>
                                </li>
                            <?php endif; ?>
                            

                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                    <span class="logo-light">
                        <img src="<?php echo e(asset('AppResources/images/logo2.png')); ?>" style="max-width: 100%;">
                    </span>
                </div>

                
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->
        </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-page">
        <div id="app-main" class="content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>

        <!-- Main Footer -->
        <footer class="footer">
            <!-- Default to the left -->
             © 2019 Sistemas Integrados de Gestión <span class="d-none d-sm-inline-block"> - Desarrollado por <a href="https://2web.us/">2web</a></span>.
        </footer>
        
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    
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
<script src="<?php echo e(asset('AppResources/js/metismenu.min.js')); ?>"></script>

<script src="<?php echo e(asset('AppResources/js/jquery.slimscroll.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/js/waves.min.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/js/app.js')); ?>"></script>


<script type="text/javascript">const APP_URL = "<?php echo e(asset('/')); ?>";$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});axios.defaults.baseURL=APP_URL;const APP_ERRORS = "<?php echo e(session('errors') ? session('errors') : ''); ?>";</script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/main.js')); ?>"></script>
<?php echo $__env->yieldPushContent('vuejs'); ?>
<?php echo $__env->yieldPushContent('js'); ?>
</body>
</html><?php /**PATH /opt/lampp/htdocs/AppSistemasIntegrados/AppCore/resources/views/layouts/admin/main.blade.php ENDPATH**/ ?>