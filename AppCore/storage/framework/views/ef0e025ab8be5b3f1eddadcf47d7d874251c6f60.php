<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <div class="row">
            <div class="col-xs-3 col-xs-offset-9">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3">
                <div class="imgico">
                    <img src="<?php echo e(asset('images/cruz.png')); ?>">
                </div>
                <div class="center-block">
                    <?php $__currentLoopData = $company['socialsNetworks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($social->url); ?>" target="<?php echo e($social->new_windows == 1 ? '_blank' : ''); ?>">
                            <i id="social-fb" class="fa-2x social <?php echo e($social->ico); ?>"></i>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(route('website.index')); ?>">
            <?php if($company['info']->logoHeader != ''): ?>
                <img class="logohead" src="<?php echo e($company['info']->logoHeader()->getUrlImage()); ?>">
            <?php endif; ?>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php echo e(request()->routeIs('website.index') ? 'active' : ''); ?>"><a href="<?php echo e(route('website.index')); ?>" class="nav-link">Inicio</a></li>
                <li class="nav-item <?php echo e(request()->routeIs('website.nosotros') ? 'active' : ''); ?> "><a href="<?php echo e(route('website.nosotros')); ?>" class="nav-link">Quienes Somos</a></li>
                <li class="nav-item <?php echo e(request()->routeIs('website.servicios') ? 'active' : ''); ?> "><a href="<?php echo e(route('website.servicios')); ?>" class="nav-link">Servicios y Especialidades</a></li>
                <li class="nav-item <?php echo e(request()->routeIs('website.contratacion') ||  request()->routeIs('website.showContratacion') ? 'active' : ''); ?>"><a href="<?php echo e(route('website.contratacion')); ?>" class="nav-link">Contratación</a></li>
                <li class="nav-item <?php echo e(request()->routeIs('website.contacto') ? 'active' : ''); ?>"><a href="<?php echo e(route('website.contacto')); ?>" class="nav-link">Contactenos</a></li>
            </ul>
        </div>
    </div>
</nav><?php /**PATH /opt/lampp/htdocs/paginasOdontologas/blog/AppGestorContenido/resources/views/layouts/website/nav.blade.php ENDPATH**/ ?>