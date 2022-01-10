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

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/vendors/css/vendors.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/vendors/css/charts/apexcharts.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/vendors/css/extensions/tether-theme-arrows.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/vendors/css/extensions/tether.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/vendors/css/extensions/shepherd-theme-default.css')); ?>">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/bootstrap.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/bootstrap-extended.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/colors.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/components.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/themes/dark-layout.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/themes/semi-dark-layout.css')); ?>">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/core/menu/menu-types/vertical-menu.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/core/colors/palette-gradient.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/pages/dashboard-analytics.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/pages/card-analytics.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/plugins/tour/tour.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/plugins/forms/validation/form-validation.css')); ?>">
    <!-- END: Page CSS-->
    
    
    <!-- Theme style -->
    <?php echo $__env->yieldPushContent('css'); ?>
    <style type="text/css">
        /*.main-menu .navbar-header .navbar-brand .brand-logo {
            background: url(<?php echo e(asset('AppResources/images/favicon.png')); ?>) no-repeat;
            background-position: -65px -54px;
            height: 24px;
            width: 35px;
        }*/
    </style>
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/css/app.css')); ?>">
</head>
<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="semi-dark-layout">
    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
    </form>
    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand">
                        <div class="brand-logo"></div>
                        <h2 class="brand-text mb-0">Cappserito</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>"><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="feather icon-home"></i><span class="menu-title">Dashboard</span></a>
                </li>
                <?php if(Auth::user()->is_superadmin): ?>
                    <li class=" navigation-header"><span>Usuarios</span>
                    </li>
                    <li class=" nav-item <?php echo e(request()->routeIs('users.cooks') ? 'active' : ''); ?>"><a href="<?php echo e(route('users.cooks')); ?>"><i class="feather icon-users"></i><span class="menu-title">Cocineros</span></a>
                    </li>
                    <li class=" nav-item <?php echo e(request()->routeIs('users.customers') ? 'active' : ''); ?>"><a href="<?php echo e(route('users.customers')); ?>"><i class="feather icon-users"></i><span class="menu-title">Clientes</span></a>
                    </li>
                    <li class=" nav-item <?php echo e(request()->routeIs('users.cooks.administrative_fee') ? 'active' : ''); ?>"><a href="<?php echo e(route('users.cooks.administrative_fee')); ?>"><i class="fa fa-money"></i><span class="menu-title">Tarifas</span></a>
                    </li>
                    <li class=" navigation-header"><span>Reportes</span>
                    </li>
                    <li class=" nav-item"><a href="javascript:void(0)"><i class="feather icon-file"></i><span class="menu-title">Ingresos Totales</span></a>
                    </li>
                    <li class=" nav-item"><a href="javascript:void(0)"><i class="feather icon-file"></i><span class="menu-title">Servicios de Cocineros</span></a>
                    </li>
                    <li class=" nav-item"><a href="javascript:void(0)"><i class="feather icon-file"></i><span class="menu-title">Historial de pagos</span></a>
                    </li>
                    <li class=" nav-item"><a href="javascript:void(0)"><i class="feather icon-file"></i><span class="menu-title">Clasificación de estrellas</span></a>
                    </li>
                <?php elseif(Auth::user()->type == 1): ?>
                    <li class="nav-item <?php echo e(request()->routeIs('orders.index') ? 'active' : ''); ?>"><a href="<?php echo e(route('orders.index')); ?>"><i class="feather icon-shopping-bag"></i><span class="menu-title">Ordenes / Pedidos</span></a>
                    </li>
                    <li class="nav-item <?php echo e(request()->routeIs('services.index') ? 'active' : ''); ?>"><a href="<?php echo e(route('services.index')); ?>"><i class="feather icon-shopping-cart"></i><span class="menu-title">Servicios</span></a>
                    </li>
                    <li class="nav-item <?php echo e(request()->routeIs('additional.index') ? 'active' : ''); ?>"><a href="<?php echo e(route('additional.index')); ?>"><i class="feather icon-shopping-cart"></i><span class="menu-title">Adicionales</span></a>
                    </li>
                    <li class="nav-item <?php echo e(request()->routeIs('cook.shippingCost') ? 'active' : ''); ?>"><a href="<?php echo e(route('cook.shippingCost')); ?>"><i class="fa fa-money"></i><span class="menu-title">Costo del Envió</span></a>
                    </li>
                    <li class="nav-item <?php echo e(request()->routeIs('domiciliary.index') ? 'active' : ''); ?>"><a href="<?php echo e(route('domiciliary.index')); ?>"><i class="fa fa-users"></i><span class="menu-title">Domiciliarios</span></a>
                    </li>
                    <li class="nav-item <?php echo e(request()->routeIs('payment-gateway.index') ? 'active' : ''); ?>"><a href="<?php echo e(route('payment-gateway.index')); ?>"><i class="fa fa-credit-card"></i><span class="menu-title">Pasarelas de Pagos</span></a>
                    </li>
                    <li class="nav-item"><a href="javascript:void(0)"><i class="fa fa-star"></i><span class="menu-title">Calificaciones</span></a>
                    </li>
                    <li class=" navigation-header"><span>Reportes</span>
                    </li>
                    <li class=" nav-item"><a href="javascript:void(0)"><i class="feather icon-file"></i><span class="menu-title">Ingresos Totales</span></a>
                    </li>
                    <li class=" nav-item"><a href="javascript:void(0)"><i class="feather icon-file"></i><span class="menu-title">Historial de servicios</span></a>
                    </li>
                    <li class=" nav-item"><a href="javascript:void(0)"><i class="feather icon-file"></i><span class="menu-title">Historial de pagos</span></a>
                    </li>
                    <li class=" nav-item"><a href="javascript:void(0)"><i class="feather icon-file"></i><span class="menu-title">Ventas</span></a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">

        <!-- BEGIN: Header-->
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
            <div class="navbar-wrapper">
                <div class="navbar-container content">
                    <div class="navbar-collapse" id="navbar-mobile">
                        <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                            <ul class="nav navbar-nav">
                                <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                            </ul>
                        </div>
                        <ul class="nav navbar-nav float-right">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a></li>
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="javascript:void(0)" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="ficon feather icon-power"></i></a></li>
                            <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon feather icon-bell"></i><span class="badge badge-pill badge-primary badge-up">5</span></a>
                                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                    <li class="dropdown-menu-header">
                                        <div class="dropdown-header m-0 p-2">
                                            <h3 class="white">5 New</h3><span class="notification-title">App Notifications</span>
                                        </div>
                                    </li>
                                    <li class="scrollable-container media-list"><a class="d-flex justify-content-between" href="javascript:void(0)">
                                            <div class="media d-flex align-items-start">
                                                <div class="media-left"><i class="feather icon-plus-square font-medium-5 primary"></i></div>
                                                <div class="media-body">
                                                    <h6 class="primary media-heading">You have new order!</h6><small class="notification-text"> Are your going to meet me tonight?</small>
                                                </div><small>
                                                    <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">9 hours ago</time></small>
                                            </div>
                                        </a><a class="d-flex justify-content-between" href="javascript:void(0)">
                                            <div class="media d-flex align-items-start">
                                                <div class="media-left"><i class="feather icon-download-cloud font-medium-5 success"></i></div>
                                                <div class="media-body">
                                                    <h6 class="success media-heading red darken-1">99% Server load</h6><small class="notification-text">You got new order of goods.</small>
                                                </div><small>
                                                    <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">5 hour ago</time></small>
                                            </div>
                                        </a><a class="d-flex justify-content-between" href="javascript:void(0)">
                                            <div class="media d-flex align-items-start">
                                                <div class="media-left"><i class="feather icon-alert-triangle font-medium-5 danger"></i></div>
                                                <div class="media-body">
                                                    <h6 class="danger media-heading yellow darken-3">Warning notifixation</h6><small class="notification-text">Server have 99% CPU usage.</small>
                                                </div><small>
                                                    <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">Today</time></small>
                                            </div>
                                        </a><a class="d-flex justify-content-between" href="javascript:void(0)">
                                            <div class="media d-flex align-items-start">
                                                <div class="media-left"><i class="feather icon-check-circle font-medium-5 info"></i></div>
                                                <div class="media-body">
                                                    <h6 class="info media-heading">Complete the task</h6><small class="notification-text">Cake sesame snaps cupcake</small>
                                                </div><small>
                                                    <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">Last week</time></small>
                                            </div>
                                        </a><a class="d-flex justify-content-between" href="javascript:void(0)">
                                            <div class="media d-flex align-items-start">
                                                <div class="media-left"><i class="feather icon-file font-medium-5 warning"></i></div>
                                                <div class="media-body">
                                                    <h6 class="warning media-heading">Generate monthly report</h6><small class="notification-text">Chocolate cake oat cake tiramisu marzipan</small>
                                                </div><small>
                                                    <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">Last month</time></small>
                                            </div>
                                        </a></li>
                                    <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center" href="javascript:void(0)">Read all notifications</a></li>
                                </ul>
                            </li>
                            <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                    <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600"><?php echo e(Auth::user()->name); ?></span><span class="user-status"><?php echo e(Auth::user()->email); ?></span></div><span><img class="round" src="<?php echo e(Auth::user()->getUrlImage()); ?>" alt="avatar" height="40" width="40" /></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="<?php echo e(route('users.showProfile')); ?>"><i class="feather icon-user"></i> Editar Perfil</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="feather icon-power"></i> Salir</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- END: Header-->
        <div id="app-main">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light float-right">
        <p class="clearfix blue-grey lighten-2 mb-0"><span class="float-md-left d-block d-md-inline-block mt-25"><strong>Copyright &copy; 2019 <a href="http://2web.us">2Web</a>.</strong> All rights reserved.
        </p>
    </footer>
    <!-- END: Footer-->

