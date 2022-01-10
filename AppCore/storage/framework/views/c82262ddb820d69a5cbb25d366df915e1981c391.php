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

  <!-- APP -->
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/css/app.css')); ?>">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background: url(<?php echo e(asset('AppResources/images/1.jpg')); ?>)">
<div class="login-box" id="login-box">
  <div class="login-logo">
    <a href="javascript:void(0)"><b>Gestor </b>de Contenido</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingrese sus credenciales para iniciar sesión</p>

    <form method="post" onsubmit="return false;" id="form" >
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" title="Ingrese el email registrado para ingresar al sistema." autofocus="autofocus" v-model="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password" title="Ingrese su contraseña de acceso." v-model="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember"> Recuerdame
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" :disabled="sending == true">
            <template v-if="!sending">
              <i class="fa fa-sign-in"></i> Ingresar
            </template>
            <template v-if="sending">
              <i class="fa fa-spinner fa-spin"></i>
            </template>
          </button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo e(asset('AppResources/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo e(asset('AppResources/plugins/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<!-- iCheck -->
<script src="<?php echo e(asset('AppResources/plugins/iCheck/icheck.min.js')); ?>"></script>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/vue.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/plugins/vue/axios.js')); ?>"></script>
<script type="text/javascript">
    const APP_URL = "<?php echo e(url('/')); ?>";
</script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/admin/login.js')); ?>"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
<?php /**PATH /opt/lampp/htdocs/AppGestor/AppGestorContenido/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>