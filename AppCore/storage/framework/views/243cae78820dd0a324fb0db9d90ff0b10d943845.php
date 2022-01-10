<html>
<head>
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/plugins/bootstrap/dist/css/bootstrap.min.css')); ?>">
    <style>
        body{
            font-family: sans-serif;
        }
        @page  {
            margin: 160px 0px;
        }
        h1 {
            font-size: 20px;
        }

        h2 {
            font-size: 18px;
        }

        h3 {
            font-size: 16px;
        }

        h4 {
            font-size: 14px;
        }

        h5, h6 {
            font-size: 13px;
        }

        header { 
            position: fixed;
            left: 0px;
            top: -160px;
            right: 0px;
            width: 100% !important;
            height: 100px;
            background-size: cover;
            text-align: center;
        }
        header h1{
            margin: 10px 0;
        }
        header h2{
            margin: 0 0 10px 0;
        }
        footer {
            position: fixed;
            left: 0px;
            bottom: -50px;
            right: 0px;
            height: 40px;
            /* border-bottom: 2px solid #ddd;*/ 
        }

        footer {
            margin: 10px 50px; 
        }
        footer .page:after {
            /* content: counter(page); */
        }
        footer table {
            width: 100%;
        }
        footer p {
            text-align: right;
        }
        footer .izq {
            text-align: left;
            font-size: 12px;
            color: #95b3d7;
        }

        footer .center {
            text-align: center;
            font-size: 12px;
            color: #95b3d7;
        }

        footer a {
            color:#95b3d7;
        }

        .logo-sidg {
            float: left;
            width: 100px;
            margin-left: 50px;
        }

        #content {
            margin-left: 70px;
            margin-right: 50px;
        }

        h1.title{
            justify-content: center;
            text-align: center;
            text-transform: uppercase;
        }

        .contenido {
            font-size: 12px;
        }

        .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: #cae4e8;
        }

    </style>
</head>
<body>
    <header>
        <table class="table table-bordered">
            <tr>
                <th style="width: 30%; text-align: center;">
                    <img src="<?php echo e(asset('AppResources/login/img/icg-logo.png')); ?>" alt="Logo" style="width: 120px;" />
                </th>
                <th style="text-align: center; width: 40%;">
                    <h1>INGENIERÍA Y CONSULTORÍA GLOBAL LTDA</h1>
                    <p><?php echo e($title); ?> - <?php echo e($station->name); ?> <?php echo e($station->pollutant); ?></p>
                </th>
                <th style="width: 30%; text-align: center;">
                    <img src="<?php echo e(asset('AppResources/login/img/icg-logo.png')); ?>" alt="Logo" style="width: 120px;" />
                </th>
            </tr>
        </table>
    </header>
    <footer>
        <hr style="color: #95b3d7;" />
        <table>
            <tr>
                <td>
                    <p class="center">
                        INGENIERÍA Y CONSULTORÍA GLOBAL LTDA <br/>
                       Calle 150 No. 10-60 Tel: 7 52 76 81 – 702 76 93 <br/>
                        E-mail: <a href="mailto:gerencia@icgambiental.com">gerencia@icgambiental.com</a> <a href="mailto:administracion@icgambiental.com">administracion@icgambiental.com</a> <br/>
                        <a href=www.icgambiental.com>http://icgambiental.com</a>

                    </p>
                </td>
            </tr>
        </table>
    </footer>
    <div id="content">
       <h1 class="title"></h1>
       <div class="contenido">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <td>Número de Muestra</td>
                        <td>Números de Filtros</td>
                        <td>Fecha de Muestra</td>
                        <td>Concentración CSTD (mg/m3)</td>
                        <td>Temperatura ºC</td>
                        <td>Precipitació mm</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($d->sample_number); ?></td>
                            <td><?php echo e($d->filter_numbers); ?></td>
                            <td><?php echo e($d->sample_date); ?></td>
                            <td><?php echo e($d->concentrations); ?></td>
                            <td><?php echo e($d->temperatures); ?></td>
                            <td><?php echo e($d->rainfall); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
       </div>
   </div>
   <!-- jQuery 3 -->
<script src="<?php echo e(asset('AppResources/js/jquery.min.js')); ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo e(asset('AppResources/plugins/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
<!-- App -->
<script src="<?php echo e(asset('AppResources/js/bootstrap.bundle.min.js')); ?>"></script>
</body>
</html><?php /**PATH /opt/lampp/htdocs/icg/AppCore/resources/views/admin/reports/pdf/concentration.blade.php ENDPATH**/ ?>