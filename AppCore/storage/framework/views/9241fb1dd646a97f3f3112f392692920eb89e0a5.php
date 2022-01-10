<?php $__env->startSection('content'); ?>

<div class="container-fluid fondo-contacto" >
	<div class="row fondo-contacto2">
		<div class="col-md-6">
			<h5 class="text-center tc-verde vmt-15">COMUNICATE CON NOSOTROS Y CON MUCHO</h5>
			<h5 class="text-center tc-verde">GUSTO TE ATENDEREMOS</h5>
			<h6 class="text-center">Atención al cliente las 24 horas al día</h6>
			<img src="img/cuadro.png" alt="" class="cuadro-contacto">

			<div class="row vpz-5">

				<div class="col-md-12 mt-5">
					<input type="text" class="form-control mb-3" placeholder="Nombre Completo*">
					<input type="email" class="form-control mb-3" placeholder="Email*">
					<input type="text" class="form-control mb-3" placeholder="Teléfono celular">
					<input type="text" class="form-control mb-3" placeholder="Teléfono de casa">
					<input type="text" class="form-control mb-3" placeholder="¿De donde eres?">
					<input type="text" class="form-control mb-3" placeholder="Estado">
					<div class="row">
						<div class="col-md-6">
							<input type="text" class="form-control mb-3" placeholder="Servicios de Interés*">
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control mb-3" placeholder="¿Como se enteró de Keywood?*">
						</div>
					</div>
					<textarea name="" id="" cols="30" rows="10" class="form-control mb-3" placeholder="¿Como podemos ayudarle?*"></textarea>
					<div class="row">
						<div class="col-md-9 centrar-mobile">
							<input type="checkbox">
							<h6 class="d-inline size-9 tc-verde">Acepto Políticas de manejo de la información HABEAS DATA</h6>
						</div>
						<div class="col-md-3 centrar-mobile mmt-5 mmb-5">
							<a href="" class="btn btn-danger">Ver Políticas</a>
						</div>
						<div class="col-md-12 centrar-mobile mmb-5">
							<button class="btn bg-trans vb-verder tc-verde w-25 mw-100">Enviar Ya</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/keywood/AppGestorContenido/resources/views/website/contact.blade.php ENDPATH**/ ?>