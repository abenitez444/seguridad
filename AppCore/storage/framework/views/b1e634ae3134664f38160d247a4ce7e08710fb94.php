<!DOCTYPE html>
<html lang="en">

<head>
    <title>EZmarket</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/plugins/bootstrap/dist/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/css/invoice-style.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('AppResources/css/AdminLTE.min.css')); ?>">
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="<?php echo e(asset('/images/logo.png')); ?>"/>
        </div>
        <h1 style="background: url(<?php echo e(asset('AppResources/images/dimension.png')); ?>);">Factura Nº <?php echo e($invoice->code); ?></h1>
        <div class="row invoice-info">
            <div class="col-sm-4 col-md-4 col-lg-4 invoice-col">
                <div class="title">Datos del comprador:</div>
                <div><span>CLIENTE:</span> <?php echo e(Auth::user()->name); ?></div>            
                <div><span>EMAIL:</span> <a href="mailto:<?php echo e(Auth::user()->email); ?>"><?php echo e(Auth::user()->email); ?></a></div>
                <div><span>TELÉFONO:</span> <?php echo e(Auth::user()->phone); ?></div>
                <div><span>ESTADO:</span> <?php echo e(Auth::user()->state); ?></div>
                <div><span>DIRECCIÓN:</span> <?php echo e(Auth::user()->address); ?></div>
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 invoice-col">
                <div class="title">Datos ingresados para el envió:</div>
                <div><span>PAÍS:</span> <?php echo e($invoice->purchaseDetails->shippingCountry); ?></div>
                <div><span>ESTADO:</span> <?php echo e($invoice->purchaseDetails->shippingState); ?></div>
                <div><span>CÓDIGO POSTAL:</span> <?php echo e($invoice->purchaseDetails->shippingCodePostal); ?></div>
                <div><span>DIRECCIÓN:</span> <?php echo e($invoice->purchaseDetails->shippingAddress); ?></div> 
            </div>
            <div class="col-sm-4 col-md-4 col-lg-4 invoice-col">
                <div class="title">Datos del vendedor:</div>
                <div><span>EMPRESA:</span> EZmarket </div>
                <div><span>TELÉFONO:</span> (57) 316 4950396</div>
                <div><span>EMAIL:</span> <a href="mailto:soluciones@2web.us">soluciones@2web.us</a></div>
                <div><span>DIRECCIÓN:</span> Bogota,<br /> Colombia</div>                
            </div>
        </div>       
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="service">REFERENCIA</th>
                    <th class="desc">DESCRICCIÓN</th>
                    <th>PRECIO</th>
                    <th>CANTIDAD</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $invoice->articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="service"><?php echo e($article->reference); ?></td>
                    <td class="desc"><?php echo e($article->name); ?></td>
                    <td class="unit">
                        <?php echo e($currency->symbol); ?> <?php echo e(number_format($article->costs_price->general_price, $options['number_of_decimals'], $options['decimal_separator'], $options['thousand_separator'])); ?>

                    </td>
                    <td class="qty"><?php echo e($article->pivot->count); ?></td>
                    <td class="total">
                        <?php echo e($currency->symbol); ?> <?php echo e(number_format($article->subTotal, $options['number_of_decimals'], $options['decimal_separator'], $options['thousand_separator'])); ?>

                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td colspan="4">SUBTOTAL</td>
                    <td class="total"><?php echo e($currency->symbol); ?> <?php echo e(number_format($invoice->subtotal, $options['number_of_decimals'], $options['decimal_separator'], $options['thousand_separator'])); ?></td>
                </tr>
                <tr>
                    <td colspan="4">IVA</td>
                    <td class="total"><?php echo e($currency->symbol); ?> <?php echo e(number_format($invoice->tax, $options['number_of_decimals'], $options['decimal_separator'], $options['thousand_separator'])); ?></td>
                </tr>
                <tr>
                    <td colspan="4" class="grand total">TOTAL</td>
                    <td class="grand total"><?php echo e($currency->symbol); ?> <?php echo e(number_format($invoice->total, $options['number_of_decimals'], $options['decimal_separator'], $options['thousand_separator'])); ?></td>
                </tr>
            </tbody>
        </table>
        <div id="notices">
            <div class="notice">
                <p class="">Metodo de pago utilizado: <b style="font-weight: 700;"><?php echo e($invoice->payment->name); ?></b></p>
                <p class="">Fecha de facturación: <b style="font-weight: 700;"><?php echo e($invoice->created_at); ?></b></p>
            </div>
        </div>
    </main>
    <footer>

    </footer>
</body>

</html>
<?php /**PATH /opt/lampp/htdocs/ez/AppGestorContenido/resources/views/website/shop/pdf/invoice.blade.php ENDPATH**/ ?>