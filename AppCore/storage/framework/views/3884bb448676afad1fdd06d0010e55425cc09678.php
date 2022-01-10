<?php $__env->startSection('content'); ?>

<!-- Navigation -->
<nav id="navbar" class="navbar-registro navbar-expand-lg navbar-light fixed-top py-3">
	<div class="container">

		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<a href="<?php echo e(route('website.index')); ?>"><img class="logo" src="<?php echo e(asset('img/logo.png')); ?>" alt="CAPPSERITO"></a>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto my-2 my-lg-0">
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#ayuda">AYUDA</a>
				</li>
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="#" class="btn boton-enviar" data-toggle="modal" data-target="#exampleModal">YA SOY CHEF</a>
				</li>
			</ul>
		</div>
	</div>
</nav>


<!-- Masthead -->
<header class="masthead-registro-chef" id="app-main">
	<div class="container h-100 text-center">
		<div class="row">
			<div class="col-sm-7">
			</div>
			<div id="afiliarme" class="col-sm-5">
				<h1 class="text-uppercase font-weight-bold text-naranja">
					AUMENTA
					<br>
					LAS VENTAS
				</h1>
				<div class="card">
					<div class="card-body">
						<h2 class="card-title text-gray">
							¡VEN A <img class="letras" src="<?php echo e(asset('img/letras.png')); ?>" alt="CAPPSERITP CHEF">!
						</h2>
						<h6 class="card-title">
							Haz tu registro con nosotros !Es fácil y rápido¡
						</h6>
						<form method="post" onsubmit="return false;" id="form-register-chef">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Nombre" name="name" id="name" v-model="user.name" required>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Apellido" name="last_name" v-model="user.last_name" id="last_name" required>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Documento de Identidad" name="dni" v-model="user.dni" id="dni" required>
							</div>
							<div class="form-group">
								<input type="email" class="form-control" placeholder="Email" name="email" id="email" v-model="user.email" required>
							</div>
							<div class="form-group">
								<input type="numb" class="form-control" placeholder="Teléfono" name="phone" id="phone" v-model="user.phone" required>
							</div>
							<div class="form-group">
								<input type="password" class="form-control" placeholder="Contraseña" name="password" id="password" v-model="user.password" required>
							</div>
							<div class="form-group">
								<input type="password" class="form-control" placeholder="Confirmar contraseña" name="password2" id="password2" v-model="user.password2" required>
							</div>
							<h6>
								Al continuar, acepto que CAPPSERITO entre en contacto conmmigo por teléfono, e-mail o WhatsApp (incluyengo mensajes automáticos con fines comerciales).
							</h6>
							<br>
							<div class="text-center">
								<button type="submit" class="btn boton-enviar font-weight-bold btn-lg" :disabled="loading == true">
									<template v-if="!loading">
                                        Quiero Afiliarme
                                    </template>
                                    <template v-if="loading">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </template>
								</button>
							</di>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>


<!-- Modal login -->
<div class="modal modal-registro fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm text-center">
						<h5 class="modal-title" id="exampleModalLabel">Ingresar en mi cuenta</h5>
					</div>
				</div>
			</div>
			<form class="container" method="post" onsubmit="return false;" id="form-login-cook">
				<div class="form-group">
					<input type="email" class="form-control" id="login-email" placeholder="Email" name="email" v-model="user.email">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" id="login-contrania" placeholder="Contraseña" name="password" v-model="user.password">
				</div>
				<div class="row">
					<div class="col-sm-4 text-left">
						<input type="checkbox" class="custom-control-input" id="customCheck1" name="remember" v-model="user.remember">
						<label class="custom-control-label" for="customCheck1">Recordarme</label>
					</div>
					<div class="col-sm-8 text-right">
						<a class="text-naranja" href="">Olvide mi contraseña</a>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm text-center">
						<button type="submit" class="btn boton-enviar btn-lg btn-block font-weight-bol" :disabled="loading == true">
							<template v-if="!loading">
                                Ingresar
                            </template>
                            <template v-if="loading">
                                <i class="fa fa-spinner fa-spin"></i>
                            </template>
						</button>
					</div>
				</div>
			</form>
			<br>
			<!-- <div class="row">
				<div class="col-sm text-center">
					¿Todavía no tienes una cuenta? <a class="text-naranja" href="registro-chef.html">Registrate</a> 
				</div>
			</div> -->
			<br>
		</div>
	</div>
</div>

<br><br>


