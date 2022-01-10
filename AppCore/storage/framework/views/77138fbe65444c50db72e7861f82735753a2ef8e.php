<?php $__env->startSection('title'); ?> Nosotros | <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<header style="background-image: url(<?php echo e($infoPage->getUrlImage()); ?>);" id="header-quienessomos">
</header>

<section id="quienessomos">
	<div class="container">
		<div class="col-md-12">
			<div class="ftco-animate text-center">
				<h2 class="mb-3"><?php echo e($infoPage->title); ?></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 center-sidenav">
				<div id="admin-sidebar">
					<?php if(count($elements) > 0): ?>
						<ul class="sidenav admin-sidenav list-unstyled tabs nav">
							<?php $i = 1; ?>
							<?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li><a class="<?php echo e($i==1 ? 'active' : ''); ?>" href="#tab<?php echo e($i); ?>" data-toggle="tab"><?php echo e($element->title); ?></a></li>
								<?php
									$i++
								?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	  					</ul>
					<?php endif; ?>					
				</div> 
			</div>
		<div class="col-md-8">
			<?php if(count($elements) > 0): ?>
				<div id="tabcircule" class="tab-content">
					<?php $i = 1; ?>
						<?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="tab-pane <?php echo e($i==1 ? 'active' : ''); ?> text-style animated <?php echo e($animated[random_int(0, count($animated) -1)]); ?>" id="tab<?php echo e($i); ?>">
								<h2 id="qh2" class="mb-3"><?php echo e($element->title); ?></h2>
								<img src="<?php echo e($element->getUrlImage()); ?>">
								<?php
								    $doc = new DOMDocument();
								    $doc->loadHTML('<?xml encoding="UTF-8">'.$element->content );
								    $doc->encoding = 'UTF-8';
								    echo $doc->saveHTML();
								?>									
							</div>
							<?php $i++ ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/th3khan/Disco de respaldo/Anthony/trabajos/proyectos laravel/GestorContenido/resources/views/website/nosotros.blade.php ENDPATH**/ ?>