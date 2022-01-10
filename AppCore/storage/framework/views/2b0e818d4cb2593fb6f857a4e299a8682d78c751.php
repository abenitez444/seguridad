<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Somos especialistas en Diseño de Páginas Web para Odontologos, Diseño de Logotipos y Creación de Marcas, Creación de Campañas de Marketing Odontologico. ¡Contáctanos Ya!">
    <meta name="author" content="2WEB">
    <meta name="keywords" content="diseño de páginas web odontologos, sitios web odontologos, software citas para Odontologos, diseño de logotipos, marketing digital para Odontologos, marketing Odontologico">

    <title>Diseño de Páginas Web Para Odontologos | 2WEB.US</title>

    <!-- Bootstrap-->
    <link href="<?php echo e(asset('vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">


    <!-- Theme CSS -->
    <link href="<?php echo e(asset('css/odonto.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/responsive.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/font-awesome.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/animate.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/intlTelInput.css')); ?>"  rel="stylesheet">
    <link href="<?php echo e(asset('css/floating-wpp.css')); ?>"  rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('resourcesApp/fonts/font-awesome/css/font-awesome.min.css')); ?>">

    <?php echo $__env->yieldPushContent('css'); ?>

    <script src='https://www.google.com/recaptcha/api.js'></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <?php echo $__env->make('layouts.website.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <!-- Header -->
    <?php echo $__env->make('layouts.website.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <?php echo $__env->yieldContent('content'); ?>


    <!-- Footer --> 
    <?php echo $__env->make('layouts.website.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- jQuery -->
        <script src="<?php echo e(asset('vendor/jquery/jquery.min.js')); ?>"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo e(asset('vendor/bootstrap/js/bootstrap.min.js')); ?>"></script>

        <!-- Contacto Form JavaScript -->
        <script src="<?php echo e(asset('js/jqBootstrapValidation.js')); ?>"></script>
        <!-- Tema JavaScript -->
        <script src="<?php echo e(asset('js/odonto.js')); ?>"></script>
        <script src="<?php echo e(asset('js/intlTelInput.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/floating-wpp.min.js')); ?>"></script>
    
        <script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/vue/vue.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('resourcesApp/plugins/vue/axios.js')); ?>"></script>
        <script type="text/javascript">
            const APP_URL = "<?php echo e(url('/')); ?>";
        </script>
        <script type="text/javascript" src="<?php echo e(asset('js/app2.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('js/contact.js')); ?>"></script>
        
        <?php echo $__env->yieldPushContent('js'); ?>

        <script>
           /* $(function () {
// 'use strict';

// init the validator
// validator files are included in the download package
// otherwise download from http://1000hz.github.io/bootstrap-validator

// $('#contact-form').validator();


// when the form is submitted
$('#contact-form').on('submit', function (e) {

    $('#btn-enviar').attr('disabled', 'disabled');
        // if the validator does not prevent form submit
        if (!e.isDefaultPrevented()) {
            var url = "contact.php";

        // POST values in the background the the script URL
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            success: function (data)
            {
        // data = JSON object that contact.php returns

        // we recieve the type of the message: success x danger and apply it to the
        // console.log(data);

        var messageAlert = 'alert-' + data.type;
        var messageText = data.message;


        // let's compose Bootstrap alert box HTML
        var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';

        // If we have messageAlert and messageText
        if (messageAlert && messageText) {
        // inject the alert to .messages div in our form
        $('#messagesFormAlert').html(alertBox);
        // empty the form
        if(data.type == 'success'){
            $('#contact-form')[0].reset();
        }

        }

        $('#btn-enviar').removeAttr('disabled');

        },
        error: function(error, data){
            console.log(error);
            console.log(data);
            $('#btn-enviar').removeAttr('disabled');
        }
        });
        return false;
        }
        });
        });
*/
</script>

</body>

</html>
<?php /**PATH /opt/lampp/htdocs/paginasOdontologas/AppGestorContenido/resources/views/layouts/website/main.blade.php ENDPATH**/ ?>