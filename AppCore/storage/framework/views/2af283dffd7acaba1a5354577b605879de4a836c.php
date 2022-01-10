<?php $__env->startSection('content'); ?>
<my-nav :subcategories="null"></my-nav>

<section class="login_area p_100" style="margin: 60px 0;">
	<div class="container">
		<div class="login_inner">
			<div class="row">
				<div class="col-lg-5" style="margin-top: 20px;">
					<div class="login_title" align="center">
						<h2 style="color: #00C800; font-weight: bold; font-size: 23px; text-align: center;">INICIAR SESIÓN</h2>
						<p style="text-align: center; ">¡Ofertas, Novedades, Variedad y más!</p>
						<hr style=" background-color:#00C800; width: 10%; height: 2px;" align="center">
					</div>
					<form class="login_form row" id="form_login" v-on:submit.prevent="login('form_login')" style="background-color: #FFFF00; padding: 30px; border-radius: 10px;">
						<div class="col-lg-12 form-group">
							<input class="form-control" type="email" name="email" required placeholder="Nombre de Usuario">
						</div>
						<div class="col-lg-12 form-group">
							<input class="form-control" type="password" name="password" required placeholder="Contraseña">
						</div>
						<div class="col-lg-12 form-group">
							<div class="creat_account">
								<input type="checkbox" id="f-option" name="remember">
								<label for="f-option">Recordarme</label>
								<div class="check"></div>
							</div>
						</div>
						<div class="col-lg-12 form-group">
							<button style="background-color: #00C800; color: white;" type="submit" value="submit" class="btn update_btn form-control">
								<template v-if="!sending">Ingresar</template>
								<template v-if="sending"><i class="fa fa-spinner fa-spin"></i></template>
							</button>
						</div>
					</form>
				</div>
				<div class="col-lg-7" style="margin-top: 20px;">
					<div class="login_title" align="center">
						<h2 style=" color:#00C800; font-weight: bold; font-size: 23px; text-align: center;">CREAR CUENTA</h2>
						<p style="text-align: center;">Registrate ¡Es gratis!</p>
						<hr style=" background-color:#00C800; width: 10%; height: 2px;" align="center">
					</div>
					<form class="login_form row" id="formRegister" v-on:submit.prevent="register()" style="border: 2px solid #FFFF00; margin: 10px; padding: 25px; border-radius: 10px;">
						<div class="col-lg-6 form-group">
							<input class="form-control" type="text" placeholder="Nombre*" name="name" required v-model="registerUser.name">
						</div>
						<div class="col-lg-6 form-group">
							<input class="form-control" type="email" placeholder="Correo*" name="email" required v-model="registerUser.email">
						</div>
						<div class="col-lg-6 form-group">
							<select class="form-control" name="country" v-model="registerUser.country">
								<option value="Argentina">Argentina</option>
								<option value="Colombia" selected>Colombia</option>
								<option value="Venezuela">Venezuela</option>
							</select>
						</div>
						<div class="col-lg-6 form-group">
							<input class="form-control" type="text" placeholder="Teléfono*" name="phone" v-model="registerUser.phone">
						</div>
						<div class="col-lg-6 form-group">
							<input class="form-control" type="text" placeholder="Estado" name="state">
						</div>
						<div class="col-lg-6 form-group">
							<input class="form-control" type="text" placeholder="Código postal" name="codePostal">
						</div>
						<div class="col-lg-12 form-group">
							<textarea class="form-control" name="address" placeholder="Dirección completa" rows="5"></textarea>
						</div>
						<div class="col-lg-6 form-group">
							<input class="form-control" type="password" placeholder="Contraseña*" required name="password" v-model="registerUser.password">
						</div>
						<div class="col-lg-6 form-group">
							<input class="form-control" type="password" placeholder="Confirmar Contraseña*" name="password_confirmation" v-model="registerUser.password_confirmation">
						</div>
						<div class="col-lg-12" v-if="errorMessageRegister  != ''">
							<div class="col-12 col-md-12">
								<div class="alert alert-danger" role="alert">
									{{ errorMessageRegister }}	
								</div>
							</div>
						</div>
						<div class="col-lg-12 form-group">
							<button align="center" style="background-color: #00C800; color: white;" type="submit" class="btn subs_btn form-control">
								<template v-if="!sending">Registrar</template>
								<template v-else :disabled="sending == true"><i class="fa fa-spinner fa-spin"></i></template>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/ez/AppGestorContenido/resources/views/website/auth/auth.blade.php ENDPATH**/ ?>