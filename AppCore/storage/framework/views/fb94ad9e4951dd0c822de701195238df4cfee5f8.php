<html>
<head>
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
            /*background: url("<?php echo e(asset('AppResources/login/img/bg-login.png')); ?>") no-repeat top center;*/
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

        .logo-sidg {
            float: left;
            width: 100px;
            margin-left: 50px;
        }

        #content {
            margin-left: 70px;
            margin-right: 50px;
        }

        .title{
            justify-content: center;
            text-align: center;
            text-transform: uppercase;
        }

        .contenido {
            font-size: 12px;
        }

    </style>
    <link rel="stylesheet" href="<?php echo e(asset('AppResources/template_html/dist/css/adminlte.min.css')); ?>">
</head>
<body>
    <!--<header>
         <img class="logo-sidg" src="<?php echo e(asset('AppResources/login/img/logo-sidg.png')); ?>"> 
    </header>-->
    <footer>
        <!-- <table>
            <tr>
                <td>
                    <p class="izq">
                        Carrera 108 # 71 a 33 Bogotá - Colombia <br/>
                        (571) 828 5530 / (57) 311 880 9558 <br/>
                        directoragestion@sistemasintegradosdegestion.co / www.sistemasintegradosdegestion.co <br/>
                    </p>
                </td>
                <td>
                    <p class="page">

                    </p>
                </td>
            </tr>
        </table> -->
    </footer>
    <div id="content">
       <h3 class="title">Reporte de <?php echo e($request->type); ?></h3>
       <div class="contenido">
           <table class="table table-hover table-hover-animation mb-0">
               <thead>
                    <tr>
                        <th class="text-center">Vigilante</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Relevó</th>
                        <th class="text-center">Observaciones</th>
                    </tr>                   
               </thead>
               <tbody>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center">
                            <strong>Nombre: </strong><?php echo e($report->vigilant_principal->name); ?><br/>
                            <strong>Cédula: </strong><?php echo e($report->vigilant_principal->dni); ?><br/>
                            <strong>Teléfono</strong><?php echo e($report->vigilant_principal->phone); ?>

                        </td>
                        <td class="text-center"><?php echo e($report->date); ?></td>
                        <td class="text-center">
                            <?php if($report->vigilant_change != null): ?>
                            <strong>Nombre: </strong><?php echo e($report->vigilant_change->name); ?><br/>
                            <strong>Cédula: </strong><?php echo e($report->vigilant_change->dni); ?><br/>
                            <strong>Teléfono</strong><?php echo e($report->vigilant_change->phone); ?>

                            <?php else: ?>
                                --- 
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><?php echo e($report->details); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </tbody>
           </table>
       </div>
   </div>
</body>
</html><?php /**PATH /home/programacionlogr/public_html/AppCore/resources/views/admin/reportsResignations-pdf.blade.php ENDPATH**/ ?>