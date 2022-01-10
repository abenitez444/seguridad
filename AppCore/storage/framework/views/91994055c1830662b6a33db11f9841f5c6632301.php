<?php $__env->startSection('content'); ?>

<!-- Contáctanos -->
<section class="contactanos ">
	<div class="container">
		<div class="row">
			<div class="col-sm">
				<h1>¿Por qué elegirnos?</h1>
				<h5>
					CAPPSERITO es la compañia lider de delivery online comida en Colombia. Nuestro servicio consiste en brindar una plataforma online simple, práctica y sin costo adicional que permite a los usuarios ordenar delivery a restaurantes ¡Nos motiva hacerte la vida fácil!

				</h5>
			</div>
		</div>
	</div>
</section>

<br><br>

<section class="banner-nosotros text-center text-white">
	<div class="container">
		<div class="row">
			<div class="col-sm">
				<img src="<?php echo e(asset('img/responsables.png')); ?>" alt="Responsables"><br><br>
				<h5>
					Responsables y <br> comprometidos.
				</h5>
				<br>
			</div>
			<div class="col-sm">
				<img src="<?php echo e(asset('img/confianza.png')); ?>" alt="Confianza"><br><br>
				<h5>
					Confianza y <br> amabilidad.
				</h5>
				<br>
			</div>
			<div class="col-sm">
				<img src="<?php echo e(asset('img/innovacion.png')); ?>" alt="Innovación">
				<h5>
					Innovación y <br> tecnología.
				</h5>
				<br>
			</div>
		</div>
	</div>
</section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Cabpserito/AppCore/resources/views/website/nosotros.blade.php ENDPATH**/ ?>