<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <title><?php echo $__env->yieldContent('title'); ?> | Administrador</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo e(asset('resourcesApp/plugins/bootstrap/dist/css/bootstrap.min.css')); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('resourcesApp/fonts/font-awesome/css/font-awesome.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('resourcesApp/plugins/Ionicons/css/ionicons.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('resourcesApp/css/AdminLTE.min.css')); ?>">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
    page. However, you can choose any other skin. Make sure you
    apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="<?php echo e(asset('resourcesApp/css/skin-blue.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('resourcesApp/css/app.css')); ?>">

<!-- Google Font -->
<!--<link rel="stylesheet"
href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
<?php echo $__env->yieldPushContent('css'); ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b>DM</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Administrador</b></span>
            </a>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="<?php echo e(Auth::user()->getUrlImage()); ?>" class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs"><?php echo e(Auth::user()->name); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="<?php echo e(Auth::user()->getUrlImage()); ?>" class="img-circle" alt="User Image">

                                    <p>
                                        <?php echo e(Auth::user()->name); ?>

                                        <small><?php echo e(Auth::user()->email); ?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo e(route('user.showProfile', Auth::user()->id)); ?>" class="btn btn-default btn-flat">Perfil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Salir</a>
                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                            <?php echo csrf_field(); ?>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar user panel (optional) -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo e(Auth::user()->getUrlImage()); ?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo e(Auth::user()->name); ?></p>
                        <!-- Status -->
                        <a href="javascript:void(0)"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.dashboard')); ?>">
                            <i class="fa fa-dashboard"></i> 
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="header">BLOG</li>
                    <li class="<?php echo e(request()->routeIs('category.index') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('category.index')); ?>">
                            <i class="fa fa-tags"></i> 
                            <span>Categorías</span>
                        </a>
                    </li>
                    <li class="<?php echo e(request()->routeIs('comment.index') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('comment.index')); ?>">
                            <i class="fa fa-commenting"></i> 
                            <span>Comentarios</span>
                        </a>
                    </li>
                    <li class="<?php echo e(request()->routeIs('publication.index') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('publication.index')); ?>">
                            <i class="fa fa-th-list"></i> 
                            <span>Ver publicaciones</span>
                        </a>
                    </li>
                    <li class="<?php echo e(request()->routeIs('publication.create') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('publication.create')); ?>">
                            <i class="fa fa-edit"></i> 
                            <span>Nueva publicacion</span>
                        </a>
                    </li>

                    <li class="header">GENERAL</li>
                    <!-- Optionally, you can add icons to the links -->
                    <li class="<?php echo e(request()->routeIs('socialNetworks.index') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('socialNetworks.index')); ?>">
                            <i class="fa fa-group"></i> 
                            <span>Redes Sociales</span>
                        </a>
                    </li>                     
                    <li class="<?php echo e(request()->routeIs('email.index') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('email.index')); ?>">
                            <i class="fa fa-envelope"></i> 
                            <span>Emails</span>
                        </a>
                    </li>
                    <li class="<?php echo e(request()->routeIs('subscriber.index') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('subscriber.index')); ?>">
                            <i class="fa fa-group"></i> 
                            <span>Suscriptores</span>
                        </a>
                    </li>
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <?php echo $__env->yieldContent('content'); ?>
        
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
           
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2019 <a href="https://2web.us/">2web</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="<?php echo e(asset('resourcesApp/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo e(asset('resourcesApp/plugins/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/vue/vue.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/vue/axios.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('resourcesApp/js/admin/adminlte.min.js')); ?>"></script>
<script type="text/javascript">const APP_URL = "<?php echo e(asset('/')); ?>";</script>
<script src="<?php echo e(asset('resourcesApp/js/admin/main.js')); ?>"></script>
<?php echo $__env->yieldPushContent('js'); ?>
</body>
</html><?php /**PATH /opt/lampp/htdocs/paginasOdontologas/AppGestorContenido/resources/views/layouts/admin/main.blade.php ENDPATH**/ ?>