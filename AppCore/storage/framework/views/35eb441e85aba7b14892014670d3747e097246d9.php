<?php $__env->startSection('content'); ?>

<div id="main-app">

    <!-- Masthead -->
    <header class="masthead-contact">
        <br><br>
        <div class="container productor-empresa text-white text-center">
            <div class="row">
                <div class="col-sm-2">
                    <img src="<?php echo e(asset('storage')); ?>/<?php echo e($cook->image); ?>" class="card-img" alt="Logo <?php echo e($cook->name); ?> <?php echo e($cook->last_name); ?>">
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
                                <img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="Estrella">
                                <img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="Estrella">
                                <img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="Estrella">
                                <img class="starts" src="<?php echo e(asset('img/start-2.png')); ?>" alt="Estrella">
                                <img class="starts" src="<?php echo e(asset('img/start-2.png')); ?>" alt="Estrella">
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
                                <div class="dropdown">
                                    <button class="btn boton-enviar text-center dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        MEDIOS DE PAGO
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Cash</a>
                                        <a class="dropdown-item" href="#">Paypal</a>
                                        <a class="dropdown-item" href="#">Credi card</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <br><br><br><br>

    <section class="establecimientos">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <h2 class="text-naranja">Menú</h2>
                    <div class="productos-menu">
                        <?php $__currentLoopData = $cook->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($service->type == 'services'): ?>
                            <div class="card mb-3">
                                <div class="row no-gutters">
                                    <div class="col-sm-2 text-center">
                                        <img src="<?php echo e(asset('storage')); ?>/<?php echo e($service->image); ?>" class="card-img" alt="<?php echo e($service->name); ?>">
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="card-body">
                                            <div class="row" style="width:100%;">
                                                <div class="col">
                                                    <h5 class="card-title"><?php echo e($service->name); ?></h5>
                                                    <p>
                                                        <?php echo e($service->description); ?>

                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <h5>
                                                        $ <?php echo e($service->price_total); ?>

                                                        <a href="#" data-toggle="modal" data-target="#modal-producto" v-on:click.prevent="viewservice('<?php echo e($service->id); ?>')"><img src="<?php echo e(asset('/img/icons-plus.svg')); ?>" alt="Agregar" width="35px"></a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <br>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <br/><br/><br/>
                    <h2 class="text-naranja">Adicionales</h2>
                    <div class="productos-menu">
                        <?php $__currentLoopData = $cook->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($additional->type == 'additional'): ?>
                            <div class="card mb-3">
                                <div class="row no-gutters">
                                    <div class="col-sm-2 text-center">
                                        <img src="<?php echo e(asset('storage')); ?>/<?php echo e($additional->image); ?>" class="card-img" alt="<?php echo e($additional->name); ?>">
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="card-body">
                                            <div class="row" style="width:100%;">
                                                <div class="col">
                                                    <h5 class="card-title"><?php echo e($additional->name); ?></h5>
                                                    <p>
                                                        <?php echo e($additional->description); ?>

                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <h5>
                                                        $ <?php echo e($additional->price_total); ?>

                                                        <a href="#" data-toggle="modal" data-target="#modal-producto" v-on:click.prevent="viewservice('<?php echo e($additional->id); ?>')"><img src="<?php echo e(asset('/img/icons-plus.svg')); ?>" alt="Agregar" width="35px"></a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <br>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="col-lg-3 text-gray text-center">
                    <!-- <img width="80px" src="img/productos/caja.png" alt="Pedido">
                    <h3>¿Con Hambre?</h3>
                    <h4>Tu pedido esta vacio</h4>
                    <br>
                    <a href="finalizar-pedido.html"><button class="btn boton-enviar">PROGRAMAR PEDIDO</button></a>
                    <br><br> -->
                    <h4 class="text-naranja text-left">Opiniones</h4>
                    <br><br><br><br>
                    <div class="productos-testimonios">
                        <div class="card">
                            <img class="people" src="<?php echo e(asset('img/robert-smith.png')); ?>" alt="Robert Smith">
                            <img class="division" src="<?php echo e(asset('img/division.png')); ?>" alt="División">
                            <div class="card-body">
                                <img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="starts">
                                <img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="starts">
                                <img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="starts">
                                <img class="starts" src="<?php echo e(asset('img/start-2.png')); ?>" alt="starts">
                                <img class="starts" src="<?php echo e(asset('img/start-2.png')); ?>" alt="starts">
                                <br>
                                <p class="card-text text-white">"Fue amigable y todo lo que probaos fue delicioso, especualmente el sous vide bistek y los huevos con arroz de coliflor al ajo."</p>
                            </div>
                        </div>

                        <br><br><br><br>

                        <div class="card">
                            <img class="people" src="<?php echo e(asset('img/regina-ontario.png')); ?>" alt="Regina Ontario">
                            <img class="division" src="<?php echo e(asset('img/division.png')); ?>" alt="División">
                            <div class="card-body">
                                <img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="starts">
                                <img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="starts">
                                <img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="starts">
                                <img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="starts">
                                <img class="starts" src="<?php echo e(asset('img/start-2.png')); ?>" alt="starts">
                                <br>
                                <p class="card-text text-white">"Excelente comida, gran servicio comida auténtica. Definitivamente son confiables"</p>
                            </div>
                        </div>

                        <br><br><br><br>


                        <div class="card">
                            <img class="people" src="<?php echo e(asset('img/jerry-tucson.png')); ?>" alt="Jerry Tucson">
                            <img class="division" src="<?php echo e(asset('img/division.png')); ?>" alt="División">
                            <div class="card-body">
                                <img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="starts">
                                <img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="starts">
                                <img class="starts" src="<?php echo e(asset('img/start-1.png')); ?>" alt="starts">
                                <img class="starts" src="<?php echo e(asset('img/start-2.png')); ?>" alt="starts">
                                <img class="starts" src="<?php echo e(asset('img/start-2.png')); ?>" alt="starts">
                                <br>
                                <p class="card-text text-white">"Los platos son reamente buenos, A veces los nombres no son siempre obvios, así que es bueno buscar cosas de antemano."</p>
                            </div>
                        </div>

                        <br><br>


                        <div class="card card-pedidos" v-if="cart.services.length > 0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-10 text-left">
                                        Mi pedido
                                    </div>
                                    <div class="col-2 text-right">
                                        <button class="btn boton-eliminar" v-on:click="deleteCart()"><img width="25px" src="<?php echo e(asset('img/delete.svg')); ?>" alt="Eliminar"></button>
                                    </div>
                                    <br>
                                    <div class="col-sm-12 text-center">
                                        <p>
                                            Envío para la calle 15 # 125 - 63
                                        </p>
                                    </div>
                                </div>
                                <div class="row" v-for="serv in cart.services">
                                    <div class="col-sm-2">
                                        <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" style="width:55px;" v-model="serv.pivot.count" v-on:change="updatedCart(serv)">
                                            <?php
                                                for ($i=0; $i < 101; $i++) { 
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-10 text-right">
                                        <h5 class="text-naranja">{{ serv.name }}</h5>
                                        <h6>$ {{ serv.price_total }}</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-left">
                                        <h6>Envío</h6>
                                    </div>
                                    <div class="col text-right">
                                        <h6>$ {{ cart.shippingCost }}</h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-left">
                                        <h6>Subtotal</h6>
                                    </div>
                                    <div class="col text-right">
                                        <h6>$ {{ cart.subTotal }}</h6>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col text-left">
                                        <h5>Total</h5>
                                    </div>
                                    <div class="col text-right">
                                        <h5>$ {{ cart.total }}</h5>
                                    </div>
                                </div>
                                <br>
                                <a href="javascript:void(0)" v-on:click="checking()"><button class="btn boton-enviar">PROGRAMAR PEDIDO</button></a>
                            </div>
                        </div>

                        <br><br>

                    </div>

                </div>


            </div>
        </div>
    </section>


    <br/><br/><br/>

    <div class="producto-promociones container">
        <div class="row">
            <div class="col-sm-9">
                <h2>Promociones del mes</h2>
                <hr>
                <div class="row">
                    <?php $__currentLoopData = $cook->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($service->type == 'services' && $service->is_promotion): ?>
                            <div class="col-lg-6">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-sm-7">
                                            <div class="card-body">
                                                <div class="row" style="width:100%;">
                                                    <div class="col">
                                                        <h5 class="card-title"><?php echo e($service->name); ?></h5>
                                                        <p>
                                                            <?php echo e($service->description); ?>

                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h5>
                                                            $<?php echo e($service->price_total); ?>

                                                            <a href="#" data-toggle="modal" data-target="#modal-producto" v-on:click.prevent="viewservice('<?php echo e($service->id); ?>')"><img src="<?php echo e(asset('img/icons-plus.svg')); ?>" alt="Agregar" width="35px"></a>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 text-center">
                                            <img src="<?php echo e(asset('/storage')); ?>/<?php echo e($service->image); ?>" class="card-img" alt="Logo Restaurante">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <hr>
                <br><br>
                <h2>Principales</h2>
                <hr>
                <div class="row">
                    <?php $__currentLoopData = $cook->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($service->type == 'services' && $service->is_principal): ?>
                            <div class="col-lg-6">
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-sm-7">
                                            <div class="card-body">
                                                <div class="row" style="width:100%;">
                                                    <div class="col">
                                                        <h5 class="card-title"><?php echo e($service->name); ?></h5>
                                                        <p>
                                                            <?php echo e($service->description); ?>

                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <h5>
                                                            $<?php echo e($service->price_total); ?>

                                                            <a href="#" data-toggle="modal" data-target="#modal-producto" v-on:click.prevent="viewservice('<?php echo e($service->id); ?>')"><img src="<?php echo e(asset('img/icons-plus.svg')); ?>" alt="Agregar" width="35px"></a>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 text-center">
                                            <img src="<?php echo e(asset('/storage')); ?>/<?php echo e($service->image); ?>" class="card-img" alt="Logo Restaurante">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <hr>
            </div>
        </div>
    </div>

    <!-- Modal Producto-->
    <div class="modal fade" id="modal-producto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm">
                            <h5 class="modal-title" id="exampleModalLabel">{{ service.name }}</h5>
                            <p>
                                {{ service.description }}
                            </p>
                            <h2 class="text-gray">$ {{ service.price_total }}</h2>
                        </div>
                        <div class="col-sm">
                            <img v-if="service.image != null" :src="'<?php echo e(asset('storage/')); ?>/' + service.image" class="card-img-top" :alt="service.name">
                        </div>
                    </div>
                </div>
                <form>
                    <div class="form-group container">
                        <input type="text" class="form-control" id="aclaraciones" placeholder="Añadir aclaraciones" v-model="aclaraciones">
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            Cantidad
                            <select class="custom-select my-1 mr-sm-2" v-model="count" style="width:55px;">
                                <option selected value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <div class="col-sm">
                            <button type="button" :disabled="sending" class="btn boton-enviar" v-on:click="addCart()">
                                <template v-if="!sending">
                                    Agregar a mi pedido
                                </template>
                                <template v-else>
                                    <i class="fa fa-spinner fa-spin"></i>
                                </template>
                            </button>
                        </div>
                    </div>
                </form>
                <br>
            </div>
        </div>
    </div>
</div>

<br><br><br>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript">
    const ID_COOK = '<?php echo e($cook->id); ?>';
</script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/website/cookProducts.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Cabpserito/AppCore/resources/views/website/cooksProducts.blade.php ENDPATH**/ ?>