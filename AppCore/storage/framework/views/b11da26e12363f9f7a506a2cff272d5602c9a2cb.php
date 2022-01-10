<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Favicons -->
    <link id="favicon_logo" href="<?php echo e(asset('AppResources/login/img/logo-sidg.png')); ?>" rel="icon">
    <link id="favicon_logo_2" href="<?php echo e(asset('AppResources/login/img/logo-sidg.png')); ?>" rel="apple-touch-icon">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/bootstrap/dist/css/bootstrap.min.css')); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/fonts/font-awesome/css/font-awesome.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/Ionicons/css/ionicons.min.css')); ?>">

    <!-- animate -->
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/animate/animate.min.css')); ?>">

    <!-- STYLE LOGIN -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/login/css/style.css')); ?>">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
</head>

<body>
    <main id="main">

        <section id="contact" class="section-bg wow fadeInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 colbor">
                        <img class="logo-sidg" src="<?php echo e(asset('AppResources/login/img/logo-sidg.png')); ?>">
                    </div>
                    <div class="byecol col-md-1">

                    </div>

                    <div class="col-md-5">
                        <h2>BIENVENIDOS</h2>
                        <div class="form">
                            <form role="form" method="post" onsubmit="return false;" id="form">
                                <div class="form-row">
                                    <div class="form-group col-md-12 has-feedback">
                                        <h3>Usuario</h3>
                                        <input type="text" name="email" class="form-control" id="email" placeholder="Ingrese su email para el ingreso al sistema" autofocus="autofocus" v-model="email" />
                                    </div>
                                    <div class="form-group col-md-12 has-feedback">
                                        <h3>Contraseña</h3>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" v-model="password" />
                                    </div>
                                    <div style="margin: 20px 0;">
                                        <input class="chec" type="checkbox" name="remember">
                                        <b> MANTENER SESIÓN INICIADA</b>
                                    </div>
                                </div>

                                <div class="">
                                    <button type="submit" :disabled="sending == true">
                                        <template v-if="!sending">
                                            <i class="fa fa-sign-in"></i> INGRESAR
                                        </template>
                                        <template v-if="sending">
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </template>
                                    </button>
                                </div>
                                <a href="#" style="text-align: center;"><h3>Recuperar Contraseña</h3></a>
                            </form>
                        </div>
                    </div>
                    <div class="byecol col-md-1">

                    </div>
                </div>
            </div>
        </section><!-- #contact -->

    </main>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="<?php echo e(asset('AppResources/plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo e(asset('AppResources/plugins/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/wow/wow.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/superfish/hoverIntent.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/superfish/superfish.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/vue.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/axios.js')); ?>"></script>
    <script type="text/javascript">
        const APP_URL = "<?php echo e(url('/')); ?>";
    </script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/login/js/main.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/login.js')); ?>"></script>
</body>
</html>
<?php /**PATH /opt/lampp/htdocs/AppSistemasIntegrados/AppCore/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>