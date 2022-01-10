<?php $__env->startSection('title'); ?>Contratación | <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<header style="background-image: url(<?php echo e($infoPage->getUrlImage()); ?>);" id="header-contratacion">
</header>


<section id="contratacion">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2 class="section-heading"><?php echo e($infoPage->title); ?></h2>
				<p class="text-muted"><?php echo e($infoPage->short_description); ?> </p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="marginc">
					<h3 class="text-muted"><i id="arrow" class="fas fa-caret-right"></i> Última actualización: 8 de mayo de 2019</h3>
					<?php $__currentLoopData = $hirings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hiring): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<h4><?php echo e($hiring->title); ?></h4>
						<p><?php echo e($hiring->description); ?></p>
						<a href="<?php echo e(route('website.showContratacion', $hiring->id)); ?>"><h4><i class="fa fa-info-circle"></i> Ver información</h4></a>
						<hr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>					
				</div>				
			</div>
			<div class="col-md-6">
				<div >
					<?php
				        $doc = new DOMDocument();
				        $doc->loadHTML('<?xml encoding="UTF-8">'.$infoPage->content );
				        $doc->encoding = 'UTF-8';
				        echo $doc->saveHTML();
				    ?>
				</div>
			</div>
		</div> 
	</div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/th3khan/Disco de respaldo/Anthony/trabajos/proyectos laravel/GestorContenido/resources/views/website/contratacion.blade.php ENDPATH**/ ?>