<!-- REQUIRED JS SCRIPTS -->
<script src="<?php echo e(asset('AppResources/app-assets/vendors/js/vendors.min.js')); ?>"></script>

<!-- BEGIN: Page Vendor JS-->
<script src="<?php echo e(asset('AppResources/app-assets/vendors/js/charts/apexcharts.min.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/app-assets/vendors/js/extensions/tether.min.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/app-assets/vendors/js/extensions/shepherd.min.js')); ?>"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="<?php echo e(asset('AppResources/app-assets/js/core/app-menu.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/app-assets/js/core/app.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/app-assets/js/scripts/components.js')); ?>"></script>
<!-- END: Theme JS-->

<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/vue.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/axios.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>


<script type="text/javascript">const APP_URL = "<?php echo e(asset('/')); ?>";$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});axios.defaults.baseURL=APP_URL;const APP_ERRORS = "<?php echo e(session('errors') ? session('errors') : ''); ?>";</script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/main.js')); ?>"></script>
<?php echo $__env->yieldPushContent('vuejs'); ?>
<?php echo $__env->yieldPushContent('js'); ?>
</body>
</html><?php /**PATH /opt/lampp/htdocs/Cabpserito/AppCore/resources/views/layouts/admin/main.blade.php ENDPATH**/ ?>