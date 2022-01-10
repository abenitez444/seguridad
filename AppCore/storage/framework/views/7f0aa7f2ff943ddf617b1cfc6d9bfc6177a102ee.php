<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login | Cabpserito</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="" rel="icon">
    <link href="" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/vendors/css/vendors.min.css')); ?>">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/bootstrap.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/bootstrap-extended.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/colors.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/components.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/themes/dark-layout.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/themes/semi-dark-layout.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/plugins/forms/validation/form-validation.css')); ?>">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/core/menu/menu-types/vertical-menu.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/core/colors/palette-gradient.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/app-assets/css/pages/authentication.css')); ?>">
    <!-- END: Page CSS-->
</head>


<body class="vertical-layout vertical-menu-modern semi-dark-layout 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column" data-layout="semi-dark-layout">

    <main id="main">
        <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-xl-8 col-11 d-flex justify-content-center">
                        <div class="card bg-authentication rounded-0 mb-0">
                            <div class="row m-0">
                                <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                                    <img src="<?php echo e(asset("AppResources/app-assets/images/pages/login.png")); ?>" alt="branding logo">
                                </div>
                                <div class="col-lg-6 col-12 p-0">
                                    <div class="card rounded-0 mb-0 px-2">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="mb-0">Login</h4>
                                            </div>
                                        </div>
                                        <p class="px-2">Bienvenidos, ingrese sus datos de acceso al sistema.</p>
                                        <div class="card-content mb-3">
                                            <div class="card-body pt-1">
                                                <form id="form" method="post" onsubmit="return false;">
                                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                                        <input type="email" class="form-control" id="user-name" name="email" placeholder="Ingrese el correo electrónico" required>
                                                        <div class="form-control-position">
                                                            <i class="feather icon-user"></i>
                                                        </div>
                                                        <label for="user-name">Email</label>
                                                    </fieldset>

                                                    <fieldset class="form-label-group form-group  position-relative has-icon-left">
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingrse la contraseña de acceso" required>
                                                        <div class="form-control-position">
                                                            <i class="feather icon-lock"></i>
                                                        </div>
                                                        <label for="password">Contraseña</label>
                                                    </fieldset>
                                                    <div class="form-group d-flex justify-content-between align-items-center">
                                                        <div class="text-left">
                                                            <fieldset class="checkbox">
                                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                                    <input type="checkbox" name="remember">
                                                                    <span class="vs-checkbox">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                                    <span class="">Recordar datos</span>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                        <!-- <div class="text-right"><a href="auth-forgot-password.html" class="card-link">Forgot Password?</a></div> -->
                                                    </div>
                                                    <!-- <a href="auth-register.html" class="btn btn-outline-primary float-left btn-inline">Register</a>-->
                                                    <button type="submit" class="btn btn-primary float-right btn-inline" :disabled="sending == true">
                                                        <template v-if="!sending">
                                                            <i class="fa fa-sign-in"></i> INGRESAR
                                                        </template>
                                                        <template v-if="sending">
                                                            <i class="fa fa-spinner fa-spin"></i>
                                                        </template>
                                                    </button>
                                                    <!-- <button type="submit" >Ingresar</button>-->
                                                </form>
                                            </div>
                                        </div>
                                        <!-- <div class="login-footer">
                                            <div class="divider">
                                                <div class="divider-text">OR</div>
                                            </div>
                                            <div class="footer-btn d-inline">
                                                <a href="#" class="btn btn-facebook"><span class="fa fa-facebook"></span></a>
                                                <a href="#" class="btn btn-twitter white"><span class="fa fa-twitter"></span></a>
                                                <a href="#" class="btn btn-google"><span class="fa fa-google"></span></a>
                                                <a href="#" class="btn btn-github"><span class="fa fa-github-alt"></span></a>
                                            </div>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->
    </main>
    
    <script src="<?php echo e(asset('AppResources/app-assets/vendors/js/vendors.min.js')); ?>"></script>

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
<?php /**PATH /opt/lampp/htdocs/Cabpserito/AppCore/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>