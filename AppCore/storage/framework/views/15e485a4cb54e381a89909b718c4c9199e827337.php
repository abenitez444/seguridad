<div class="container-fluid bg-index" id="componentFooter">
    <div class="row">
        <div class="col-md-3 text-center">
            <a href="<?php echo e(route('website.index')); ?>"><img src="<?php echo e(asset('img/logo-footer.png')); ?>" alt="" class="mt-5 mb-5 mmb-5"></a>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-4 centrar-mobile">
                    <h4 class="tc-blanco mt-5 centrar-mobile"><span class="bg-rosado">PRODUCTOS</span></h4>
                    <hr class="linea2 centrar-mobile">
                    <a href="<?php echo e(route('website.index')); ?>"><h6 class="tc-blanco">Inicio</h6></a>
                    <a v-for="category in categories" :href="'<?php echo e(url('shop/category/')); ?>/' + category.slug"><h6 class="tc-blanco">{{ category.name }}</h6></a>
                </div>
                <div class="col-md-4 centrar-mobile">
                    <h4 class="tc-blanco mt-5 centrar-mobile"><span class="bg-rosado">CONTACTO</span></h4>
                    <hr class="linea2 centrar-mobile">
                    <h6 class="tc-blanco"><span class="fas fa-map-marker-alt mr-2"></span>CR 19 NO. 12 72 B I P 1 AP LC 54</h6>
                    <h6 class="tc-blanco mb-3"><span class="fas fa-envelope-open mr-2"></span>asesorcomercial@keywood.co</h6>
                    <button class="btn tc-blanco bg-trans boton-footer mb-2">LLAMANOS</button>
                    <p class="size-9 mt-1 mb-5">
                    <img src="<?php echo e(asset('img/facebook.png')); ?>" alt=""> 
                    <img src="<?php echo e(asset('img/instagram.png')); ?>" alt="">
                    <img src="<?php echo e(asset('img/twitter.png')); ?>" alt="">
                    </p>
                </div>
                <div class="col-md-4 centrar-mobile">
                    <h4 class="tc-blanco mt-5 centrar-mobile"><span class="bg-rosado">BOLETIN</span></h4>
                    <hr class="linea2 centrar-mobile">
                    <h6 class="tc-blanco size-9">Suscríbete a nuestro boletín para recibir lo mejor y lo actual del marketing digital.</h6>
                    <h4 class="tc-blanco">Correo electrónico</h4>
                    <span class="fas fa-envelope-open tc-blanco"></span>
                    <hr class="tc-blanco bg-blanco">
                </div>
            </div>
        </div>
    </div>
    
</div>

<div class="container-fluid bg-blanco">
    <div class="row">
        <div class="col-md-12 text-center mt-4 mb-4">
            <h6><span class="bg-rosado">2018 © www.KeyWood.co Todos los derechos reservados.</span></h6>
        </div>
    </div>
</div>
<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/footer.js')); ?>"></script>
<?php $__env->stopPush(); ?><?php /**PATH /opt/lampp/htdocs/keywood/AppGestorContenido/resources/views/layouts/website/footer.blade.php ENDPATH**/ ?>