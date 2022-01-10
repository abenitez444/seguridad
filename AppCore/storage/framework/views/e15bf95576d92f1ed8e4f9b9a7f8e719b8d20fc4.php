<footer id="footer" class="ftco-footer ftco-bg-dark ftco-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="ftco-footer-widget mb-4">
                    <?php if($company['info']->logoFooter != ''): ?>
                        <img src="<?php echo e($company['info']->logoFooter()->getUrlImage()); ?>" />
                    <?php endif; ?>
                    <p><?php echo e($company['info']->description); ?>  </p>
                    <form id="form-new-subscriber" v-on:submit="newSubcriber()" onsubmit="return false;">
                        <div class="form-group">
                            <input type="email" class="form-control" id="suscribe" placeholder="Escriba aquí su Email" v-model="email" name="email">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4 pr-md-4">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Páginas de la empresa</h2>
                        <ul>
                            <li><a href="<?php echo e(route('website.index')); ?>">Inicio</a></li>
                            <li><a href="<?php echo e(route('website.nosotros')); ?>">Quienes Somos</a></li>
                            <li><a href="<?php echo e(route('website.servicios')); ?>">Servicios y Especialidades</a></li>
                            <li><a href="<?php echo e(route('website.contratacion')); ?>">Contratación</a></li>
                            <li><a href="<?php echo e(route('website.contacto')); ?>">Contactenos</a></li>
                        </ul>
                        <div class="center-block">
                            <?php $__currentLoopData = $company['socialsNetworks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e($social->url); ?>" target="<?php echo e($social->new_windows == 1 ? '_blank' : ''); ?>">
                                    <i id="social-fb" class="fa-2x social <?php echo e($social->ico); ?>"></i>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">DATOS DE CONTACTO</h2>
                    <div class="block-23 mb-3">
                        <ul>
                            <li><span class="icon icon-map-marker"></span><span class="text"> <?php echo e($company['info']->address); ?></span></li>
                            <li><span class="icon icon-phone"></span><span class="text"> <?php echo e($company['info']->phone); ?></span></li>
                            <li><span class="icon icon-envelope"></span><span class="text"> <?php echo e($company['info']->email); ?></span></li>
                            <li>
                            <span class=" icon icon-calendar"></span><span class="text"> Lun - Sáb <?php echo e($company['info']->working_hours); ?> <br> Dom - Cerrado</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <p>Soporte, Terminos y condiciones, Copyright &copy; 2019 / <a href="https://2web.us" target="_blank">2web</a>
                </p>
            </div>
        </div>
    </div>
</footer><?php /**PATH /opt/lampp/htdocs/paginasOdontologas/blog/AppGestorContenido/resources/views/layouts/website/footer.blade.php ENDPATH**/ ?>