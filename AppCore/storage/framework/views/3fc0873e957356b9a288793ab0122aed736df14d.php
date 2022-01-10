<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/bootstrap/dist/css/bootstrap.min.css')); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/fonts/font-awesome/css/font-awesome.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/Ionicons/css/ionicons.min.css')); ?>">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/css/AdminLTE.min.css')); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/iCheck/square/blue.css')); ?>">

    <!-- STYLE LOGIN -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/login/css/style.css')); ?>">

    <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
</head>

<body>
    <main id="main">

        <!--==========================
        Contact Section
        ============================-->
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
                            <form action="" method="post" role="form" class="contactForm">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <h3>Usuario</h3>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Usuario" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                        <div class="validation"></div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h3>Contraseña</h3>
                                        <input type="password" class="form-control" name="password" id="email" placeholder="Contraseña" data-rule="email" data-msg="Please enter a valid email" />
                                        <div class="validation"></div>
                                    </div>
                                    <div style="margin: 20px 0;">
                                        <input class="chec" type="checkbox" name="remember">
                                        <b> RECORDAR DATOS DE ACCESOS</b>
                                    </div>
                                </div>

                                <div class=""><button type="submit">INGRESAR</button></div>
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
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/vue.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/axios.js')); ?>"></script>
    <script type="text/javascript">
        const APP_URL = "<?php echo e(url('/')); ?>";
    </script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/login/js/main.js')); ?>"></script>
</body>
</html>
<?php /**PATH /home/abenitez444/localhost/app/AppCore/resources/views/auth/login.blade.php ENDPATH**/ ?>