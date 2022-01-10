<?php $__env->startSection('content'); ?>

<div class="container">
	<div class="container-fluid" >
		<div class="row fondo-contacto2" style="height: 100vh; margin-bottom: 50px !important;">
			<div class="col-md-6 registrar" id="authRegister">
				<h5 class="text-center tc-verde vmt-15">Registrate ¡Es Gratis!</h5>
				<h6 class="text-center">KeyWood, tienda online de productos hechos en madera.</h6>
				<img src="img/cuadro.png" alt="" class="cuadro-contacto">
				<br>

				<div class="row vpz-5">
					<form id="formRegister" onsubmit="return false;" v-on:submit="register()">
						<div class="col-md-12 mt-5">
							<input type="text" name="name" class="form-control mb-3" placeholder="Nombre Completo(*)" required="required" v-model="name">
							<input type="email" name="email" class="form-control mb-3" placeholder="Email(*)" required="required" v-model="email">
							<input type="password" name="password" class="form-control mb-3" placeholder="Contraseña(*)" required="required" v-model="password">
							<input type="password" name="password_confirmation" class="form-control mb-3" placeholder="Confirma Contraseña(*)" required="required" v-model="password_confirmation">
							<input type="text" name="phone" class="form-control mb-3" placeholder="Teléfono celular(*)" required="required" v-model="phone">
							<input type="text" name="address" class="form-control mb-3" placeholder="¿De donde eres?" v-model="address">
							<input type="text" name="state" class="form-control mb-3" placeholder="Estado" v-model="state">
							<div class="row" v-if="errors  != ''">
								<div class="col-12 col-md-12">
									<div class="alert alert-danger" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										{{ errorMessage }}									  				
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-9 centrar-mobile">
									<input type="checkbox" name="term" v-model="term" required="required">
									<h6 class="d-inline size-9 tc-verde">Acepto Los Terminos y Condiciones</h6>
								</div>
								<div class="col-md-12 centrar-mobile mmb-5"><br>
									<button class="btn bg-trans vb-verder tc-verde w-25 mw-100" :disabled="sending == true">
										<template v-if="!sending">
											Registrarse
										</template>
										<template v-if="sending">
											<i class="fa fa-spinner fa-spin"></i>
										</template>
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="col-md-6 registrar" id="authLogin" style="background-color: rgba(0, 0, 0, 0.06);">
				<h5 class="text-center tc-verde vmt-15">¿Tienes una cuenta? Ingresa ahora</h5>
				<h6 class="text-center">Descubre las nuevas ofertas que tenemos para ti.</h6>
				<br>

				<div class="row vpz-5">
					<form id="formLogin" onsubmit="return false;" v-on:submit="login()">
						<div class="col-md-12 mt-5">
							<input type="email" class="form-control mb-3" name="email" placeholder="Email*" required="required" v-model="email">
							<input type="password" class="form-control mb-3" name="password" placeholder="Contraseña" required="required" v-model="password">
							<div class="row" v-if="errors  != ''">
								<div class="col-12 col-md-12">
									<div class="alert alert-danger" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										{{ errorMessage }}									  				
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-9 centrar-mobile">
									<input type="checkbox" name="remember" id="remember" v-model="remember">
									<h6 class="d-inline size-9 tc-verde">Recordarme</h6>
								</div>
								<div class="col-md-12 centrar-mobile mmb-5"><br>
									<button class="btn bg-trans vb-verder tc-verde w-25 mw-100" :disabled="sending == true">
										<template v-if="!sending">
											Acceder
										</template>
										<template v-if="sending">
											<i class="fa fa-spinner fa-spin"></i>
										</template>									
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/auth.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/keywood/AppGestorContenido/resources/views/website/auth/auth.blade.php ENDPATH**/ ?>