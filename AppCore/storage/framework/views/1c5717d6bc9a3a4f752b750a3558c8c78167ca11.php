<?php $__env->startSection('title'); ?> Inicio <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="home-slider owl-carousel">
	<?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if($element->type == 'slider'): ?> 
			<div class="slider-item" style="background-image: url(<?php echo e($element->getUrlImage()); ?>)">
				<div class="overlay"></div>
				<div class="container">
					<div class="row slider-text align-items-center" data-scrollax-parent="true">
						<div class="col-md-6 col-sm-12 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
							<h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><?php echo e($element->title); ?></h1>
							<p class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
								<?php
							        $doc = new DOMDocument();
							        $doc->loadHTML('<?xml encoding="UTF-8">'.$element->content );
							        $doc->encoding = 'UTF-8';
							        echo $doc->saveHTML();
						    	?>						    	
						    </p>
							<p data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
</div>

<section id="ftco" class="ftco-intro">
	<div class="container">
		<div class="row no-gutters">
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
</section>

<section id="servicios" style="background-image: url(<?php echo e(asset('images/bgone.png')); ?>);" class="ftco-section ftco-services">
	<div class="container">
		<div class="row justify-content-center mb-5 pb-5">
			<div class="col-md-7 text-center heading-section ftco-animate">
				<h2 class="mb-2">Servicios Destacados</h2>
				<p>Cubrimos una gran variedad de servicios médicos.</p>
			</div>
		</div>
		<div class="row">
			<?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($service->is_great): ?>
					<div class="col-md-3 d-flex align-self-stretch ftco-animate">
						<div class="media block-6 services d-block text-center">
							<div class="atencion">
								<img src="<?php echo e($service->getUrlImage()); ?>" alt="Atención al parto" style="width:100%;">
								<div class="content">
									<p><?php echo e($service->name); ?><br></p>
								</div>
							</div>
						</div>      
					</div>
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<div class="col-md-3 d-flex align-self-stretch ftco-animate">
				<div class="media block-6 services d-block text-center">
					<div class="media-body p-2 mt-3">
						<p>La Empresa Social del Estado Hospital San Martín de Porres se encuentra habilitada  en el Registro Especial de Prestadores de Servicios de Salud, según la Resolución 2003 de 2014 </p>
					</div>
				</div>      
			</div>
		</div>
	</div>
</section>


<section id="plan" style="background-image: url(<?php echo e(asset('images/bgtwo.png')); ?>);" class="ftco-section martop">
	<div class="container">
		<div class="row justify-content-center mb-5 pb-5">
		</div>
		<div class="row">
			<div class="col-md-6"></div>
			<div class="col-md-6"> <h2 class="mb-3">Solicite su cita sin salir de casa</h2>
				<form id="form-cita" onsubmit="return false;" v-on:submit="send">
					<div class="form-group">
						<input type="text" class="form-control" id="nombre" name="name" v-model="name" aria-describedby="emailHelp" placeholder="Nombre">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="correo" name="email" v-model="email" placeholder="Correo">
						<input type="hidden" name="type" value="contacto" v-model="type">
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-check">
								
							</div>
						</div>
						<div class="col-md-6">
							<button type="submit" class="btn btnhospital" :disabled="sending == true">
								<template v-if="!sending">
									Enviar 
								</template>
								<template v-if="sending">
									<i class="fa fa-spinner fa-spin"></i>
								</template>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<section style="background-image: url(<?php echo e(asset('images/bggrey.png')); ?>);" class="ftco-section" id="section-counter">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-12 col-sm-12 col-12">
				<div class="ftco-animate">
					<h2 class="mb-3">Servicios Especializados</h2>
				</div>
			</div>
			<?php $coun = 1; $serviceRow = []; ?>
			<?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($service->is_special): ?>
					<?php array_push($serviceRow, $service) ?>
					<?php if(count($serviceRow) == 2): ?>
						<div class="col-md-12 col-12 col-sm-12 col-12">
							<div class="row mb-20">
								<div class="col-md-6">
									<img src="<?php echo e($serviceRow[0]->getUrlImage()); ?>" class="img-fluid">
									<h3 class="section-heading services-title"><?php echo e($serviceRow[0]->name); ?></h3>
								</div>
								<div class="col-md-6">
									<img src="<?php echo e($serviceRow[1]->getUrlImage()); ?>" class="img-fluid">
									<h3 class="section-heading services-title"><?php echo e($serviceRow[1]->name); ?></h3>
								</div>
							</div>
						</div>
						<?php $serviceRow = [] ?>
					<?php endif; ?>					
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
</section>

<section class="ftco-section">
	<div class="container">
		<div class="row">
			<?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if($element->type == 'banner'): ?>
					<div class="col-md-4 ftco-animate">
						<div class="blog-entry">
							<a href="" class="block-20" style="background-image: url(<?php echo e($element->getUrlImage()); ?>);">
							</a>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
</section>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/paginasOdontologas/blog/AppGestorContenido/resources/views/website/index.blade.php ENDPATH**/ ?>