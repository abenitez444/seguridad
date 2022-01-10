<?php $__env->startSection('content'); ?>


<!-- Masthead -->
<header class="masthead-contact">
    <div class="container h-100 text-center">
        <div class="row" style="max-width:480px;margin:0 auto;">
            <div class="col-sm">
                <hr>
                <h5 class="font-weight-bold text-white">
                    Establecimientos para Calle 15# 125-63
                </h5>
                <hr>
                <h5 class="font-weight-bold text-white">Cambiar dirección</h5>
            </div>
        </div>
    </div>
    <br><br>
    <div class="container buscador">
        <div class="row">
            <div class="col-lg-4">
                <button type="submit" class="btn boton-enviar font-weight-bold btn-lg btn-block">RESTAURANTE</button>
                <br>
            </div>
            <div class="col-lg-4">
                <button type="submit" class="btn boton-enviar font-weight-bold btn-lg btn-block">BEBIDAS</button>
            </div>
            <div class="col-lg-4">
                <form class="form-inline my-2 my-lg-0">
                    <button class="btn btn-outline-success lupa-buscador" type="submit">
                        <img width="20px" src="img/search.svg" alt="Buscador"> 
                    </button>
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">

                </form>
            </div>
        </div>
    </div>
</header>


<section class="establecimientos text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <button class="accordion btn boton-enviar text-center" style="padding:10px 0;">FILTROS</button>
                <div class="panel text-left">
                    <br>
                    <h5>
                        <ul>
                            <li>Bancos Pago Online</li>
                            <li>Cupón</li>
                            <li>Desayunos</li>
                            <li>Recomendados</li>
                            <li>Postobón</li>
                            <li>2 x 1</li>
                            <li>Tarjeta</li>
                        </ul>
                    </h5>
                </div>
                <br><br>
                <button class="accordion btn boton-enviar text-center" style="padding:10px 0;">CATEREGORÍAS</button>
                <div class="panel text-left">
                    Lorem
                </div>
                <br><br>
                <button class="accordion btn boton-enviar text-center" style="padding:10px 0;">MEDIOS DE PAGO</button>
                <div class="panel text-left">
                    Lorem
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg">
                        <img src="img/establecimientos/promo.png" class="card-img" alt="Promo 2x1">
                    </div>
                    <div class="col-lg">
                        <img src="img/establecimientos/promo.png" class="card-img" alt="Promo 2x1">
                    </div>
                </div>

                <br><br>

                <?php $__currentLoopData = $cooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cook): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-sm-2">
                                <img src="<?php echo e(asset('storage')); ?>/<?php echo e($cook->image); ?>" class="card-img" alt="Logo <?php echo e($cook->name); ?>">
                            </div>
                            <div class="col-sm-10">
                                <div class="card-body">
                                    <div class="row" style="width:100%;">
                                        <div class="col">
                                            <h5 class="card-title"><?php echo e($cook->name); ?> <?php echo e($cook->last_name); ?></h5>
                                        </div>
                                        <div class="col-lg">
                                            <h5>11 a.m - 10 p.m</h5>
                                        </div>
                                        <div class="col">
                                            <img class="starts" src="img/start-1.png" alt="Estrella">
                                            <img class="starts" src="img/start-1.png" alt="Estrella">
                                            <img class="starts" src="img/start-1.png" alt="Estrella">
                                            <img class="starts" src="img/start-2.png" alt="Estrella">
                                            <img class="starts" src="img/start-2.png" alt="Estrella">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <h5>45-50 min</h5>
                                            <p>Tiempo de entrega</p>
                                        </div>
                                        <div class="col">
                                            <h5>3 km</h5>
                                            <p>Distancia</p>
                                        </div>
                                        <div class="col-lg">
                                            <br>  
                                            <a href="<?php echo e(route('website.cooksProducts', $cook->id)); ?>"><button class="btn boton-enviar text-center">VER PRODUCTOS</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    </div>
</section>



<br><br><br><br>



<br><br><br>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Cabpserito/AppCore/resources/views/website/establecimientos.blade.php ENDPATH**/ ?>