<?php $__env->startSection('title'); ?>Servicios | <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div id="componetService">
    <header style="background-image: url(<?php echo e($infoPage->getUrlImage()); ?>);" id="header-servicios">
    </header>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading"><?php echo e($infoPage->title); ?></h2>
                    <p class="text-muted"><?php echo e($infoPage->short_description); ?></p>
                </div>
                <div class="ftco-intro">
                    <div class="container">
                        <div class="row no-gutters" >

                            <?php
                                $color = 1;    
                            ?> 

                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($service->is_principal): ?>
                                    <div class="col-md-3 p-4 color-<?php echo e($color); ?>">
                                        <div class=" d-flex align-self-stretch ftco-animate">
                                            <div class="media block-6 services d-block text-center">
                                                <div class="icon d-flex justify-content-center align-items-center">
                                                    <img src="<?php echo e($service->getUrlImage()); ?>">
                                                </div>
                                                <div class="media-body p-2 mt-3">
                                                    <h3 class="heading"><?php echo e($service->name); ?></h3>
                                                </div>
                                            </div>      
                                        </div>
                                    </div>
                                    <?php 
                                        $color++;
                                        if($color == 5){$color = 1;}
                                    ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php $i = 1; $bg = 1; $row = 1; ?>
    <?php for($sections = 0; $sections < count($simplesPerRow); $sections++): ?>
        <?php if($i == 1 || ($i % 6) == 0): ?>
            <section class="s1" <?php if($bg % 2): ?> style="background-image: url(<?php echo e(asset('images/bggrey.png')); ?>);" <?php endif; ?> >
                <div class="container">
        <?php endif; ?>
                    <?php if(isset($simplesPerRow[$row])): ?>
                        <?php
                            $j = 1
                        ?>
                        <?php $__currentLoopData = $simplesPerRow[$row]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($j == 1): ?>
                                <div class="row">
                            <?php endif; ?>                      
                                
                                    <div class="col-md-4">
                                        <img src="<?php echo e($s->getUrlImage()); ?>">
                                        <h4><?php echo e($s->name); ?></h4>
                                    </div>
                            <?php if($j == 3): ?>
                                </div>
                                <?php $j = 1; continue; ?>
                            <?php endif; ?>                           
                            <?php $j++ ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $row++ ?>
                    <?php endif; ?>
                    

        <?php if($i == 1 || ($i % 6) == 0): ?>
                </div>
            </section>
            <?php $i = 1; $bg++; continue; ?>
        <?php endif; ?>
        <?php
            $i++;
        ?>
    <?php endfor; ?>

    <section style="background-image: url(<?php echo e(asset('images/bgservicios.png')); ?>);" id="s4">
        <div class="container">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Adicionalmente Desarrolla Programas de:</h2>
            </div>
            <div class="row">
                <?php $__currentLoopData = $aditionals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6">
                        <img src="<?php echo e($service->getUrlImage()); ?>">
                        <h4><?php echo e($service->name); ?></h4>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/th3khan/Disco de respaldo/Anthony/trabajos/proyectos laravel/GestorContenido/resources/views/website/servicios.blade.php ENDPATH**/ ?>