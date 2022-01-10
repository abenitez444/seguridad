<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>WOMAN Colors</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('images/favicon.ico')); ?>">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    

    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
    <!-- Owl Carousel main css -->
    <link rel="stylesheet" href="<?php echo e(asset('css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/owl.theme.default.min.css')); ?>">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="<?php echo e(asset('css/core.css')); ?>">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="<?php echo e(asset('css/shortcode/shortcodes.css')); ?>">
    <!-- Theme main style -->
    <link rel="stylesheet" href="<?php echo e(asset('style.css')); ?>">
    <!-- Responsive css -->
    <link rel="stylesheet" href="<?php echo e(asset('css/responsive.css')); ?>">
    <!-- User style -->
    <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>">


    <!-- Modernizr JS -->
    <script src="<?php echo e(asset('js/vendor/modernizr-2.8.3.min.js')); ?>"></script>

   <style type="text/css">
       .table>tbody>tr>th, .table>tbody>tr>td {
            border-top: none !important;
       }
   </style>
    <!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="wrapper fixed__footer">

        <div id="invoice">
            <!-- cart-main-area start -->
            <div class="cart-main-area ptb--120 bg__white">
                <div class="container">
                    <div class="row">
                        <div class="container-fluid" >
                            <div class="content-wrapper">
                                <!-- Main content -->
                                <section class="invoice">
                                    <!-- title row -->
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h2 class="page-header">
                                                <a class="ml-5" href="<?php echo e(route('website.index')); ?>"><img src="<?php echo e(asset('images/logo/logo.png')); ?>" alt="logo" width="50"></a> Womans Colors.
                                            </h2>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- info row -->
                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">
                                            Datos del cliente
                                            <address>
                                                <strong><?php echo e(Auth::user()->name); ?>.</strong><br>
                                                Teléfono: <?php echo e(Auth::user()->phone); ?><br>
                                                Email: <?php echo e(Auth::user()->email); ?>

                                                <?php echo e(Auth::user()->address); ?><br>
                                                <?php echo e(Auth::user()->state); ?><br>                           
                                            </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col">
                                            Datos ingresados para el envió
                                            <address>
                                                <b>País:</b> <?php echo e($invoice->purchaseDetails->shippingCountry); ?><br>
                                                <b>Estado:</b> <?php echo e($invoice->purchaseDetails->shippingState); ?><br>
                                                <b>Código postal:</b> <?php echo e($invoice->purchaseDetails->shippingCodePostal); ?><br>
                                                <b>Dirección:</b> <?php echo e($invoice->purchaseDetails->shippingAddress); ?><br>
                                            </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col">
                                            <b>Invoice <?php echo e($invoice->code); ?></b><br>
                                            <b>Fecha:</b> <?php echo e($invoice->created_at); ?><br>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <!-- Table row -->
                                    <div class="row">
                                        <div class="col-xs-12 table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Cant.</th>
                                                        <th>Producto</th>
                                                        <th>Ref.</th>
                                                        <th>Precio U.</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $invoice->articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($article->pivot->count); ?></td>
                                                            <td><?php echo e($article->name); ?></td>
                                                            <td><?php echo e($article->reference); ?></td>
                                                            <td>
                                                                <?php echo e($currency->symbol); ?> <?php echo e(number_format($article->costs_price->general_price, $options['number_of_decimals'], $options['decimal_separator'], $options['thousand_separator'])); ?>

                                                            </td>
                                                            <td>
                                                                <?php echo e($currency->symbol); ?> <?php echo e(number_format($article->subTotal, $options['number_of_decimals'], $options['decimal_separator'], $options['thousand_separator'])); ?>

                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <div class="row">
                                        <!-- accepted payments column -->
                                        <div class="col-md-12">
                                            <p class="lead">Metodo de pago utilizado: <b style="font-weight: 700;"><?php echo e($invoice->payment->name); ?></b></p>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-6" style="width: 50%; float: left;"></div>
                                        <div class="col-md-6" style="width: 50%; float: right;">
                                            <div class="table table-responsive">
                                                <table class="table" style="float: right;">
                                                    <tr>
                                                        <th>Subtotal:</th>
                                                        <td><?php echo e($currency->symbol); ?> <?php echo e(number_format($invoice->subtotal, $options['number_of_decimals'], $options['decimal_separator'], $options['thousand_separator'])); ?>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>IVA</th>
                                                        <td>
                                                            <?php echo e($currency->symbol); ?> <?php echo e(number_format($invoice->tax, $options['number_of_decimals'], $options['decimal_separator'], $options['thousand_separator'])); ?>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total:</th>
                                                        <td>
                                                            <?php echo e($currency->symbol); ?> <?php echo e(number_format($invoice->total, $options['number_of_decimals'], $options['decimal_separator'], $options['thousand_separator'])); ?>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <!-- this row will not appear when printing -->
                                    
                                </section>
                                <!-- /.content -->
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- cart-main-area end -->

        </div>

    </div>

</body>

</html>
<?php /**PATH /opt/lampp/htdocs/woman/AppGestorContenido/resources/views/website/shop/pdf/invoice.blade.php ENDPATH**/ ?>