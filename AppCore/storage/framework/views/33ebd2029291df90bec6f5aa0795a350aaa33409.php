<?php $__env->startSection('content'); ?>

<!-- Start Login Register Area -->
<div class="htc__login__register bg__white ptb--130" style="background: rgba(0, 0, 0, 0) url(images/bg/5.jpg) no-repeat scroll center center / cover ;">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<ul class="login__register__menu" role="tablist">
					<li role="presentation" class="login active"><a href="#authLogin" role="tab" data-toggle="tab">Ingresar</a></li>
					<li role="presentation" class="register"><a href="#authRegister" role="tab" data-toggle="tab">Registrarse</a></li>
				</ul>
			</div>
		</div>
		<!-- Start Login Register Content -->
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="htc__login__register__wrap">
					<!-- Start Single Content -->
					<div id="authLogin" role="tabpanel" class="single__tabs__panel tab-pane fade in active">
						<form class="login" method="post" id="formLogin" onsubmit="return false;" v-on:submit="login()">
							<input type="text" placeholder="Nombre de Usuario*" name="email" v-model="email" required="required">
							<input type="password" placeholder="Contraseña*" name="password" v-model="password" required="required">
							<input type="submit" style="display: none;">
							<div class="row" v-if="errorMessage  != ''">
								<div class="col-12 col-md-12">
									<div class="alert alert-danger" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										{{ errorMessage }}	
									</div>
								</div>
							</div>
						</form>
						<div class="tabs__checkbox">
							<input type="checkbox" name="remember" v-model="remember">
							<span> Recordarme</span>
							<span class="forget"><a href="#">¿Olvidaste la contrasea?</a></span>
						</div>
						<div class="htc__login__btn mt--30">
							<a v-on:click="login()" :disabled="sending == true" style="border:2px solid #e04456; border-radius: 15px;">
								<template v-if="!sending">
									Ingresar
								</template>
								<template v-if="sending">
									<i class="fa fa-spinner fa-spin"></i>
								</template>
							</a>
						</div>
						<div class="htc__social__connect">
							<h2>O ingresa con</h2>
							<ul class="htc__soaial__list">
								<li><a style="border-radius: 25px;" class="bg--twitter" href="#"><i class="zmdi zmdi-twitter"></i></a></li>

								<li><a style="border-radius: 25px;" class="bg--instagram" href="#"><i class="zmdi zmdi-instagram"></i></a></li>

								<li><a style="border-radius: 25px;" class="bg--facebook" href="#"><i class="zmdi zmdi-facebook"></i></a></li>

								<li><a style="border-radius: 25px;" class="bg--googleplus" href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
					<!-- End Single Content -->

					<!-- Start Single Content -->
					<div id="authRegister" role="tabpanel" class="single__tabs__panel tab-pane fade">
						<form class="login" method="post" onsubmit="return false;" id="formRegister" v-on:submit="register()">
							<input type="text" placeholder="Nombre*" name="name" required="required" v-model="name">
							<input type="email" placeholder="Correo*" name="email" v-model="email" required="required">
							<input type="password" required="required" placeholder="Contraseña*" name="password" v-model="password">
							<input type="password" placeholder="Contraseña*"  required="required" name="password_confirmation" v-model="password_confirmation">
							<div class="row" v-if="errorMessage  != ''">
								<div class="col-12 col-md-12">
									<div class="alert alert-danger" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										{{ errorMessage }}	
									</div>
								</div>
							</div>
							<div class="htc__login__btn">
								<a v-on:click="register()" :disabled="sending == true" style="border:2px solid #e04456; border-radius: 15px;">
									<template v-if="!sending">
										Registrar
									</template>
									<template v-if="sending">
										<i class="fa fa-spinner fa-spin"></i>
									</template>
								</a>
							</div>
							<input type="submit" style="display: none;">
						</form>
						<!-- <div class="tabs__checkbox">
							<input type="checkbox">
							<span> Recuerdame</span>
						</div> -->
						
						<div class="htc__social__connect">
							<h2>O registrate con:</h2>
							<ul class="htc__soaial__list">
								<li><a  style="border-radius: 25px;"class="bg--twitter" href="#"><i class="zmdi zmdi-twitter"></i></a></li>
								<li><a style="border-radius: 25px;"class="bg--instagram" href="#"><i class="zmdi zmdi-instagram"></i></a></li>
								<li><a style="border-radius: 25px;" class="bg--facebook" href="#"><i class="zmdi zmdi-facebook"></i></a></li>
								<li><a  style="border-radius: 25px;"class="bg--googleplus" href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
					<!-- End Single Content -->
				</div>
			</div>
		</div>
		<!-- End Login Register Content -->
	</div>
</div>
<!-- End Login Register Area -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/app/auth.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/woman/AppGestorContenido/resources/views/website/auth/auth.blade.php ENDPATH**/ ?>