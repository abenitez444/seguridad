<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ingeniería y Consultoría Global S.A.S | Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="<?php echo e(asset('AppResources/login/img/icg-logo.png')); ?>" rel="icon">
    <link href="<?php echo e(asset('AppResources/login/img/icg-logo.png')); ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet"> -->

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
</head>


<body>

    <main id="main">

        <!--==========================
        Contact Section
        ============================-->
        <section id="contact" class="section-bg wow fadeInUp">
            <div class="">
                <div class="row">
                    <div class="col-md-6 colbor">
                        <img class="logo-sidg" src="<?php echo e(asset('AppResources/login/img/icg-logo.png')); ?>">
                    </div>

                    <div class="colcol col-md-6">
                        <h2>BIENVENIDOS</h2>
                        <div class="form" v-if="typeForm == 1">
                            <form id="form" method="post" role="form" class="contactForm" onsubmit="return false;">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <h3>Usuario</h3>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Ingrese su usuario de acceso" autofocus="autofocus" />
                                        <div class="validation"></div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h3>Contraseña</h3>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="" data-rule="email" data-msg="Please enter a valid email" />
                                        <div class="validation"></div>
                                    </div>
                                    <div style="margin: 20px 0;">
                                        <input class="chec" type="checkbox" name="remember">
                                        <b> RECORDAR DATOS DE ACCESOS</b>
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
                                <a href="javascript:void(0)" v-on:click="typeForm = 2" style="text-align: center;"><h3>Recuperar Contraseña</h3></a>
                            </form>
                        </div>
                        <div class="form" v-if="typeForm == 2">
                            <form id="form" method="post" role="form" class="contactForm" onsubmit="return false;">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <h3>Ingrese su correo electrónico</h3>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Ingrese su usuario de acceso" autofocus="autofocus" v-model="email"/>
                                        <div class="validation"></div>
                                    </div>
                                </div>

                                <div class="">
                                    <button type="submit" :disabled="sending == true">
                                        <template v-if="!sending">
                                            <i class="fa fa-sign-in"></i> RECUPERAR
                                        </template>
                                        <template v-if="sending">
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </template>
                                    </button>
                                </div>
                                <a href="javascript:void(0)" v-on:click="typeForm = 1" style="text-align: center;"><h3>Volver al Login</h3></a>
                            </form>
                        </div>
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
<?php /**PATH /opt/lampp/htdocs/icg/AppCore/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>