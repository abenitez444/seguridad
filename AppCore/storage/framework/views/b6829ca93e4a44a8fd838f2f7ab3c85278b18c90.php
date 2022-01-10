<?php $__env->startSection('title'); ?>Contacto | <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<header style="background-image: url(<?php echo e($infoPage->getUrlImage()); ?>);" id="header-contacto">
</header>

<section id="form-contacto">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<h2 class="section-heading"><?php echo e($infoPage->title); ?></h2>
			</div>
		</div>
		<div class="row align-items-center h-100">
			<div class="col-md-8 mx-auto">

				<form class="well form-horizontal" id="frm_contact" onsubmit="return false;" v-on:submit="send()" >
					<fieldset id="fieldform">
						<div class="form-group">
							<div class="col-md-12 inputGroupContainer">
								<div class="input-group">
									<input name="name" required="required" placeholder="Nombre Completo" class="form-control"  type="text" v-model="name">
								</div>
								<input type="hidden" name="type" value="contacto" v-model="type">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12 inputGroupContainer">
								<div class="input-group">
									<input id="email" name="email" required="required" placeholder="Email" class="form-control"  type="text" v-model="email">
								</div>
							</div>
						</div>

						<div id="flag" class="form-group">
							<div class="col-md-12 inputGroupContainer">
								<div class="input-group">
									<input id="phone" name="phone" required="required" class="form-control" type="tel" v-model="phone" style="padding-left: 100px !important; width: 100% !important;">
									<input type="hidden" name="code" v-model="code">
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12 inputGroupContainer">
								<div class="input-group">
									<textarea class="form-control" id="cm" required="required" name="message" placeholder="Cuéntanos un poco de tu Proyecto" v-model="message"></textarea>
								</div>
							</div>
						</div>

						<div style="padding: 0 45px;">
							<div class="notification canhide">
								<div class="wrapper">
									<div class="inner"></div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row mx-auto">
								<div class="col-md-8 chek-ajust">
									<div class="form-check">
										<input class="form-check-input" required="required" type="checkbox" value="" id="defaultCheck1">
										<label class="form-check-label" for="defaultCheck1">
											Acepto politicas de manejo de la información HABEAS DATA
										</label>
									</div>
								</div>
								<div class="col-md-4">
									<button type="button" class="btn btnhospital" data-toggle="modal" data-target="#politicas-privacidad">Ver politicas</button>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row mx-auto">
								<div class="col-md-6">
									<div class="recaptcha">
										<div class="form-group">
											<div  class="g-recaptcha" data-sitekey="6LctjqIUAAAAAGcnMnmAfDgo5usC3Qi6TtdqIarO" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
											<input class="form-control d-none" data-recaptcha="true" id="capa" name="capa" >
											<div class="help-block with-errors"></div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<button type="submit" class="btn btnhospital-two" :disabled="sending == true">
										<template v-if="!sending">
											Empecemos <span class="glyphicon glyphicon-send"></span>
										</template>
										<template v-if="sending">
											<i class="fa fa-spinner fa-spin"></i>
										</template>
									</button>
								</div>
							</div>
						</div>

					</fieldset>
				</form>
			</div>

			<div class="col-md-4 mx-auto">
				<div id="icoform" class="center-block">
					<?php $__currentLoopData = $company['socialsNetworks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a href="<?php echo e($social->url); ?>" target="<?php echo e($social->new_windows == 1 ? '_blank' : ''); ?>">
                            <i id="social-fb" class="<?php echo e($social->ico); ?>"></i>
                        </a>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
				<p><span><i class="fas fa-map-marker-alt"></i></span> <?php echo e($company['info']->address); ?></p>
				<p><span><i class="far fa-envelope"></i></span> <?php echo e($company['info']->email); ?></p>
				<p> <span><i class="fas fa-mobile-alt"></i></span> <?php echo e($company['info']->phone); ?></p>
				<p> <span><i class="far fa-clock"></i></span> Lun - Sáb: <?php echo e($company['info']->working_hours); ?> 
				Dom: Cerrado</p>
			</div> 
		</div>
	</div>
</section>

<div class="col-12 col-md-12 col-sm-12 col-lg-12 map" >
	 <?php
        $doc = new DOMDocument();
        $doc->loadHTML('<?xml encoding="UTF-8">'.$infoPage->content );
        $doc->encoding = 'UTF-8';
        echo $doc->saveHTML();
    ?>
</div>



<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="js/contact.js"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/th3khan/Disco de respaldo/Anthony/trabajos/proyectos laravel/GestorContenido/resources/views/website/contacto.blade.php ENDPATH**/ ?>