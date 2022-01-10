<html>
<head>
    <title>Reporte de Novedades</title>
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
            top: -155px;
            right: 0px;
            width: 100% !important;
            height: 100px;
            /*background: url("<?php echo e(asset('img/logo.jpg')); ?>") no-repeat top center 50%;
            background-size: cover;
            background-position: 50% 50% 50% 50%;
            background-attachment: fixed;*/
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
            float: center !important;
            width: 250px;
            margin: 0 auto !important;
            position: absolute;
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

        table {
          border-collapse: collapse;
        }
        th, td {
          border-bottom: 1px solid #ddd;
          padding: 5px;
        }
    </style>
</head>
<body>
    <header>
         <h3 class="title">
           <img src="<?php echo e(asset('img/logo.jpg')); ?>" width="150px">
        </h3>
        <!-- <h3 class="title">Reporte de <?php echo e($request->type); ?></h3> -->
        <h3 class="title">Reporte de Novedades</h3>
    </header>
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
       
       <div class="contenido">
           <table>
               <thead>
                    <?php if($request->type == 'Cambio de Turno'): ?>
                    <tr>
                        <th class="text-center">Vigilante</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Doblaje de turno</th>
                        <th class="text-center">Puesto & Turno de Origen</th>
                        <th class="text-center">Puesto & Turno a cubrir</th>
                    </tr>
                    <?php else: ?>
                    <tr>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Puesto</th>
                        <th class="text-center">Vigilante</th>
                        <th class="text-center">Desde</th>
                        <th class="text-center">Hasta</th>
                        <th class="text-center">Relevó</th>
                        <th class="text-center">Observaciones</th>
                    </tr>
                    <?php endif; ?>                   
               </thead>
               <tbody>
                    <?php if($request->type == 'Cambio de Turno'): ?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="border: 2px solid;">
                        <td><?php echo e($report->vigilant_principal->name); ?></td>
                        <td><?php echo e($report->date_ini); ?></td>
                        <td><?php echo e($report->shifts_double); ?></td>
                        <td>
                            <?php echo e($report->client->name); ?><br/>
                            <?php if($report->shifts_old == 'D'): ?><strong>Día</strong><?php endif; ?>
                            <?php if($report->shifts_old == 'N'): ?><strong>Noche</strong><?php endif; ?>
                            <?php if($report->shifts_old == 'X'): ?><strong>Descanso</strong><?php endif; ?>
                        </td>
                        <td>
                            <?php echo e($report->client_change->name); ?><br/>
                            <?php if($report->shifts_new == 'D'): ?><strong>Día</strong><?php endif; ?>
                            <?php if($report->shifts_new == 'N'): ?><strong>Noche</strong><?php endif; ?>
                            <?php if($report->shifts_new == 'X'): ?><strong>Descanso</strong><?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center">
                            <?php echo e($report->type); ?>

                        </td>
                        <td class="text-center">
                            <?php if($report->type != 'Desvinculación'): ?>
                                <?php echo e($report->client->name); ?><br/>
                                <label>Programación ID: <?php echo e($report->assignment->id); ?></label>
                            <?php else: ?>
                                <label>-----</label>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <strong>Nombre: </strong> <?php echo e($report->vigilant_principal->name); ?><br/>
                            <strong>Cédula: </strong> <?php echo e($report->vigilant_principal->dni); ?><br/>
                            <strong>Teléfono: </strong> <?php echo e($report->vigilant_principal->phone); ?>

                        </td>
                        <td class="text-center"><?php echo e($report->date_ini); ?></td>
                        <td class="text-center"><?php echo e($report->date_end); ?></td>
                        <td class="text-center">
                            <?php if($report->vigilant_change != null): ?>
                            <strong>Nombre: </strong> <?php echo e($report->vigilant_change->name); ?><br/>
                            <strong>Cédula: </strong> <?php echo e($report->vigilant_change->dni); ?><br/>
                            <strong>Teléfono: </strong> <?php echo e($report->vigilant_change->phone); ?>

                            <?php else: ?>
                                ---
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><?php echo e($report->details); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
               </tbody>
           </table>
       </div>
   </div>
</body>
</html><?php /**PATH /home/programacionlogr/public_html/AppCore/resources/views/admin/reportsNews-pdf.blade.php ENDPATH**/ ?>