<!--Pasos -->
<section class="testimonios bg-light text-center text-white">
	<div class="container">
		<h2 class="text-center">Afiliarte es simple</h2>
		<br><br><br>
		<div class="row">
			<div class="col-sm">
				<div class="card">
					<img class="people" src="<?php echo e(asset('img/registro/paso-1.png')); ?>" alt="Robert Smith">
					<h6>Regístrate</h6>
					<img class="division" src="<?php echo e(asset('img/division.png')); ?>" alt="División">
					<div class="card-body">
						<p class="card-text">Al hacer clic en "quiero afiliarme", inicia tu registro para firmar un convenio en línea.</p>
					</div>
				</div>
			</div>
			<div class="col-sm">
				<div class="card">
					<img class="people" src="<?php echo e(asset('img/registro/paso-2.png')); ?>" alt="Regina Ontario">
					<h6>Configura</h6>
					<img class="division" src="<?php echo e(asset('img/division.png')); ?>" alt="División">
					<div class="card-body">
						<p class="card-text">Después de la aprobación, el equipo de CAPPSERITO cinfigurará tu Restaurante Digital.</p>
					</div>
				</div>
			</div>
			<div class="col-sm">
				<div class="card">
					<img class="people" src="<?php echo e(asset('img/registro/paso-3.png')); ?>" alt="Jerry Tucson">
					<h6>Comienza a recibir pedidos</h6>
					<img class="division" src="<?php echo e(asset('img/division.png')); ?>" alt="División">
					<div class="card-body">
						<p class="card-text">¡Listo! ya puede recirbir pedidos Rápidos y fácil.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<br><br>

<!--afiliarme -->
<section class="area-afilimare-abajo  bg-light text-white container">
	<div class="overlay"></div>
	<div class="container text-center">
		<div class="row">
			<div class="col-sm">
				<h2 class="font-weight-bold text-white">
					Forma parte de <img class="letras" src="<?php echo e(asset('img/letras.png')); ?>" alt="CAPPSERITP CHEF">
					<br>
					e incrementa tus ventas.
				</h2>
				<br>
				<a href="#afiliarme"><button type="submit" class="btn boton-enviar font-weight-bold btn-lg">Afiliarme</button></a>
			</div>
		</div>
	</div>
</section>

<br><br>

<!--testimonios -->
<section class="testimonios-registro container text-white">
	<div class="text-justify">
		<div class="row">
			<div class="col-lg-5">
				<div class="card">
					<img class="people" src="<?php echo e(asset('img/robert-smith.png')); ?>" alt="Robert Smith">
					<div class="card-body">
						<p class="card-text">
							Mi experiencia con SinDelantal ha sido lo mejor que nos pudo pasar, es el trapolín perfecto para comenzar un negocio, tal y como fue mi caso, pase de ser un empleado a tener mi propio negocio, Yo no cuento con restaurante físico, yo le llamo restaurante virtual y mi producto es exclusivo de SinDelantal, nadie podría probar mis Chilaquiles si no es por esta maravillosa aplicación, la cual es mi única fuente de ingreso y mi estabilidad económica se basa en ella. 
						</p>
					</div>
				</div>
			</div>
			<div class="col-lg-7">
				<img class="chilaquiles" src="<?php echo e(asset('img/registro/plato-especial.png')); ?>" alt="Chilaquiles">
			</div>
		</div>
	</div>
</section>

<br><br><br><br>

<!--testimonios -->
<section id="ayuda" class="testimonios-registro container text-white">
	<div class="">
		<div class="row">
			<div class="col-sm">
				<h2>Dudas</h2>
				<h3 class="text-gray">
					Si deseas más información,<br>
					puedes resolver tus dudas aquí.
				</h3>
			</div>
			<div class="col-sm text-gray">
				<button class="accordion">¿Cuánto cuesta entrar a CAPPSERITO?</button>
				<div class="panel">
					<br>
					<h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h6>
				</div>
				<hr>
				<button class="accordion">¿Qué necesito para entrar a CAPPSERITO?</button>
				<div class="panel">
					<br>
					<h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h6>
				</div>
				<hr>
				<button class="accordion">¿Cómo funciona el registro?</button>
				<div class="panel">
					<br>
					<h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h6>
				</div>
				<hr>
				<button class="accordion">¿El contrato tiene fidelidad?</button>
				<div class="panel">
					<br>
					<h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h6>
				</div>
				<hr>
				<button class="accordion">¿Cómo me paga CAPPSERITO?</button>
				<div class="panel">
					<br>
					<h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h6>
				</div>
				<hr>
				<button class="accordion">¿Quien es responsable de las entregas CAPPSERITO?</button>
				<div class="panel">
					<br>
					<h6>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h6>
				</div>



			</div>
		</div>
	</div>
</section>

<br><br><br><br>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('AppResources/plugins/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('AppResources/js/website/register-chef.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/Cabpserito/AppCore/resources/views/website/registroChef.blade.php ENDPATH**/ ?>