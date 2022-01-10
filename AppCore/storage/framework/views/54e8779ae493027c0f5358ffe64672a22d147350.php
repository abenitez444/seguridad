<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="" rel="icon">
    <link href="" rel="apple-touch-icon">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/fontawesome-free/css/all.min.css')); ?>">
      <!-- Ionicons -->
      <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
      <!-- icheck bootstrap -->
      <link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
      <!-- Theme style -->
      <link rel="stylesheet" href="<?php echo e(asset('AppResources/template_html/dist/css/adminlte.min.css')); ?>">
      <!-- Google Font: Source Sans Pro -->
      <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/plugins/forms/validation/form-validation.css')); ?>">
    <style type="text/css">
        .login-box {
            width: 525px;
            min-width: 400px;
        }
    </style>
</head>


<body class="hold-transition login-page">

    <main id="main">
        <div class="login-box">
            <!-- 
                <div class="login-logo">
                    <a href="../../index2.html"><b>Administrador de</b> Sistema</a>
                </div> 
            -->
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 text-center">
                            <img src="<?php echo e(asset('img/logo.jpg')); ?>" class="img-fluid">
                        </div>
                    </div>
                    <p class="login-box-msg">Ingrese sus datos de accesos</p>
                    <form id="form_" onsubmit="return false;" method="post">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" id="user-name" name="email" placeholder="Ingrese el correo electrónico" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Ingrse la contraseña de acceso" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col-8">
                                <div class="">
                                    <input type="checkbox" name="remember">
                                    <label for="remember">
                                        Recordar mis datos
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" :disabled="sending == true" class="btn btn-primary btn-block">
                                    <template v-if="!sending">
                                        <i class="fa fa-sign-in"></i> INGRESAR
                                    </template>
                                    <template v-if="sending">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </template>
                                </button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <!-- <div class="social-auth-links text-center mb-3">
                        <p>- OR -</p>
                        <a href="#" class="btn btn-block btn-primary">
                            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                        </a>
                        <a href="#" class="btn btn-block btn-danger">
                            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                        </a>
                    </div>-->
                    <!-- /.social-auth-links -->

                    <!-- <p class="mb-1">
                        <a href="forgot-password.html">I forgot my password</a>
                    </p>-->
                    <!-- <p class="mb-0">
                        <a href="register.html" class="text-center">Register a new membership</a>
                    </p>-->
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </main>
    
    <!-- jQuery -->
    <script src="<?php echo e(asset('AppResources/plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo e(asset('AppResources/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('AppResources/template_html/dist/js/adminlte.min.js')); ?>"></script>
    <script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>

    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/vue.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/axios.js')); ?>"></script>
    <script type="text/javascript">
        const APP_URL = "<?php echo e(url('/')); ?>";
    </script>
    <script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/login.js')); ?>"></script>
</body>
</html>
<?php /**PATH /opt/lampp/htdocs/SeguridadLogro/AppCore/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>