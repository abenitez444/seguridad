<?php $__env->startSection('content'); ?>

<div class="container">

	<img src="<?php echo e(asset('img/flecha.png')); ?>" alt="" class="position-absolute flecha2 mpr">

	<div class="row mt-5 mb-5 mmt-5">
		<div class="col-md-12 text-center mt-3">
			<h2 class="tc-verde mb-0 mfz-15">POR QUE COMPRAR</h2>
			<h2 class="tc-verde mfz-15">EN KEYWOOD</h2>
			<img src="img/cuadro.png" alt="" class="position-absolute cuadro-nosotros">
		</div>
	</div>

	<div class="row mb-5">

		<div class="col-md-4 text-center mt-5">
			<img src="<?php echo e(asset('img/corazon.png')); ?>" alt="" class="img fluid mb-5">
			<h4 class="mb-5 mt-3">La calidad está en la esencia…</h4>

			<p class="mb-4 h5 parrafo10 pt-4">Empleamos Madera perillo y chapa Roble Rose, materiales atemporales que se ajustan a tu estilo de vida y reflejan el compromiso con el planeta.</p>

			<p class="h5 parrafo10 mb-5">Manipulamos componentes de los màs altos estandares pensados en la comodidad y en la tranquilidad de nuestros clientes</p>
		</div>

		<div class="col-md-4 text-center mt-5">
			<img src="<?php echo e(asset('img/raiz.png')); ?>" alt="" class="img fluid mb-5">
			<h4 class="mb-5 mt-3">Lo que somos actualmente son nuestras raíces</h4>

			<p class="mb-4 h5 parrafo10">Somos un equipo que ha logrado su trayectoria sin olvidar sus raíces, mantenemos la tradición en la fabricación de nuestros muebles realizando procesos manuales que a su vez se combinan con procesos industriales generados por tecnología de punta internacional.</p>

		</div>
		<div class="col-md-4 text-center mt-5">
			<img src="<?php echo e(asset('img/casa-roja.png')); ?>" alt="" class="img fluid mb-5">
			<h4 class="mb-5 mt-3">Somos más que un diseño</h4>

			<p class="mb-4 h5 parrafo10 pt-4">Nuestros diseños van más allá de una tendencia, no solo se trata de diseñar tus muebles, lo que realmente buscamos es diseñar tu hogar, para que nos permitas ser parte de tu familia, complementando tus espacios con nuestras líneas versátiles e innovadoras, modernas y a su vez clásicas dando un toque de elegancia.</p>

		</div>

	</div>
</div>


<div class="container-fluid">

	<div class="row">
		<div class="col-md-6 pl-0 mpr-0">
			<img src="<?php echo e(asset('img/pc.png')); ?>" alt="" class="img-fluid w-100">
		</div>
		<div class="col-md-6">
			<div class="row mt-3">
				<div class="col-md-12 text-center mb-5">
					<h3 class="tc-verde mb-0 mfz-15">NUESTRO TRABAJO NO ES</h3>
					<h3 class="tc-verde mfz-15">OBLIGACIÓN ES PASIÓN</h3>
					<img src="img/cuadro.png" alt="" class="position-absolute cuadro-nosotros2">

				</div>

				<div class="col-md-12 text-center">
					<p class="parrafo6 mb-3">Nuestra pasión y calidad humana nos caracterizan, somos una organización comprometida, creemos en lo que somos y en lo que hacemos, buscamos ser versátiles e innovadores, pero siempre manteniendo nuestra propia esencia.</p>
					<p class="parrafo6 mb-5">El trabajo en equipo es uno de los pilares más importantes para nosotros, promulgamos un ambiente cálido en el que el compañerismo es impartido como filosofía por parte de la empresa, infundiendo y difundiendo la solidaridad, el compromiso y el trabajo duro. Porque somos un equipo con mucha madera.</p>
				</div>

			</div>
		</div>
	</div>

</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/keywood/AppGestorContenido/resources/views/website/about.blade.php ENDPATH**/ ?>